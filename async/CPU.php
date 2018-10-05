<?php
require_once "../classes/SystemInfo.php";
$sysInfo = new \Pulut\SystemInfo();

echo number_format(abs($sysInfo->getCpuLoadPercentage()),3);

?>