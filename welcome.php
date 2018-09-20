<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to Pulut-Pukyutan!</title>
        <?php include_once 'helpers/gen-inc.php' ?>
    </head>
    <body style="background-image: url('resources/images/e-waste-bg.jpg')">
        <div class="fluid container">
            <div style="display: table-row; height: 100vh; width: 100vw">
                <div class="items" style="display: table-cell; width: 100vw; vertical-align: middle !important; text-align: center">
                    <img id="loadimg" src="resources/images/pulut-logo-colored.png" style="width: 100px;"/>
                    <br /><br />
                    <font style="color: white; font-size: 30px">Welcome to Pulut-Pukyutan</font>
                    <br /><br />
                    <font style="color: white; font-size: 22px">Conquering the world of waste, one thing at a time.</font>
                    <br /><br />
                    <button id="btn-setup" class="ui green button" onclick="triggerLoading()">Setup</button>
                </div>
            </div>
        </div>
        <script>
            function triggerLoading(){
                var loadimg = document.getElementById('loadimg');
                loadimg.src = 'images/load-rotate1.gif';
                setTimeout(function(){
                    location.href = 'setup-creds.php';
                }, 5000);
                var btnSetup = document.getElementById('btn-setup');
                btnSetup.style.display = 'none';
            }
        </script>
    </body>
</html>