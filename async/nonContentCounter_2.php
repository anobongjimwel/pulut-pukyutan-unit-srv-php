<?php
include_once '../classes/TrashMonitor.php';
$trashMon = new \pulut\TrashMonitor();
echo number_format($trashMon->getContents($trashMon::NONBIODEGRADEABLE) / $trashMon->getMaximumContent($trashMon::NONBIODEGRADEABLE),2);