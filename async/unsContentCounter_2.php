<?php
include_once '../classes/TrashMonitor.php';
$trashMon = new \pulut\TrashMonitor();
echo number_format($trashMon->getContents($trashMon::UNSPECIFIED) / $trashMon->getMaximumContent($trashMon::UNSPECIFIED),2);