<?php
include_once '../classes/TrashMonitor.php';
$trashMon = new \pulut\TrashMonitor();
echo $trashMon->getMaximumContent($trashMon::BIODEGRADABLE)." Object(s)";