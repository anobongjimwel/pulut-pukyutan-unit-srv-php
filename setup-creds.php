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
                    <br /><br />
                    <font style="color: white; font-size: 16px">Step 1:</font><Br />
                    <font style="color: white; font-size: 22px">Type in desired credentials</font>
                    <br /><br />
                    <font style="color: white; font-size: 16px; position: relative; left: -85px;">Username:</font>
                    <br />
                    <div class="ui icon input" style="width: 250px;">
                        <input type="text" placeholder="Username" id="username">
                    </div>
                    <br /><br />
                    <font style="color: white; font-size: 16px; position: relative; left: -85px;">Password:</font>
                    <br />
                    <div class="ui icon input" style="width: 250px;">
                        <input type="password" placeholder="Password" id="password">
                    </div>
                    <br /><br />
                    <button id="btn-setup" class="ui green button" onclick="triggerLoading()">Submit</button>
                </div>
            </div>
        </div>
        <script>
            function triggerLoading(){
                var username = document.getElementById('username');
                var password = document.getElementById('password');
                var loadimg = document.getElementById('loadimg');
                loadimg.src = '<?php echo $path['loadRotate1'] ?>';
                setTimeout(function(){
                    location.href = 'setup-identity.php';
                    if (username.value == "" && password.value == "") {
                        alert("Please fill in the needed credentials");
                    } else {
                        var XMLhttp = new XMLHttpRequest();
                        XMLhttp.onreadystatechange = function () {
                            if (this.status==200&this.readyState==4) {
                                if (this.responseText=="GOOD") {
                                    location.href = "setup-identity.php";
                                } else if (this.responseText=="BAD") {
                                    loadimg.setAttribute('src','<?php echo $path['coloredLogo'] ?>');
                                    btnSetup.style.display = '';
                                }
                            }
                        };
                        XMLhttp.open("POST","/async/setCredentials.php");
                        XMLhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        XMLhttp.send('u='+username.value+"&p="+password.value);
                    }
                }, 5000);
                var btnSetup = document.getElementById('btn-setup');
                btnSetup.style.display = 'none';
            }
        </script>
    </body>
</html>