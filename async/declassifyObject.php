<?php
    include_once '../classes/TrashClassifier.php';
    include_once '../classes/Messenger.php';
    include_once '../classes/Logger.php';
    $trashClsfr = new \pulut\TrashClassifier();
    $msgr = new \pulut\Messenger();
    $log = new \pulut\Logger();
    if (
        isset($_POST['wasteItem']) &&
        ($_POST['referrer']=="biodegradable" ||
        $_POST['referrer']=="nonbiodegradable" ||
        $_POST['referrer']=="unspecified")
    ) {
        $deleteObject = $trashClsfr->assignObject($_POST['wasteItem'], $trashClsfr::UNSPECIFIED);
        if ($deleteObject) {
            $msgr->sendMessage("Object '".$_POST['wasteItem']."' declassified from being a biodegradable");
            $log->messageLogger("Object '".$_POST['wasteItem']."' declassified from being a biodegradable");
            $log->genLogger("Object '".$_POST['wasteItem']."' declassified from being a biodegradable");
            $log->unsLogger("Object '".$_POST['wasteItem']."' declassified from being a biodegradable");
           echo "GOOD";
        } else {
            echo "BAD";
        }
    } else {
        echo "BAD";
    }
