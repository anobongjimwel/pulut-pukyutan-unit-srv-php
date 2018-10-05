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
                        <form method="post" action="schedules.php">
                            <div class="ui toggle checkbox" style="border-radius: 10px 10px 0 0; width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                                <input id="sunday" type="checkbox" name="newsletter">
                                <label for="sunday" style="color: white !important">Monday</label>
                            </div>
                            <br />
                            <div class="ui toggle checkbox" style="width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                                <input id="monday" type="checkbox" name="newsletter">
                                <label for="monday" style="color: white !important">Tuesday</label>
                            </div>
                            <br />
                            <div class="ui toggle checkbox" style="width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                                <input id="tuesday" type="checkbox" name="newsletter">
                                <label for="tuesday" style="color: white !important">Tuesday</label>
                            </div>
                            <br />
                            <div class="ui toggle checkbox" style="width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                                <input id="wednesday" type="checkbox" name="newsletter">
                                <label for="wednesday"  style="color: white !important">Wednesday</label>
                            </div>
                            <br />
                            <div class="ui toggle checkbox" style="width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                                <input id="thursday" type="checkbox" name="newsletter">
                                <label for="thursday"  style="color: white !important">Thursday</label>
                            </div>
                            <br />
                            <div class="ui toggle checkbox" style="width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                                <input id="friday" type="checkbox" name="newsletter">
                                <label for="friday"  style="color: white !important">Friday</label>
                            </div>
                            <br />
                            <div class="ui toggle checkbox" style="border-radius: 0 0 10px 10px;width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                                <input id="saturday" type="checkbox" name="newsletter">
                                <label for="saturday"  style="color: white !important">Saturday</label>
                            </div>
                            <br /><br />
                            <button class="ui button rounded blue" type="submit">Update Schedules</button>
                        </form>
                        <br /><br />
                        <font style="font-size: 20px; color: white" id="msg">Schedules of collection updated!</font>
                    </div>
                    <div class="twelve wide column stackable">
                        <br />
                        <div style="padding: 10px; height: 100%; width: 100%; border-radius: 10px 10px 0 0; background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3), rgba(0, 0, 0, 0.1))">
                            <font style="font-size: 20px; color: white">Upcoming Schedules of Trash Collection</font>
                            <br /><br />
                            <div class="ui grid">
                                <div class="one wide column" style="color: white">
                                    <font style="font-size: 23px;">OCT</font>
                                    <br /><font style="font-size: 40px;">22</font>
                                </div>
                                <div class="fifteen wide column" style="color: white">
                                    <br />
                                    <font style="font-size: 40px;">Sunday, October 2, 2018 (Asia/Manila, GMT +8:00)</font>
                                </div>
                            </div>

                            <div class="ui grid">
                                <div class="one wide column" style="color: white">
                                    <font style="font-size: 23px;">OCT</font>
                                    <br /><font style="font-size: 40px;">22</font>
                                </div>
                                <div class="fifteen wide column" style="color: white">
                                    <br />
                                    <font style="font-size: 40px;">Sunday, October 2, 2018 (Asia/Manila, GMT +8:00)</font>
                                </div>
                            </div>

                            <div class="ui grid">
                                <div class="one wide column" style="color: white">
                                    <font style="font-size: 23px;">OCT</font>
                                    <br /><font style="font-size: 40px;">22</font>
                                </div>
                                <div class="fifteen wide column" style="color: white">
                                    <br />
                                    <font style="font-size: 40px;">Sunday, October 2, 2018 (Asia/Manila, GMT +8:00)</font>
                                </div>
                            </div>

                            <div class="ui grid">
                                <div class="one wide column" style="color: white">
                                    <font style="font-size: 23px;">OCT</font>
                                    <br /><font style="font-size: 40px;">22</font>
                                </div>
                                <div class="fifteen wide column" style="color: white">
                                    <br />
                                    <font style="font-size: 40px;">Sunday, October 2, 2018 (Asia/Manila, GMT +8:00)</font>
                                </div>
                            </div>

                            <div class="ui grid">
                                <div class="one wide column" style="color: white">
                                    <font style="font-size: 23px;">OCT</font>
                                    <br /><font style="font-size: 40px;">22</font>
                                </div>
                                <div class="fifteen wide column" style="color: white">
                                    <br />
                                    <font style="font-size: 40px;">Sunday, October 2, 2018 (Asia/Manila, GMT +8:00)</font>
                                </div>
                            </div>
                    </div>
                </div>
        </div>
        <?php include_once "components/endScript.php" ?>
    </body>
</html>