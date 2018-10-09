<?php
include_once '../classes/TrashMonitor.php';
$trashMon = new \pulut\TrashMonitor();
echo number_format($trashMon->getContents($trashMon::BIODEGRADABLE) / $trashMon->getMaximumContent($trashMon::BIODEGRADABLE),2);