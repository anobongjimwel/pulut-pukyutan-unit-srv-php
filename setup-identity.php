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
                    <img id="loadimg" src="<?php echo $path['coloredLogo'] ?>" style="width: 50px;"/>
                    <br />
                    <font style="color: white; font-size: 16px">Step 2:</font><Br />
                    <font style="color: white; font-size: 22px">Type in details</font>
                    <br /><br />
                    <font style="color: white; font-size: 16px; position: relative; left: -85px;">Full Name:</font>
                    <br />
                    <div class="ui icon input" style="width: 250px;">
                        <input type="text" placeholder="Full Name">
                    </div>
                    <br /><br />
                    <font style="color: white; font-size: 16px; position: relative; left: -95px;">Subtitle:</font>
                    <br />
                    <div class="ui icon input" style="width: 250px;">
                        <input type="password" placeholder="Subtitle">
                    </div>
                    <br /><br />
                    <button id="btn-setup" class="ui green button" onclick="triggerLoading()">Submit</button>
                </div>
            </div>
        </div>
        <script>
            function triggerLoading(){
                var loadimg = document.getElementById('loadimg');
                loadimg.src = "<?php echo $path['loadRotate1'] ?>";
                setTimeout(function(){
                    location.href = 'setup-complete.php';
                }, 5000);
            }
        </script>
    </body>
</html>