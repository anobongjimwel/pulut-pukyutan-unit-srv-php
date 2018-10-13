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
                        <font style="color: white; font-size: 20px;">Add a Biodegradable Object</font>
                        <br /><br />
                        <div class="ui fluid input">
                            <input type="text" placeholder="Object Name" id="updInput">
                        </div>
                        <br />
                        <button type="button" class="ui green button" id="updBtn">Add</button>
                        <button type="button" class="ui red button" id="resetBtn">Reset</button>
                    </div>
                    <br />
                    <div style="border-radius: 10px; width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                        <font style="color: white; font-size: 20px;">Biodegradable Unit Information</font>
                    </div>
                </div>
                <div class="twelve wide column">
                    <br />
                    <div style="padding: 10px; height: 100%; width: 100%; border-radius: 10px 10px 0 0; background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3), rgba(0, 0, 0, 0.1))">
                        <div class="ui fluid icon input">
                            <input type="text" placeholder="Search..." id="searchField">
                            <i class="search icon"></i>
                        </div>
                        <br /><br />
                        <div style="overflow-y: scroll; max-height: 90%; height: 90%; background-color: rgba(0,0,0,0)" id="queryResults">

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
                            objectID
                                .transition('scale')
                                .queue(200)
                                .hide();
                        } else {
                            alert('Cannot delete instance of "'+item+'" object! Try again.');
                        }
                    }
                };
                XMLHttp.open('POST','async/deleteObject.php', true);
                XMLHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                XMLHttp.send("wasteItem="+item+"&referrer=biodegradable");
            }

            function declassifyObject(item, objectID) {
                var XMLHttp = new XMLHttpRequest();
                XMLHttp.onreadystatechange = function () {
                    if (this.status == 200 && this.readyState == 4) {
                        if (this.responseText=="GOOD") {
                            objectID
                                .transition('fade')
                                .queue(200)
                                .hide();
                        } else {
                            alert('Cannot delete instance of "'+item+'" object! Try again.');
                        }
                    }
                };
                XMLHttp.open('POST','async/declassifyObject.php', true);
                XMLHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                XMLHttp.send("wasteItem="+item+"&referrer=biodegradable");
            }

            $('#searchField').keyup(function() {
                var XMLHttp = new XMLHttpRequest;
                XMLHttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        $('#queryResults').html(this.response);
                    }
                };
                XMLHttp.open('POST','async/bdgblpg_helper.php', true);
                XMLHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                XMLHttp.send('query='+$('#searchField').val()+'&referrer=biodegradable');
            });

            function updateQuery() {
                var XMLHttp = new XMLHttpRequest;
                XMLHttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        $('#queryResults').html(this.response);
                    }
                };
                XMLHttp.open('POST', 'async/bdgblpg_helper.php', true);
                XMLHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                XMLHttp.send('query=' + $('#searchField').val() + '&referrer=biodegradable');
            }

            $('#updBtn').click(function() {
                var XMLHttp = new XMLHttpRequest();
                XMLHttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText=='2') {
                            alert('Object "'+$('#updInput').val()+'" has been successfully added as a biodegradable object.');
                            updateQuery();
                        } else {
                            alert('Object "'+$('#updInput').val()+'" failed to be added as biodegradable object.');
                        }
                        $('#updInput').val("");
                    }
                };
                XMLHttp.open('POST','async/addWasteObj.php');
                XMLHttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                XMLHttp.send('objectName='+$('#updInput').val()+"&objectType=biodegradable");

            });

            $('#resetBtn').click(function() {
                $('#updInput').val('');
                $('#updInput').focus();
            })

            updateQuery();
        </script>
    </body>
</html>