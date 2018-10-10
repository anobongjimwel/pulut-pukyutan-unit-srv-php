<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to Pulut-Pukyutan!</title>
        <?php include_once 'helpers/gen-inc.php' ?>
        <?php
            include_once 'classes/Logger.php';
            include_once 'classes/TrashMonitor.php';
            $log = new \pulut\Logger();
            $trashMon = new \pulut\TrashMonitor();
            function compareProgress($firstArg, $secondArg) {
                if ($firstArg == 0) {
                    $fctValue = number_format($secondArg * 100, 2);
                } else if ($secondArg == 0) {
                    $fctValue = number_format($firstArg * 100, 2);
                } else {
                    $fctValue = number_format($firstArg / $secondArg * 100, 2);
                }
                if ($firstArg == $secondArg) {
                    echo "<span style='color: blue; font-size: 15px'><i class='minus icon'></i>$fctValue</span>";
                } else if ($firstArg > $secondArg) {
                    echo "<span style='color: red; font-size: 15px'><i class='arrow down icon'></i>$fctValue</span>";
                } else if ($firstArg < $secondArg) {
                    echo "<span style='color: green; font-size: 15px'><i class='arrow up icon'></i>$fctValue</span>";
                }
            }

            function fiveDayAverage($filePath) {
                $average = 0;
                $log = new \pulut\Logger();
                for ($i=5; $i>=1; $i--) {
                    $average+=$log->countLines($filePath."/log_".date("mdY",strtotime("-$i days")).".log");
                }
                return number_format($average/5,0);
            }

            function lateFiveDayAverage($filePath) {
                $average = 0;
                $log = new \pulut\Logger();
                for ($i=10; $i>=6; $i--) {
                    $average+=$log->countLines($filePath."/log_".date("mdY",strtotime("-$i days")).".log");
                }
                return number_format($average/5,0);
            }
        ?>
        <style>
            .ui.card {
                min-height: 220px !important;
            }
        </style>
    </head>
    <body>
        <?php include_once 'components/header.php' ?>
        <div class="fluid container">
            <font style="color: white; font-size: 30px;">Statistics</font><br /><br />
            <div class="ui four stackable column cards">
                <div class="ui card" style="background-color: lightgray">
                    <div class="content">
                        <div class="header">System Activity</div>
                        <div class="description">
                            <div class="ui equal width grid">
                                <div class="column">
                                    <font style="font-size: 20px"><?php echo $log->countLines("logs/log_".date("mdY").".log")?> </font><?php compareProgress($log->countLines("logs/log_".date("mdY",strtotime('-1 day')).".log"), $log->countLines("log/log_".date("mdY").".log")) ?><br />
                                    <font style="font-size: 14px">Overall Activity</font><br />
                                </div>
                                <div class="column">
                                    <font style="font-size: 20px"><?php echo fiveDayAverage("logs")?> </font><?php compareProgress(lateFiveDayAverage("logs"),fiveDayAverage("logs")) ?><br />
                                    <font style="font-size: 14px">Five Day Average</font><br />
                                </div>
                            </div>
                            <canvas id="sysActivity" style="width: 100%; height: 180px"></canvas>
                        </div>
                    </div>
                </div>

                <div class="ui card" style="background-color: lightgray">
                    <div class="content">
                        <div class="header">Biodegradeable Unit</div>
                        <div class="description">
                            <div class="ui equal width grid">
                                <div class="column">
                                    <font style="font-size: 20px"><?php echo $log->countLines("logs/biodegradeable/log_".date("mdY").".log")?> </font><?php compareProgress($log->countLines("logs/biodegradeable/log_".date("mdY",strtotime('-1 day')).".log"), $log->countLines("log/biodegradeable/log_".date("mdY").".log")) ?><br />
                                    <font style="font-size: 14px">Overall Activity</font><br />
                                </div>
                                <div class="column">
                                    <font style="font-size: 20px"><?php echo fiveDayAverage("logs/biodegradeable")?> </font><?php compareProgress(lateFiveDayAverage("logs/biodegradeable"),fiveDayAverage("logs/biodegradeable")) ?><br />
                                    <font style="font-size: 14px">Five Day Average</font><br />
                                </div>
                            </div>
                            <canvas id="bioActivity" style="width: 100%; height: 180px"></canvas>
                        </div>
                    </div>
                </div>

                <div class="ui card" style="background-color: lightgray">
                    <div class="content">
                        <div class="header">Non-Biodegradeable Unit</div>
                        <div class="description">
                            <div class="ui equal width grid">
                                <div class="column">
                                    <font style="font-size: 20px"><?php echo $log->countLines("logs/biodegradeable/log_".date("mdY").".log")?> </font><?php compareProgress($log->countLines("logs/nonbiodegradeable/log_".date("mdY",strtotime('-1 day')).".log"), $log->countLines("log/nonbiodegradeable/log_".date("mdY").".log")) ?><br />
                                    <font style="font-size: 14px">Overall Activity</font><br />
                                </div>
                                <div class="column">
                                    <font style="font-size: 20px"><?php echo fiveDayAverage("logs/nonbiodegradeable")?> </font><?php compareProgress(lateFiveDayAverage("logs/nonbiodegradeable"),fiveDayAverage("logs/nonbiodegradeable")) ?><br />
                                    <font style="font-size: 14px">Five Day Average</font><br />
                                </div>
                            </div>
                            <canvas id="nonActivity" style="width: 100%; height: 180px"></canvas>
                        </div>
                    </div>
                </div>

                <div class="ui card" style="background-color: lightgray">
                    <div class="content">
                        <div class="header">Unspecified Unit</div>
                        <div class="description">
                            <div class="ui equal width grid">
                                <div class="column">
                                    <font style="font-size: 20px"><?php echo $log->countLines("logs/unspecified/log_".date("mdY").".log")?> </font><?php compareProgress($log->countLines("logs/unspecified/log_".date("mdY",strtotime('-1 day')).".log"), $log->countLines("log/unspecified/log_".date("mdY").".log")) ?><br />
                                    <font style="font-size: 14px">Overall Activity</font><br />
                                </div>
                                <div class="column">
                                    <font style="font-size: 20px"><?php echo fiveDayAverage("logs/unspecified")?> </font><?php compareProgress(lateFiveDayAverage("logs/unspecified"),fiveDayAverage("logs/unspecified")) ?><br />
                                    <font style="font-size: 14px">Five Day Average</font><br />
                                </div>
                            </div>
                            <canvas id="unsActivity" style="width: 100%; height: 180px"></canvas>
                        </div>
                    </div>
                </div>

                <div class="ui card" style="background-color: lightgray">
                    <div class="content">
                        <div class="header">Communication Services</div>
                        <div class="description">
                            <div class="ui equal width grid">
                                <div class="column">
                                    <font style="font-size: 20px"><?php echo $log->countLines("logs/messages/log_".date("mdY").".log")?> </font><?php compareProgress($log->countLines("logs/messages/log_".date("mdY",strtotime('-1 day')).".log"), $log->countLines("log/unspecified/log_".date("mdY").".log")) ?><br />
                                    <font style="font-size: 14px">Overall Activity</font><br />
                                </div>
                                <div class="column">
                                    <font style="font-size: 20px"><?php echo fiveDayAverage("logs/messages")?> </font><?php compareProgress(lateFiveDayAverage("logs/messages"),fiveDayAverage("logs/messages")) ?><br />
                                    <font style="font-size: 14px">Five Day Average</font><br />
                                </div>
                            </div>
                            <canvas id="msgActivity" style="width: 100%; height: 180px"></canvas>
                        </div>
                    </div>
                </div>

                <div class="ui card" style="background-color: lightgray">
                    <div class="content">
                        <div class="header">Activity Breakdown</div>
                        <div class="description">
                            <div class="ui grid">
                                <div class="four wide column">
                                    <font style="font-size: 20px"><?php echo $log->countLines("logs/biodegradeable/log_".date("mdY").".log") ?> </font><br />
                                    <font style="font-size: 14px">Biodegradeable</font><br />
                                    <br />
                                    <font style="font-size: 20px"><?php echo $log->countLines("logs/nonbiodegradeable/log_".date("mdY").".log") ?> </font><br />
                                    <font style="font-size: 14px">Non-Bio</font><br />
                                    <br />
                                    <font style="font-size: 20px"><?php echo $log->countLines("logs/unspecified/log_".date("mdY").".log") ?> </font><br />
                                    <font style="font-size: 14px">Unspecified</font><br />
                                    <br />
                                    <font style="font-size: 20px"><?php echo $log->countLines("logs/messages/log_".date("mdY").".log") ?> </font><br />
                                    <font style="font-size: 14px">Communications</font><br />
                                </div>
                                <div class="twelve wide column">
                                    <canvas id="activityBreakdown" style="width: 100%; height: 220px"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="ui card" style="background-color: lightgray">
                    <div class="content">
                        <div class="header">Trash Content Breakdown</div>
                        <div class="description">
                            <div class="ui grid">
                                <div class="four wide column">
                                    <font style="font-size: 20px"><?php echo $trashMon->getContents($trashMon::BIODEGRADABLE) ?> </font><br />
                                    <font style="font-size: 14px">Biodegradeable</font><br />
                                    <br />
                                    <font style="font-size: 20px"><?php echo $trashMon->getContents($trashMon::NONBIODEGRADEABLE) ?> </font><br />
                                    <font style="font-size: 14px">Non-Bio</font><br />
                                    <br />
                                    <font style="font-size: 20px"><?php echo $trashMon->getContents($trashMon::UNSPECIFIED) ?> </font><br />
                                    <font style="font-size: 14px">Unspecified</font><br />
                                </div>
                                <div class="twelve wide column">
                                    <canvas id="trashContentBreakdown" style="width: 100%; height: 220px"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="ui card" style="background-color: lightgray">
                    <div class="content">
                        <div class="header">Trash Maximums Breakdown</div>
                        <div class="description">
                            <div class="ui grid">
                                <div class="four wide column">
                                    <font style="font-size: 20px"><?php echo $trashMon->getMaximumContent($trashMon::BIODEGRADABLE) ?> </font><br />
                                    <font style="font-size: 14px">Biodegradeable</font><br />
                                    <br />
                                    <font style="font-size: 20px"><?php echo $trashMon->getMaximumContent($trashMon::NONBIODEGRADEABLE) ?> </font><br />
                                    <font style="font-size: 14px">Non-Bio</font><br />
                                    <br />
                                    <font style="font-size: 20px"><?php echo $trashMon->getMaximumContent($trashMon::UNSPECIFIED) ?> </font><br />
                                    <font style="font-size: 14px">Unspecified</font><br />
                                </div>
                                <div class="twelve wide column">
                                    <canvas id="trashMaximumsBreakdown" style="width: 100%; height: 220px"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var ctx1 = document.getElementById("sysActivity");
            var myChart = new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: [
                        <?php echo "\"".date("m/d", strtotime('-4 days'))."\""?>,
                        <?php echo "\"".date("m/d", strtotime('-3 days'))."\""?>,
                        <?php echo "\"".date("m/d", strtotime('-2 days'))."\""?>,
                        <?php echo "\"".date("m/d", strtotime('-1 days'))."\""?>,
                        <?php echo "\"".date("m/d")."\""?>
                    ],
                    datasets: [{
                        label: false,
                        data: [
                            <?php echo $log->countLines("logs/log_".date("mdY",strtotime('-4 days')).".log")?>,
                            <?php echo $log->countLines("logs/log_".date("mdY",strtotime('-3 days')).".log")?>,
                            <?php echo $log->countLines("logs/log_".date("mdY",strtotime('-2 days')).".log")?>,
                            <?php echo $log->countLines("logs/log_".date("mdY",strtotime('-1 day')).".log")?>,
                            <?php echo $log->countLines("logs/log_".date("mdY").".log")?>
                        ],
                        backgroundColor: [
                            'rgba(255, 102, 51,0.4)'
                        ],
                        borderColor: [
                            'rgba(255, 102, 51, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        scale: [{
                           display: false
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });

            var ctx2 = document.getElementById("bioActivity");
            var myChart2 = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: [
                        <?php echo "\"".date("m/d", strtotime('-4 days'))."\""?>,
                        <?php echo "\"".date("m/d", strtotime('-3 days'))."\""?>,
                        <?php echo "\"".date("m/d", strtotime('-2 days'))."\""?>,
                        <?php echo "\"".date("m/d", strtotime('-1 days'))."\""?>,
                        <?php echo "\"".date("m/d")."\""?>
                    ],
                    datasets: [{
                        label: false,
                        data: [
                            <?php echo $log->countLines("logs/biodegradeable/log_".date("mdY",strtotime('-4 days')).".log")?>,
                            <?php echo $log->countLines("logs/biodegradeable/log_".date("mdY",strtotime('-3 days')).".log")?>,
                            <?php echo $log->countLines("logs/biodegradeable/log_".date("mdY",strtotime('-2 days')).".log")?>,
                            <?php echo $log->countLines("logs/biodegradeable/log_".date("mdY",strtotime('-1 day')).".log")?>,
                            <?php echo $log->countLines("logs/biodegradeable/log_".date("mdY").".log")?>
                        ],
                        backgroundColor: [
                            'rgba(51, 102, 255,0.4)'
                        ],
                        borderColor: [
                            'rgba(51, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        scale: [{
                            display: false
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });

            var ctx3 = document.getElementById("nonActivity");
            var myChart3 = new Chart(ctx3, {
                type: 'line',
                data: {
                    labels: [
                        <?php echo "\"".date("m/d", strtotime('-4 days'))."\""?>,
                        <?php echo "\"".date("m/d", strtotime('-3 days'))."\""?>,
                        <?php echo "\"".date("m/d", strtotime('-2 days'))."\""?>,
                        <?php echo "\"".date("m/d", strtotime('-1 days'))."\""?>,
                        <?php echo "\"".date("m/d")."\""?>
                    ],
                    datasets: [{
                        label: false,
                        data: [
                            <?php echo $log->countLines("logs/nonbiodegradeable/log_".date("mdY",strtotime('-4 days')).".log")?>,
                            <?php echo $log->countLines("logs/nonbiodegradeable/log_".date("mdY",strtotime('-3 days')).".log")?>,
                            <?php echo $log->countLines("logs/nonbiodegradeable/log_".date("mdY",strtotime('-2 days')).".log")?>,
                            <?php echo $log->countLines("logs/nonbiodegradeable/log_".date("mdY",strtotime('-1 day')).".log")?>,
                            <?php echo $log->countLines("logs/nonbiodegradeable/log_".date("mdY").".log")?>
                        ],
                        backgroundColor: [
                            'rgba(0, 128, 0,0.4)'
                        ],
                        borderColor: [
                            'rgba(0, 128, 0, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        scale: [{
                            display: false
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });

            var ctx4 = document.getElementById("unsActivity");
            var myChart4 = new Chart(ctx4, {
                type: 'line',
                data: {
                    labels: [
                        <?php echo "\"".date("m/d", strtotime('-4 days'))."\""?>,
                        <?php echo "\"".date("m/d", strtotime('-3 days'))."\""?>,
                        <?php echo "\"".date("m/d", strtotime('-2 days'))."\""?>,
                        <?php echo "\"".date("m/d", strtotime('-1 days'))."\""?>,
                        <?php echo "\"".date("m/d")."\""?>
                    ],
                    datasets: [{
                        label: false,
                        data: [
                            <?php echo $log->countLines("logs/unspecified/log_".date("mdY",strtotime('-4 days')).".log")?>,
                            <?php echo $log->countLines("logs/unspecified/log_".date("mdY",strtotime('-3 days')).".log")?>,
                            <?php echo $log->countLines("logs/unspecified/log_".date("mdY",strtotime('-2 days')).".log")?>,
                            <?php echo $log->countLines("logs/unspecified/log_".date("mdY",strtotime('-1 day')).".log")?>,
                            <?php echo $log->countLines("logs/unspecified/log_".date("mdY").".log")?>
                        ],
                        backgroundColor: [
                            'rgba(128, 0, 128,0.4)'
                        ],
                        borderColor: [
                            'rgba(128, 0, 128, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        scale: [{
                            display: false
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });

            var ctx5 = document.getElementById("msgActivity");
            var myChart5 = new Chart(ctx5, {
                type: 'line',
                data: {
                    labels: [
                        <?php echo "\"".date("m/d", strtotime('-4 days'))."\""?>,
                        <?php echo "\"".date("m/d", strtotime('-3 days'))."\""?>,
                        <?php echo "\"".date("m/d", strtotime('-2 days'))."\""?>,
                        <?php echo "\"".date("m/d", strtotime('-1 days'))."\""?>,
                        <?php echo "\"".date("m/d")."\""?>
                    ],
                    datasets: [{
                        label: false,
                        data: [
                            <?php echo $log->countLines("logs/messages/log_".date("mdY",strtotime('-4 days')).".log")?>,
                            <?php echo $log->countLines("logs/messages/log_".date("mdY",strtotime('-3 days')).".log")?>,
                            <?php echo $log->countLines("logs/messages/log_".date("mdY",strtotime('-2 days')).".log")?>,
                            <?php echo $log->countLines("logs/messages/log_".date("mdY",strtotime('-1 day')).".log")?>,
                            <?php echo $log->countLines("logs/messages/log_".date("mdY").".log")?>
                        ],
                        backgroundColor: [
                            'rgba(0, 102, 102,0.4)'
                        ],
                        borderColor: [
                            'rgba(0, 102, 102, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        scale: [{
                            display: false
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });

            var ctx6 = document.getElementById("activityBreakdown");
            var myChart6 = new Chart(ctx6, {
                type: 'pie',
                data: {
                    labels: ["Biodegradeable","Non-Biodegradeable","Unspecified","Communications"],
                    datasets: [{
                        data: [
                            <?php echo $log->countLines("logs/biodegradeable/log_".date("mdY").".log") ?>,
                            <?php echo $log->countLines("logs/nonbiodegradeable/log_".date("mdY").".log") ?>,
                            <?php echo $log->countLines("logs/unspecified/log_".date("mdY").".log") ?>,
                            <?php echo $log->countLines("logs/messages/log_".date("mdY").".log") ?>
                        ],
                        backgroundColor: [
                            'rgba(0, 102, 102,0.4)',
                            'rgba(51, 102, 0,0.4)',
                            'rgba(102, 0, 51,0.4)',
                            'rgba(0, 0, 0,0.4)'
                        ],
                        borderColor: [
                            'rgba(0, 102, 102,1)',
                            'rgba(51, 102, 0,1)',
                            'rgba(102, 0, 51,1)',
                            'rgba(0, 0, 0,1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    legend: {
                        display: false
                    }
                }
            });

            var ctx7 = document.getElementById("trashContentBreakdown");
            var myChart7 = new Chart(ctx7, {
                type: 'pie',
                data: {
                    labels: ["Biodegradeable","Non-Biodegradeable","Unspecified"],
                    datasets: [{
                        data: [
                            <?php echo $trashMon->getContents($trashMon::BIODEGRADABLE) ?>,
                            <?php echo $trashMon->getContents($trashMon::NONBIODEGRADEABLE) ?>,
                            <?php echo $trashMon->getContents($trashMon::UNSPECIFIED) ?>
                        ],
                        backgroundColor: [
                            'rgba(0, 102, 102,0.4)',
                            'rgba(51, 102, 0,0.4)',
                            'rgba(102, 0, 51,0.4)'
                        ],
                        borderColor: [
                            'rgba(0, 102, 102,1)',
                            'rgba(51, 102, 0,1)',
                            'rgba(102, 0, 51,1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    legend: {
                        display: false
                    }
                }
            });

            var ctx8 = document.getElementById("trashMaximumsBreakdown");
            var myChart8 = new Chart(ctx8, {
                type: 'pie',
                data: {
                    labels: ["Biodegradeable","Non-Biodegradeable","Unspecified"],
                    datasets: [{
                        data: [
                            <?php echo $trashMon->getMaximumContent($trashMon::BIODEGRADABLE) ?>,
                            <?php echo $trashMon->getMaximumContent($trashMon::NONBIODEGRADEABLE) ?>,
                            <?php echo $trashMon->getMaximumContent($trashMon::UNSPECIFIED) ?>
                        ],
                        backgroundColor: [
                            'rgba(0, 102, 102,0.4)',
                            'rgba(51, 102, 0,0.4)',
                            'rgba(102, 0, 51,0.4)'
                        ],
                        borderColor: [
                            'rgba(0, 102, 102,1)',
                            'rgba(51, 102, 0,1)',
                            'rgba(102, 0, 51,1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    legend: {
                        display: false
                    }
                }
            });
        </script>
        <?php include_once "components/endScript.php" ?>
    </body>
</html>