<?php
    include_once '../classes/TrashMonitor.php';
    $trashMon = new \pulut\TrashMonitor();
    if ($trashMon->isOperational($trashMon::NONBIODEGRADEABLE)) {
        echo " <i class=\"green circle icon\"></i>";
    } else {
        echo " <i class=\"red circle icon\"></i>";
    }