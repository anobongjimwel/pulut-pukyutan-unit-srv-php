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
            <div class="ui four stackable column cards">
                <div class="ui card" style="background-color: lightgray">
                    <div class="content">
                        <div class="header">Waste Unit Status</div>
                        <div class="meta">All Good</div>
                        <div class="description">
                            <div class="ui list">
                                <div class="item">
                                    <div class="right floated content">
                                        <i class="green circle icon"></i>
                                    </div>
                                    <i class="trash icon"></i>
                                    <div class="content">
                                        Biodegradable
                                    </div>
                                </div>
                            </div>
                            <div class="ui list">
                                <div class="item">
                                    <div class="right floated content">
                                        <i class="green circle icon"></i>
                                    </div>
                                    <i class="trash icon"></i>
                                    <div class="content">
                                        Non-Biodegradable
                                    </div>
                                </div>
                            </div>
                            <div class="ui list">
                                <div class="item">
                                    <div class="right floated content">
                                        <i class="green circle icon"></i>
                                    </div>
                                    <i class="trash icon"></i>
                                    <div class="content">
                                        Unspecifieds
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui card" style="background-color: lightgray">
                    <div class="content">
                        <div class="header">Latest Log</div>
                        <div class="meta">1024 Lines</div>
                        <div class="description">
                            [JUN 18 2018, 18: 35]<br />
                            An instance of a bottle was thrown<br />
                            [JUN 18 2018, 18: 35]<br />
                            An instance of a bottle was thrown<br />
                            [JUN 18 2018, 18: 35]<br />
                            An instance of a bottle was thrown<br />
                        </div>
                    </div>
                </div>

                <div class="ui card" style="background-color: lightgray;">
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['gauge']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {

                            var data = google.visualization.arrayToDataTable([
                                ['Label', 'Value'],
                                ['Memory', 0],
                                ['CPU', 0],
                                ['Biodeg', 42],
                                ['NonBio', 35],
                                ['Unspec', 84]
                            ]);

                            var options = {
                                width: 600, height: 150,
                                redFrom: 90, redTo: 100,
                                yellowFrom:75, yellowTo: 90,
                                minorTicks: 5
                            };

                            var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

                            chart.draw(data, options);

                            setInterval(function() {
                                var xmlHttp = new XMLHttpRequest();
                                xmlHttp.onreadystatechange = function(resp) {
                                    if (this.status == 200 && this.readyState == 4) {
                                        data.setValue(0, 1, this.responseText);
                                    }
                                };
                                xmlHttp.open("GET","async/memUsage.php", true);
                                xmlHttp.send();

                                var xmlHttp2 = new XMLHttpRequest();
                                xmlHttp2.onreadystatechange = function(resp) {
                                    if (this.status == 200 && this.readyState == 4) {
                                        data.setValue(1, 1, this.responseText);
                                    }
                                };
                                xmlHttp2.open("GET","async/CPU.php", true);
                                xmlHttp2.send();

                                chart.draw(data, options);
                            }, 1000);
                        }
                    </script>

                    <div class="content">
                        <div class="header">System Metrics</div>
                        <div class="meta">Quantifiable Details</div>
                        <div class="description">
                            <div id="chart_div" style="width: 400px; height: 120px;"></div>
                        </div>
                    </div>
                </div>

                <div class="ui card" style="background-color: lightgray;">
                    <div class="content">
                        <div class="header">Quick Input</div>
                        <div class="meta">Add objects to database</div>
                        <div class="description">
                            <div class="ui fluid input">
                                <input type="text" placeholder="Object Name" name="objectName" id="objectName-AdderWidget">
                            </div>
                            <div class="ui fluid selection dropdown" id="quickAddObjectType">
                                <input type="hidden" name="objectType" id="objectType-AdderWidget">
                                <i class="dropdown icon"></i>
                                <div class="default text">Object Type</div>
                                <div class="menu">
                                    <div class="item" data-value="biodegradable">Biodegradable</div>
                                    <div class="item" data-value="non-biodegradable">Non-biodegradable</div>
                                </div>
                            </div>
                            <button class="ui right floated black button" onclick="submitAddQuery()">
                                Add
                            </button>
                        </div>
                    </div>
                </div>

                <div class="ui card" style="background-color: lightgray;">
                    <div class="content">
                        <div class="header">Tallied Maximums</div>
                        <div class="meta">Waste Containers</div>
                        <div class="description">
                            <div class="ui list">
                                <div class="item">
                                    <div class="right floated content">
                                        99 Objs.
                                    </div>
                                    <i class="trash icon"></i>
                                    <div class="content">
                                        Biodegradable
                                    </div>
                                </div>
                            </div>
                            <div class="ui list">
                                <div class="item">
                                    <div class="right floated content">
                                        102 Objects
                                    </div>
                                    <i class="trash icon"></i>
                                    <div class="content">
                                        Non-Biodegradable
                                    </div>
                                </div>
                            </div>
                            <div class="ui list">
                                <div class="item">
                                    <div class="right floated content">
                                        15
                                    </div>
                                    <i class="trash icon"></i>
                                    <div class="content">
                                        Unspecifieds
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ui card" style="background-color: lightgray;">
                    <div class="content">
                        <div class="header">Content Estimates</div>
                        <div class="meta">Waste Containers</div>
                        <div class="description">
                            <div id="chart_div" style="width: 400px; height: 120px;"></div>
                        </div>
                    </div>
                </div>

                <div class="ui card" style="background-color: lightgray;">
                    <div class="content">
                        <div class="header">Reminders</div>
                        <div class="meta">Waste Colleciton</div>
                        <div class="description">
                            TUESDAYS<br />
                            September XX, XXXX<br />
                            FRIDAYS<br />
                            September xX, XXXX<br />
                            SATURDAYS<br />
                            September XX, XXXX<br />
                        </div>
                    </div>
                </div>

                <div class="ui card" style="background-color: lightgray;">
                    <div class="content">
                        <div class="header">Biodegradable Log</div>
                        <div class="meta">Contents List</div>
                        <div class="description">
                            <div id="chart_div" style="width: 400px; height: 120px;"></div>
                        </div>
                    </div>
                </div>

                <div class="ui card" style="background-color: lightgray;">
                    <div class="content">
                        <div class="header">Non-Biodegradable Log</div>
                        <div class="meta">Contents List</div>
                        <div class="description">
                            <div id="chart_div" style="width: 400px; height: 120px;"></div>
                        </div>
                    </div>
                </div>

                <div class="ui card" style="background-color: lightgray;">
                    <div class="content">
                        <div class="header">Unspecified Log</div>
                        <div class="meta">Contents List</div>
                        <div class="description">
                            <div id="chart_div" style="width: 400px; height: 120px;"></div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <?php include_once "components/endScript.php" ?>
    </body>
</html>