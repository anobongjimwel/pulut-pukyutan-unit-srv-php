<?php
    namespace pulut {
        use \pulut\Logger;
        use PDO;
        use Exception;
        class Messenger {
            const APP_ID = "98egHrByoGhRdTEdRRiyMXhR98dRHyGB";
            const APP_SECRET = "721dbbfec1264a386e2529a661744e0b45d62e243d2bf86a7fdd3acefb031570";
            const SHORT_CODE = "21585395";
            const CROSS_TELCO_CODE = "29290585395)";
            const FOUR_DIGIT_CODE = "5395";
            const SERVICE_ON = "1";
            const SERVICE_OFF = "0";
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
                $argVals = array("app_id"=>$this::APP_ID, "app_secret"=>$this::APP_SECRET, "code"=>"$code");
                $args = http_build_query($argVals);
                $cl = curl_init("https://developer.globelabs.com.ph/oauth/access_token");
                curl_setopt($cl, CURLOPT_POST, true);
                curl_setopt($cl, CURLOPT_POSTFIELDS, $args);
                curl_setopt($cl, CURLOPT_RETURNTRANSFER, true);
                try {
                    $initResponse = curl_exec($cl);
                    $response = json_decode($initResponse);
                    if (isset($response->access_token) && $response->subscriber_number) {
                        $accessToken = $response->access_token;
                        $subscriberNumber = $response->subscriber_number;
                        $setAccessToken = $this->pdo->query("UPDATE settings SET prefValue = '$accessToken' WHERE prefName = 'msg_accessToken'");
                        $setSubscriberNum = $this->pdo->query("UPDATE settings SET prefValue = '0$subscriberNumber' WHERE prefName = 'msg_subscriberNumber'");
                        $good = true;
                    } else {
                        $good = false;
                    }
                    if (isset($setAccessToken) && isset($setSubscriberNum)) {
                        if ($good!=false) {
                            $this->log->messageLogger('Contact number (0'.$subscriberNumber.') for this unit has been successfully set.');
                            $this->log->genLogger('Contact number (0'.$subscriberNumber.') for this unit has been successfully set.');
                            curl_close($cl);
                            return true;
                        } else {
                            $this->log->messageLogger('Contact number for this unit has failed to be set.');
                            $this->log->genLogger('Contact number for this unit has failed to be set.');
                            curl_close($cl);
                            return false;
                        }
                    } else {
                        $this->log->messageLogger('Contact number for this unit has failed to be set.');
                        $this->log->genLogger('Contact number for this unit has failed to be set.');
                        curl_close($cl);
                        return false;
                    }
                } catch (Exception $e) {
                    return false;
                }
            }

            public function sendMessage($clientCorrelator, $message) {
                $argVals = array("address"=>$this->getContactNumber(), "message"=>$message, "clientCorrelator"=>"$clientCorrelator");
                $args = http_build_query($argVals);
                $cl = curl_init("https://devapi.globelabs.com.ph/smsmessaging/v1/outbound/".$this::FOUR_DIGIT_CODE."/requests?access_token=".$this->access_Token);
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

            public function isEnabled() {
                $getStatus = $this->pdo->query("SELECT prefValue FROM settings WHERE prefName = 'msg_service'")->fetch(PDO::FETCH_ASSOC)['prefValue'];
                if ($getStatus==1) {
                    return true;
                } else {
                    return false;
                }
            }

            public function toggleService($status) {
                switch ($status) {
                    case $this::SERVICE_ON:
                        $setStatus = $this->pdo->query("UPDATE settings SET prefValue = '1' WHERE prefName = 'msg_service'");
                        break;

                    case $this::SERVICE_OFF:
                        $setStatus = $this->pdo->query("UPDATE settings SET prefValue = '0' WHERE prefName = 'msg_service'");
                        break;
                }
                if (is_object($setStatus)) {
                    return true;
                } else {
                    return false;
                }
            }

            public function getContactNumber() {
                $contactNumber = $this->pdo->query("SELECT prefValue FROM settings WHERE prefName = 'msg_subscriberNumber'")->fetch(PDO::FETCH_ASSOC)['prefValue'];
                return $contactNumber;
            }

            public function getAccessToken() {
                $accessToken = $this->pdo->query("SELECT prefValue FROM settings WHERE prefName = 'msg_accessToken'")->fetch(PDO::FETCH_ASSOC)['prefValue'];
                return $accessToken;
            }
        }
    }