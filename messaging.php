<?php
    include_once 'classes/Messenger.php';
    include_once 'classes/Logger.php';
    $messenger = new \pulut\Messenger();
    $log = new \pulut\Logger();

    if (isset($_POST['updateNumber']) && !empty($_POST['subscriberCode'])) {
        $changeNumberStatus = $messenger->setAccessToken($_POST['subscriberCode']);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to Pulut-Pukyutan!</title>
        <?php include_once 'helpers/gen-inc.php' ?>
    </head>
    <body>
        <?php include_once 'components/header.php' ?>
        <div class="fluid container">
            <font style="color: white; font-size: 30px;">Messaging</font>
            <div class="ui stackable grid">
                <div class="four wide column">
                    <br />
                    <div style="border-radius: 10px; width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                        <form method="post" action="messaging.php" >
                            <font style="color: white; font-size: 20px;">Set a new number <i class="circle help icon" title="You need to enter your number upon getting the code in order for the system to know your number and be able to text you when there are notifications"></i></font>
                            <br /><br />
                            <font style="color: white; font-size: 16px;">Subscriber Code:</font><br />
                            <div class="ui fluid input">
                                <input type="text" name="subscriberCode" placeholder="Subscriber Code" id="updInput" onkeyup="updateUpdBtn()">
                            </div>
                            <br />
                            <button type="button" class="ui blue button" onclick="window.open('https://developer.globelabs.com.ph/dialog/oauth/'+'<?php echo $messenger::APP_ID?>','_blank')">Get Code</button>
                            <button type="submit" class="ui green button" id="updBtn" name="updateNumber">Update </button>
                        </form>
                        <?php
                            if (isset($changeNumberStatus)) {
                                if ($changeNumberStatus==1) {
                                    echo "<div class='ui positive message'>Number changed successfully!</div>";
                                } else {
                                    echo "<div class='ui negative message'>Number change failed!</div>";
                                }
                            }
                        ?>
                        <br /><br />
                        <font style="color: white; font-size: 20px;">Messaging Service Status</font><br /><br />
                        <?php
                            if ($messenger->isEnabled()) {
                                echo "<font style=\"color: white; font-size: 18px;\">Messaging Service: Active</font>";
                            } else {
                                echo "<font style=\"color: white; font-size: 18px;\">Messaging Service: Inactive</font>";
                            }
                        ?>
                        <br />
                        <?php
                            echo "<font style=\"color: white; font-size: 18px;\">Unit Contact Number: ".$messenger->getContactNumber()."</font>";
                        ?>
                        <br />
                        <?php
                        echo "<font style=\"color: white; font-size: 18px;\">Unit Access Token:<br />".$messenger->getAccessToken()."</font>";
                        ?>
                        <br /><br /><br />
                        <font style="color: white; font-size: 20px;">Messaging Service Statistics</font><br /><br />
                        <font style="color: white; font-size: 18px;">Today's Log Count:
                        <?php
                            echo $log->countLines("logs/messages/log_".date("mdY").".log"). " Line(s)";
                        ?>
                        </font>
                    </div>
                </div>
                <div class="twelve wide column">
                    <br />
                    <div style="padding: 10px; height: 100%; width: 100%; border-radius: 10px 10px 0 0; background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3), rgba(0, 0, 0, 0.1))">
                        <font style="white-space: pre-wrap; color: white; font-size: 22px;"><?php
                            if (!file_exists("logs/messages/log_" . date("mdY") . ".log")) {
                                echo "No messaging service logs found for today";
                            } else {
                                echo (str_replace('[','<span style="font-size: 15px">[',trim(str_replace('] ',']</span><br />', $log->tailReader("logs/messages/log_" . date("mdY") . ".log", 10, true)))));
                            }
                        ?>
                        </font>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once "components/endScript.php" ?>
    </body>
</html>