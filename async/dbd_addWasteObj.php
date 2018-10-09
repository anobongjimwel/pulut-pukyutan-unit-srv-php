<?php

    require_once "../helpers/dbcon.php";
    include_once "../classes/Logger.php";
    $log = new \pulut\Logger();
    if (!empty($_POST['objectName']) && !empty($_POST['objectType'])) {
        $objName = $_POST['objectName'];
        $objType = $_POST['objectType'];
        if ($objType == 'non-biodegradable') {
            $insert = $db->query("INSERT INTO wasteObjects (`objectName`,`objectType`) VALUES ('$objName', 'non-biodegradable')");
            if (!is_object($insert)) {
                $log->nonLogger("Object '$objName' failed to categorize as non-biodegradeable");
                $log->genLogger("Object '$objName' failed to categorize as non-biodegradeable");
            } else {
                $log->nonLogger("Object '$objName' now categorized as non-biodegradeable");
                $log->genLogger("Object '$objName' now categorized as non-biodegradeable");
                echo 1;
            }
        } elseif ($objType == 'biodegradable') {
            $insert = $db->query("INSERT INTO wasteObjects (`objectName`,`objectType`) VALUES ('$objName', 'biodegradable')");
            if (!is_object($insert)) {
                $log->bioLogger("Object '$objName' failed to categorize as biodegradeable");
                $log->genLogger("Object '$objName' failed to categorize as biodegradeable");
            } else {
                $log->bioLogger("Object '$objName' now categorized as biodegradeable");
                $log->genLogger("Object '$objName' now categorized as biodegradeable");
                echo 2;
            }
        } else {
            echo 3;
        }
    }