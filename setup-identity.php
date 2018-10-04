<?php
    include_once "classes/Securer.php";
    $secure = new \pulut\Securer();
    if ($secure->checkIfLoggedIn()) {
        header("Location: dashboard.php");
    } else if (!$secure->checkIfCredentialSet()) {
        header("Location: setup-creds.php");
    } else if ($secure->checkIfInformationSet()) {
        header("Location: setup-complete.php");
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
                    <img id="loadimg" src="<?php echo $path['coloredLogo'] ?>" style="width: 50px;"/>
                    <br />
                    <font style="color: white; font-size: 16px">Step 2:</font><Br />
                    <font style="color: white; font-size: 22px">Type in details</font>
                    <br /><br />
                    <font style="color: white; font-size: 16px; position: relative; left: -85px;">Full Name:</font>
                    <br />
                    <div class="ui icon input" style="width: 250px;">
                        <input type="text" placeholder="Full Name" id="fullname">
                    </div>
                    <br /><br />
                    <font style="color: white; font-size: 16px; position: relative; left: -95px;">Subtitle:</font>
                    <br />
                    <div class="ui icon input" style="width: 250px;">
                        <input type="text" placeholder="Subtitle" id="subtitle">
                    </div>
                    <br /><br />
                    <button id="btn-setup" class="ui green button" onclick="triggerLoading()">Submit</button>
                </div>
            </div>
        </div>
        <script>
            function triggerLoading(){
                var fullname = document.getElementById('fullname');
                var subtitle = document.getElementById('subtitle');
                var loadimg = document.getElementById('loadimg');
                loadimg.src = '<?php echo $path['loadRotate1'] ?>';
                setTimeout(function(){
                    location.href = 'setup-identity.php';
                    if (fullname.value == "" && subtitle.value == "") {
                        alert("Please fill in the needed personal information");
                    } else {
                        var XMLhttp = new XMLHttpRequest();
                        XMLhttp.onreadystatechange = function () {
                            if (this.status==200&this.readyState==4) {
                                if (this.responseText=="GOOD") {
                                    location.href = "setup-complete.php";
                                } else if (this.responseText=="BAD") {
                                    loadimg.setAttribute('src','<?php echo $path['coloredLogo'] ?>');
                                    btnSetup.style.display = '';
                                }
                            }
                        };
                        XMLhttp.open("POST","/async/setIdentity.php");
                        XMLhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        XMLhttp.send('f='+fullname.value+"&s="+subtitle.value);
                    }
                }, 5000);
                var btnSetup = document.getElementById('btn-setup');
                btnSetup.style.display = 'none';
            }
        </script>
    </body>
</html>