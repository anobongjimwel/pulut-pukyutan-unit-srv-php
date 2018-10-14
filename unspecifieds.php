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
            <font style="color: white; font-size: 30px;">Unspecified Unit</font>
            <div class="ui stackable grid">
                <div class="four wide column">
                    <br />
                    <div style="border-radius: 10px; width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                        <font style="color: white; font-size: 20px;">Non-Biodegradable Unit Information</font>
                        <br /><br />
                        <div class="ui equal width grid">
                            <div class="column">
                                <font style="color: white; font-size: 20px" id="contentCount">X</font><br />
                                <font style="color: white; font-size: 14px">Contents</font><br />
                                <br />
                                <font style="color: white; font-size: 20px" id="classifiedObjs">X</font><br />
                                <font style="color: white; font-size: 14px">Classified Objs</font><br />
                            </div>
                            <div class="column">
                                <font style="color: white; font-size: 20px" id="maximumObj">X</font><br />
                                <font style="color: white; font-size: 14px">Maximum</font><br />
                            </div>
                        </div>
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
                        <div style="max-height: 90%; height: 90%; background-color: rgba(0,0,0,0)" >
                            <div class="ui cards" style="overflow-y: scroll;" id="queryResults">
                                <div class="card">
                                    <div class="image">
                                        <img src="resources/images/defaultTrashIcon.jpg">
                                    </div>
                                    <div class="content">
                                        <div class="header">
                                            Elliot Fu
                                        </div>
                                        <div class="meta">
                                            Friends of Veronika
                                        </div>
                                        <div class="description">
                                            Elliot requested permission to view your contact details
                                        </div>
                                    </div>
                                    <div class="extra content">
                                        <div class="ui three buttons">
                                            <div class="ui green button">Biodeg</div>
                                            <div class="ui blue button">NonBio</div>
                                            <div class="ui red button">Delete</div>
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
                            setMaximum();
                            setCounter();
                            setClassifiedObjs();
                            objectID
                                .transition('scale')
                                .queue(200)
                                .hide();
                        } else {
                            alert('Cannot delete instance of "'+item+'" object! Try again.');
                        }
                    }
                    setMaximum();
                    setCounter();
                    setClassifiedObjs();
                };
                XMLHttp.open('POST','async/deleteObject.php', true);
                XMLHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                XMLHttp.send("wasteItem="+item+"&referrer=nonbiodegradable");
            }

            function classifyObject(item, objectID) {
                var XMLHttp = new XMLHttpRequest();
                XMLHttp.onreadystatechange = function () {
                    if (this.status == 200 && this.readyState == 4) {
                        if (this.responseText=="GOOD") {
                            setMaximum();
                            setCounter();
                            setClassifiedObjs();
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
                XMLHttp.send("wasteItem="+item+"&referrer=nonbiodegradable");
            }

            $('#searchField').keyup(function() {
                var XMLHttp = new XMLHttpRequest;
                XMLHttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        $('#queryResults').html(this.response);
                    }
                };
                XMLHttp.open('POST','async/unspg_helper.php', true);
                XMLHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                XMLHttp.send('query='+$('#searchField').val()+'&referrer=unspecified');
            });

            function updateQuery() {
                var XMLHttp = new XMLHttpRequest;
                XMLHttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        $('#queryResults').html(this.response);
                    }
                };
                XMLHttp.open('POST', 'async/unspg_helper.php', true);
                XMLHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                XMLHttp.send('query=' + $('#searchField').val() + '&referrer=unspecified');
            }

            function setCounter() {
                var XMLHttp = new XMLHttpRequest();
                XMLHttp.onreadystatechange = function() {
                    $('#contentCount').text(this.responseText);
                };
                XMLHttp.open('GET','async/nonContentCounter.php');
                XMLHttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                XMLHttp.send();
            }

            function setMaximum() {
                var XMLHttp = new XMLHttpRequest();
                XMLHttp.onreadystatechange = function() {
                    $('#maximumObj').text(this.responseText);
                };
                XMLHttp.open('GET','async/nonMaxCounter.php');
                XMLHttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                XMLHttp.send();
            }

            function setClassifiedObjs() {
                var XMLHttp = new XMLHttpRequest();
                XMLHttp.onreadystatechange = function () {
                    $('#classifiedObjs').text(this.responseText);
                };
                XMLHttp.open('GET', 'async/nonObjectsClassified.php');
                XMLHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                XMLHttp.send();
            }

            setClassifiedObjs();
            setMaximum();
            setCounter();
        </script>
    </body>
</html>