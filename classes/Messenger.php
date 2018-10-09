<?php
    namespace pulut {
        use \pulut\Logger;
        use PDO;
        use Exception;
        class Scheduler {
            const APP_ID = "98egHrByoGhRdTEdRRiyMXhR98dRHyGB";
            const APP_SECRET = "721dbbfec1264a386e2529a661744e0b45d62e243d2bf86a7fdd3acefb031570";
            const SHORT_CODE = "21585395";
            const CROSS_TELCO_CODE = "29290585395)";
            const FOUR_DIGIT_CODE = "5395";
            private $pdo;
            private $username, $password, $destination;
            private $log;
            private $access_Token;
            private $subscriber_Number;
            public function __construct()
            {
                $this->log = new \pulut\Logger();
                $this->username = 'root';
                $this->password = '';
                $this->destination = 'mysql:host=localhost;dbname=pulutpukyutan';
                $this->pdo = new PDO($this->destination, $this->username, $this->password);
                $this->access_Token = $this->pdo->query("SELECT prefValue FROM settings WHERE prefName = 'msg_accessToken'")->fetch(PDO::FETCH_ASSOC)['prefValue'];
                $this->subscriber_Number = $this->pdo->query("SELECT prefValue FROM settings WHERE prefName = 'msg_subscriberNumber'")->fetch(PDO::FETCH_ASSOC)['prefValue'];
            }

            public function setAccessToken($code) {
                $argVals = array("app_id"=>$this::APP_ID, "app_secret"=>$this::APP_SECRET, "code"=>$code);
                $args = http_build_query($argVals);
                $cl = curl_init("https://developer.globelabs.com.ph/oauth/access_token");
                curl_setopt($cl, CURLOPT_POST, true);
                curl_setopt($cl, CURLOPT_POSTFIELDS, $args);
                curl_setopt($cl, CURLOPT_RETURNTRANSFER, true);
                try {
                    $response = json_decode(curl_exec($cl), true);
                    $accessToken = $response['access_token'];
                    $subscriberNumber = $response['subscriber_number'];
                    $setAccessToken = $this->pdo->query("UPDATE settings SET prefValue = '$accessToken' WHERE prefName = 'msg_accessToken'");
                    $setSubscriberNum = $this->pdo->query("UPDATE settings SET prefValue = '$subscriberNumber' WHERE prefValue = 'msg_subscriberNumber'");
                    if ($setAccessToken && $setSubscriberNum) {
                        $this->log->messageLogger('Contact number for this unit has been successfully set.');
                        $this->log->genLogger('Contact number for this unit has been successfully set.');
                        curl_close($cl);
                        return true;
                    } else {
                        $this->log->messageLogger('Contact number for this unit has failed to be set.');
                        $this->log->genLogger('Contact number for this unit has failed to be set.');
                        curl_close($cl);
                        return false;

                    }
                } catch (Exception $e) {
                    curl_close($cl);
                    return false;
                }

            }

            public function sendMessage($clientCorrelator, $message) {
                $argVals = array("address"=>$this->subscriber_Number, "message"=>$message, "clientCorrelator"=>"$clientCorrelator");
                $args = http_build_query($argVals);
                $cl = curl_init("https://devapi.globelabs.com.ph/smsmessaging/v1/outbound/".$this::FOUR_DIGIT_CODE."/requests?access_token=".$this->access_Token."}");
                curl_setopt($cl, CURLOPT_POST, true);
                curl_setopt($cl, CURLOPT_POSTFIELDS, $args);
                curl_setopt($cl, CURLOPT_RETURNTRANSFER, true);
                try {
                    curl_exec($cl);
                    $this->log->messageLogger('Message '.$clientCorrelator." sent: \"".$message."\".");
                    $this->log->genLogger('Message '.$clientCorrelator." sent: \"".$message."\".");
                    curl_close($cl);
                    return true;
                } catch (Exception $e) {
                    $this->log->messageLogger('Message '.$clientCorrelator." sending failed: \"".$message."\".");
                    $this->log->genLogger('Message '.$clientCorrelator." sending failed: \"".$message."\".");
                    curl_close($cl);
                    return false;
                }
            }
        }
    }