<?php
include_once '../classes/TrashMonitor.php';
$trashMon = new \pulut\TrashMonitor();
echo $trashMon->getContents($trashMon::NONBIODEGRADEABLE)." Object(s)";