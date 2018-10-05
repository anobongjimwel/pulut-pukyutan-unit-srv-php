<?php
require_once "../classes/SystemInfo.php";
$sysInfo = new \Pulut\SystemInfo();

echo round(abs($sysInfo->getRamFree() / $sysInfo->getRamTotal() * 100),2);

