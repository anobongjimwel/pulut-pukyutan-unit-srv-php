<?php
    include_once '../classes/TrashClassifier.php';
    include_once '../classes/Messenger.php';
    include_once '../classes/Logger.php';
    $trashClsfr = new \pulut\TrashClassifier();
    $log = new \pulut\Logger();
    $msgr = new \pulut\Messenger();
     if (
        isset($_POST['wasteItem']) &&
        ($_POST['referrer']=="biodegradable" ||
        $_POST['referrer']=="nonbiodegradable" ||
        $_POST['referrer']=="unspecified")
    ) {
        $deleteObject = $trashClsfr->deleteTrashClassification($_POST['wasteItem']);
        if ($deleteObject) {
            $msgr->sendMessage("Object '" . $_POST['wasteItem'] . "' deleted from the system");
            $log->messageLogger("Object '" . $_POST['wasteItem'] . "' deleted from the system");
            $log->genLogger("Object '" . $_POST['wasteItem'] . "' deleted from the system");
           if ($_POST['referrer']=='biodegradable') {
               $log->bioLogger("Object '" . $_POST['wasteItem'] . "' deleted from the system");
           } else {
               $log->nonLogger("Object '" . $_POST['wasteItem'] . "' deleted from the system");
           }
           echo "GOOD";
        } else {
            echo "BAD";
        }
    } else {
        echo "BAD";
    }
