<?php
    include_once '../classes/Logger.php';
    $logMgr = new \pulut\Logger();
    if (!file_exists("../logs/nonbiodegradeable/log_" . date("mdY") . ".log")) {
        echo "No non-biodegradeable logs found for today\n\n\n\n\n\n";
    } else {
        echo $logMgr->tailReader("../logs/nonbiodegradeable/log_" . date("mdY") . ".log", 6, true);
    }