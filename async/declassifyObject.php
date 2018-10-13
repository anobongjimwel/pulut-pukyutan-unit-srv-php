<?php
    include_once '../classes/TrashClassifier.php';
    $trashClsfr = new \pulut\TrashClassifier();
     if (
        isset($_POST['wasteItem']) &&
        ($_POST['referrer']=="biodegradable" ||
        $_POST['referrer']=="nonbiodegradable" ||
        $_POST['referrer']=="unspecified")
    ) {
        $deleteObject = $trashClsfr->assignObject($_POST['wasteItem'], $trashClsfr::UNSPECIFIED);
        if ($deleteObject) {
           echo "GOOD";
        } else {
            echo "BAD";
        }
    } else {
        echo "BAD";
    }
