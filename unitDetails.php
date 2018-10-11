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
        <title>Pulot-Pukyutan Unit SN-48X53Z</title>
        <?php include_once 'helpers/gen-inc.php' ?>
    </head>
    <body>
        <?php include_once 'components/header.php' ?>
        <div class="fluid container">
            <br /><br />
            <div style="border-radius: 10px; padding: 10px; background: linear-gradient(to bottom, rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0)); min-height: 500px;">
                <br /><br />
                <div class="ui stackable grid">
                    <div class="four wide column"  style="text-align: center; ">
                        <img src="<?php echo $path['coloredLogo'] ?>" style="width: 200px" />
                    </div>
                    <div class="twelve wide column">
                        <font style="color: white; font-size: 30px;">Pulut Pukyutan</font><br />
                        <font style="color: white; font-size: 22px;">Unit SN-48X53Z</font><br />
                        <br /><br />
                        <font style="color: white; font-size: 20px">An artificial-intelligence based trash segregation management system.<br />
                        Designed with a certain goal to minimize time took to throw trash in trash cans.
                        <br /><br />
                        Programmed and Developed by:<br />
                        Jimwel Trabado Anobong<br />
                        Michael Lomboy<br />
                        Precyl Intan
                        <br /><br /><br /><br /><br />
                        ©<?php echo date("Y") ?> Pulut Pukyutan Inc.</font>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once "components/endScript.php" ?>
    </body>
</html>