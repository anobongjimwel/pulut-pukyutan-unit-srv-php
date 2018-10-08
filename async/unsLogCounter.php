<?php
    include_once '../classes/Logger.php';
    $logMgr = new \pulut\Logger();
    if (!file_exists("../logs/unspecified/log_" . date("mdY") . ".log")) {
        echo "Content List - No File Found";
    } else {
        echo "Content List - ".$logMgr->countLines("../logs/unspecified/log_" . date("mdY") . ".log")." Lines";
    }