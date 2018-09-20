<?php
require_once "../classes/SystemInfo.php";
$ram = new SystemInfo();

echo number_format(abs($ram->getCpuLoadPercentage()),3);

?>