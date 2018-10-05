<?php

    require_once "../helpers/dbcon.php";

    if (!empty($_POST['objectName']) && !empty($_POST['objectType'])) {
        $objName = $_POST['objectName'];
        $objType = $_POST['objectType'];

        if ($objType == 'non-biodegradable') {
            $db->query("INSERT INTO wasteObjects (`objectName`,`objectType`) VALUES ('$objName', 'non-biodegradable')");
            echo 1;
        } elseif ($objType == 'biodegradable') {
            $db->query("INSERT INTO wasteObjects (`objectName`,`objectType`) VALUES ('$objName', 'biodegradable')");
            echo 2;
        } else {
            echo 3;
        }
    }