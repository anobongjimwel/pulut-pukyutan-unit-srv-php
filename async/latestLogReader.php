<?php
    include_once '../classes/Logger.php';
    $logMgr = new \pulut\Logger();
    if (!file_exists("../logs/log_" . date("mdY") . ".log")) {
        echo "No general logs found for today\n\n\n\n\n";
    } else {
        echo $logMgr->tailReader("../logs/log_" . date("mdY") . ".log", 6, true);
    }