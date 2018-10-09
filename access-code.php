<?php
    /*
    if (!(isset($_GET['service']) && $_GET['service']=="globe" && isset($_GET['key']) && $_GET['key']=="511sdac56zx65ca65sd04zxc56a654sdx2vzx19a850cx30" && !empty($_GET['code']))) {
        header("Location: dashboard.php");
    }
    include_once "classes/Logger.php";
    $log = new \pulut\Logger();
    $log->messageLogger("Subscriber code provided (".$_GET['code'].")");
    */
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
            <font style="color: white; font-size: 30px;">Access Code</font>
            <br />
            <font style="color: white; font-size: 20px;">This code is provided by our partner Globe<sup>®</sup>. You may use this code in order for our system to be permitted to send you reminders based on what you set</font>
            <br /><br /><br />
            <div id="accessCode" style="background-color: rgba(255, 255, 255, 0.4); border-radius: 10px; width: 100%; padding: 10px; overflow-wrap: break-word; line-height: 1.2">
                <font style="color: white; font-size: 30px;"><?php echo $_GET['code']?></font>
            </div>
            <br />
            <button class="ui red button" onclick="window.close()">Close window</button>
        </div>
        <?php include_once "components/endScript.php" ?>
    </body>
</html>