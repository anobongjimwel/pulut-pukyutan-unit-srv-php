<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to Pulut-Pukyutan!</title>
        <?php include_once 'helpers/gen-inc.php' ?>
        <script>
            function submitAddQuery() {
                var objectName = document.getElementById('objectName-AdderWidget');
                var objectType = document.getElementById('objectType-AdderWidget');
                var XMLHttp = new XMLHttpRequest();
                XMLHttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {

                    }
                };
                XMLHttp.open("POST","async/db_addWasteObj.php", true);
                XMLHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                XMLHttp.send("objectName="+objectName.value+"&objectType="+objectType.value);

                $('.message .close')
                    .closest('.message')
                    .setAttribute('style','position: fixed; top: 10px; left: 30%; right: 30%; z-index: 1000')
                    .transition('fade')
                ;
            }
        </script>
    </head>


    <body>
        <?php include_once 'components/header.php' ?>
        <div class="fluid container">
           <font style="color: white; font-size: 30px;">Schedules</font>
                <div class="ui grid">
                    <div class="four wide column stackable">
                        <br />
                        <div class="ui toggle checkbox" style="border-radius: 10px 10px 0 0; width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                            <input type="checkbox" name="newsletter">
                            <label style="color: white !important">Monday</label>
                        </div>
                        <br />
                        <div class="ui toggle checkbox" style="width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                            <input type="checkbox" name="newsletter">
                            <label style="color: white !important">Tuesday</label>
                        </div>
                        <br />
                        <div class="ui toggle checkbox" style="width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                            <input type="checkbox" name="newsletter">
                            <label style="color: white !important">Wednesday</label>
                        </div>
                        <br />
                        <div class="ui toggle checkbox" style="width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                            <input type="checkbox" name="newsletter">
                            <label style="color: white !important">Thursday</label>
                        </div>
                        <br />
                        <div class="ui toggle checkbox" style="width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                            <input type="checkbox" name="newsletter">
                            <label style="color: white !important">Friday</label>
                        </div>
                        <br />
                        <div class="ui toggle checkbox" style="border-radius: 0 0 10px 10px;width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                            <input type="checkbox" name="newsletter">
                            <label style="color: white !important">Saturday</label>
                        </div>
                        <br /><br />
                        <button class="ui button rounded blue">Update Schedules</button>
                    </div>
                    <div class="twelve wide column stackable">
a
                    </div>
                </div>
        </div>
        <?php include_once "components/endScript.php" ?>
    </body>
</html>