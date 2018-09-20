<?php
require_once "../classes/SystemInfo.php";
$ram = new SystemInfo();

echo round(abs($ram->getRamFree() / $ram->getRamTotal() * 100),2);

