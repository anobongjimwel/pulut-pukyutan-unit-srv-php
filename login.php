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
                    <div style="box-shadow: 0 0 20px gray; border: 1px solid white; width: 300px; display: inline-block; background-color: white">
                        <br />
                        <img id="loadimg" src="<?php echo $path['coloredLogo'] ?>" style="width: 50px;"/><br />
                        <font style="font-size: 22px">Pulut Pukyutan</font><br />
                        <font style="font-size: 18px">Unit SN-48X53Z</font>
                        <br />
                        <br /><br />
                        <font style="font-size: 16px; position: relative; left: -85px;">Username:</font>
                        <br />
                        <div class="ui icon input" style="width: 250px;">
                            <input type="text" placeholder="Username" id="username">
                        </div>
                        <br /><br />
                        <font style="font-size: 16px; position: relative; left: -88px;">Password:</font>
                        <br />
                        <div class="ui icon input" style="width: 250px;">
                            <input type="password" placeholder="Password" id="password">
                        </div>
                        <br /><br /><br /><br />
                        <button id="btn-reset" type="reset" onclick="credReset()" class="ui red button">Reset</button>
                        <button id="btn-setup" class="ui green button" onclick="triggerLoading()">Submit</button>
                        <br /><br />
                    </div>
                </div>
            </div>
        </div>
        <script>
            function triggerLoading() {
                var username = document.getElementById('username');
                var password = document.getElementById('password');
                var loadimg = document.getElementById('loadimg');
                var btnsetup = document.getElementById('btn-setup');
                var btnreset = document.getElementById('btn-reset');
                loadimg.src = '<?php echo $path['loadRotate1']?>';
                btnsetup.setAttribute('disabled', 'true');
                btnreset.setAttribute('disabled', 'true');
                if (username.value == '' && password.value == '') {
                    alert('Please fill in the credentials needed!');
                    loadimg.src = '<?php echo $path['coloredLogo']?>';
                } else {
                    setTimeout(function () {
                        var XMLhttp = new XMLHttpRequest();
                        XMLhttp.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {
                                if (this.response == 'GOOD') {
                                    location.href = 'dashboard.php';
                                } else {
                                    loadimg.src = '<?php echo $path['coloredLogo']?>';
                                    location.href='dashboard.php';
                                }
                            }
                        };
                        XMLhttp.open('POST', 'async/logger.php', true);
                        XMLhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                        XMLhttp.send('u=' + username.value + '&p=' + password.value);
                    }, 5000);
                }
            }

            function credReset() {
                var username = document.getElementById('username');
                var password = document.getElementById('password');
                username.value = '';
                password.value = '';
            }
        </script>
    </body>
</html>