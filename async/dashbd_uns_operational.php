<?php
    include_once '../classes/TrashMonitor.php';
    $trashMon = new \pulut\TrashMonitor();
    if ($trashMon->isOperational($trashMon::UNSPECIFIED)) {
        echo " <i class=\"green circle icon\"></i>";
    } else {
        echo " <i class=\"red circle icon\"></i>";
    }