<?php
    include_once '../classes/Logger.php';
    $logMgr = new \pulut\Logger();
    if (!file_exists("../logs/log_" . date("mdY") . ".log")) {
        echo "System Activity - No File Found";
    } else {
        echo "System Activity - " . $logMgr->countLines("../logs/log_" . date("mdY") . ".log") . " Lines";
    }