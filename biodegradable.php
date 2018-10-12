<?php
    include_once 'classes/Messenger.php';
    include_once 'classes/Logger.php';
    include_once 'classes/TrashClassifier.php';
    $trashCl = new \pulut\TrashClassifier();
    $messenger = new \pulut\Messenger();
    $log = new \pulut\Logger();

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
            <font style="color: white; font-size: 30px;">Biodegradable Unit</font>
            <div class="ui stackable grid">
                <div class="four wide column">
                    <br />
                    <div style="border-radius: 10px; width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                    </div>
                </div>
                <div class="twelve wide column">
                    <br />
                    <div style="padding: 10px; height: 100%; width: 100%; border-radius: 10px 10px 0 0; background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3), rgba(0, 0, 0, 0.1))">
                        <div class="ui fluid icon input">
                            <input type="text" placeholder="Search...">
                            <i class="search icon"></i>
                        </div>
                        <br /><br />
                        <div style="overflow-y: scroll; max-height: 60%; height: 60%; background-color: rgba(0,0,0,0)">
                            <div class="ui fluid card" id="id1">
                                <div class="content">
                                    <div class="ui equal width stackable grid">
                                        <div class="column">
                                            <div class="header">
                                                Cute Dog
                                            </div>
                                            <div class="meta">
                                                2 days ago
                                            </div>
                                        </div>
                                        <div class="column right aligned">
                                            <button class="ui blue button" onclick="deleteObject('apple peel', 'id1')">Declassify</button>
                                            <button class="ui red button">X</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once "components/endScript.php" ?>
    <script>
        function deleteObject(item, objectID) {
            var XMLHttp = new XMLHttpRequest();
            XMLHttp.onreadystatechange = function () {
                if (this.status == 200 && this.readyState == 4) {
                    if (this.responseText=="GOOD") {
                        $('#'+objectID)
                            .transition('zoom');
                    } else {
                        alert('Cannot delete object! Try again.');
                    }
                }
            };
            XMLHttp.open('POST','async/deleteObject.php', true);
            XMLHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            XMLHttp.send("wasteItem="+item+"&referrer=biodegradable%20unit");
        }
    </script>
    </body>
</html>