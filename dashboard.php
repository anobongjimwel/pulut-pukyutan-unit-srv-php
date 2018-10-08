<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to Pulut-Pukyutan!</title>
        <?php include_once 'helpers/gen-inc.php' ?>
        <?php
            include_once 'classes/Logger.php';
            include_once 'classes/Scheduler.php';
            $scheduler = new \pulut\Scheduler();
            $log = new \pulut\Logger();
        ?>
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
                        <div class="meta" id="latestCtr">System Activity</div>
                        <div class="description" id="latestLog">
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
                        <div class="description" style="overflow-y: hidden; overflow-x: scroll;">
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
                            <?php
                            $ctr = 0;
                            foreach ($scheduler->getWeekLongDates(date('Y-m-d')) as $date) {
                                if ($scheduler->compareDate($date)) {
                                    echo $scheduler->returnLongMonthPlural($date)."<br />";
                                    echo ucfirst(strtolower($scheduler->returnShortDate($date)))."<br />";
                                    $ctr+=1;
                                }
                                if ($ctr==3) break;
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="ui card" style="background-color: lightgray;">
                    <div class="content">
                        <div class="header">Biodegradable Log</div>
                        <div class="meta" id="bioCtr">Contents List</div>
                        <div class="description" id="bioLog">
                        </div>
                    </div>
                </div>

                <div class="ui card" style="background-color: lightgray;">
                    <div class="content">
                        <div class="header">Non-Biodegradable Log</div>
                        <div class="meta" id="nonCtr">Contents List</div>
                        <div class="description" id="nonLog">
                        </div>
                    </div>
                </div>

                <div class="ui card" style="background-color: lightgray;">
                    <div class="content">
                        <div class="header">Unspecified Log</div>
                        <div class="meta" id="unsCtr">Contents List</div>
                        <div class="description" id="unsLog">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            setInterval(function() {
                var bioLog = document.getElementById("bioLog");
                var xmlHttp3 = new XMLHttpRequest();
                xmlHttp3.onreadystatechange = function(resp) {
                    if (this.status == 200 && this.readyState == 4) {
                        bioLog.innerText = this.responseText;
                    }
                };
                xmlHttp3.open("GET","async/bioLogReader.php", true);
                xmlHttp3.send();

                var nonLog = document.getElementById("nonLog");
                var xmlHttp4 = new XMLHttpRequest();
                xmlHttp4.onreadystatechange = function(resp) {
                    if (this.status == 200 && this.readyState == 4) {
                        nonLog.innerText = this.responseText;
                    }
                };
                xmlHttp4.open("GET","async/nonLogReader.php", true);
                xmlHttp4.send();

                var unsLog = document.getElementById("unsLog");
                var xmlHttp5 = new XMLHttpRequest();
                xmlHttp5.onreadystatechange = function(resp) {
                    if (this.status == 200 && this.readyState == 4) {
                        unsLog.innerText = this.responseText;
                    }
                };
                xmlHttp5.open("GET","async/unsLogReader.php", true);
                xmlHttp5.send();

                var latestLog = document.getElementById("latestLog");
                var xmlHttp6 = new XMLHttpRequest();
                xmlHttp6.onreadystatechange = function(resp) {
                    if (this.status == 200 && this.readyState == 4) {
                        latestLog.innerText = this.responseText;
                    }
                };
                xmlHttp6.open("GET","async/latestLogReader.php", true);
                xmlHttp6.send();

                var bioCtr = document.getElementById("bioCtr");
                var xmlHttp7 = new XMLHttpRequest();
                xmlHttp7.onreadystatechange = function(resp) {
                    if (this.status == 200 && this.readyState == 4) {
                        bioCtr.innerText = this.responseText;
                    }
                };
                xmlHttp7.open("GET","async/bioLogCounter.php", true);
                xmlHttp7.send();

                var nonCtr = document.getElementById("nonCtr");
                var xmlHttp8 = new XMLHttpRequest();
                xmlHttp8.onreadystatechange = function(resp) {
                    if (this.status == 200 && this.readyState == 4) {
                        nonCtr.innerText = this.responseText;
                    }
                };
                xmlHttp8.open("GET","async/nonLogCounter.php", true);
                xmlHttp8.send();

                var unsCtr = document.getElementById("unsCtr");
                var xmlHttp9 = new XMLHttpRequest();
                xmlHttp9.onreadystatechange = function(resp) {
                    if (this.status == 200 && this.readyState == 4) {
                        unsCtr.innerText = this.responseText;
                    }
                };
                xmlHttp9.open("GET","async/unsLogCounter.php", true);
                xmlHttp9.send();

                var latestCtr = document.getElementById("latestCtr");
                var xmlHttp10 = new XMLHttpRequest();
                xmlHttp10.onreadystatechange = function(resp) {
                    if (this.status == 200 && this.readyState == 4) {
                        latestCtr.innerText = this.responseText;
                    }
                };
                xmlHttp10.open("GET","async/latestLogCounter.php", true);
                xmlHttp10.send();}, 1000);
        </script>
        <?php include_once "components/endScript.php" ?>
    </body>
</html>