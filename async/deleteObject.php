<?php
    if (
        isset($_POST['wasteItem']) &&
        ($_POST['referrer']=="biodegradable unit" ||
        $_POST['referrer']=="nonbiodegradable unit" ||
        $_POST['referrer']=="unspecified unit")
    ) {
        if (isset($_POST['wasteObject'])) {
            include_once '../classes/TrashClassifier.php';
            $trashClsfr = new \pulut\TrashClassifier();
            $deleteObject = $trashClsfr->deleteTrashClassification($_POST['wasteItem']);
            if ($deleteObject) {
               echo "GOOD";
            } else {
                echo "BAD";
            }
        }
    } else {
        echo "BAD";
    }