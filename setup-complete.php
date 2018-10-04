<?php
include_once "classes/Securer.php";
$secure = new \pulut\Securer();
if ($secure->checkIfLoggedIn()) {
    header("Location: dashboard.php");
} else {
    if (!$secure->checkIfCredentialSet()) {
        header("Location: setup-creds.php");
    } else if (!$secure->checkIfInformationSet()) {
        header("Location: setup-identity.php");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to Pulut-Pukyutan!</title>
        <?php include_once 'helpers/gen-inc.php' ?>
    </head>
    <body>
        <div class="fluid container">
            <div style="display: table-row; height: 100vh; width: 100vw">
                <div class="items" style="display: table-cell; width: 100vw; vertical-align: middle !important; text-align: center">
                    <img id="loadimg" src="<?php echo $path['coloredLogo'] ?>" style="color: white; width: 50px;"/>
                    <br /><br />
                    <font style="color: white; font-size: 16px">Your Pulot-Pukyutan Unit has been Set-up</font><Br />
                    <br />
                    <font style="color: white; font-size: 32px">Proceed to Login Page</font>
                    <br /><br />
                    <br />
                    <button id="btn-setup" class="ui green button" onclick="triggerLoading()">Login</button>
                </div>
            </div>
        </div>
        <script>
            function triggerLoading(){
                var loadimg = document.getElementById('loadimg');
                loadimg.src = "<?php echo $path['loadRotate1'] ?>";
                setTimeout(function() {
                    location.href = 'login.php';
                }, 4000);
            }

            $('.message .close')
                .on('click', function() {
                    $(this)
                        .closest('.message')
                        .transition('fade')
                    ;
                })
            ;
        </script>
    </body>
</html>