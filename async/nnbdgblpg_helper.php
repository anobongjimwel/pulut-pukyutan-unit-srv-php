<?php
    include_once '../classes/TrashClassifier.php';
    $trashClsfr = new \pulut\TrashClassifier();

    function echoItems($ctr, $itemName, $dateAdded) {
        echo "<div class='ui fluid card' id='id$ctr'>";
            echo "<div class='content'>";
            echo "<div class='ui equal width stackable grid'>";
                echo "<div class='column'>";
                    echo "<div class='header'>";
                    echo ucfirst($itemName);
                    echo "</div>";
                    echo "<div class='meta'>";
                    echo "added ".date('M d, Y  H:i:s',strtotime($dateAdded));
                    echo "</div>";
                echo "</div>";
                echo "<div class='column right aligned'>";
                    echo "<button class=\"ui blue button\" onclick=\"declassifyObject('$itemName', $('#id$ctr'))\">Declassify</button>";
                    echo "<button class=\"ui red button\" onclick=\"deleteObject('".$itemName."', $('#id$ctr'))\">X</button>";
                echo "</div>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    }

    function echoNone() {
        echo "<font style='color: white; font-size: 20px;'>No instance matches your query.</font>";
    }

    if (
        $_POST['referrer']=='nonbiodegradable'
        )
     {
        if (!empty($_POST['query'])) {
            if ($trashClsfr->countObjectsByItemInClassification($_POST['query'],$trashClsfr::NONBIODEGRADEABLE)) {
                $ctr = 1;
                foreach($trashClsfr->gatherObjectsByItemInClassification($_POST['query'],$trashClsfr::NONBIODEGRADEABLE) as $item) {
                    echoItems($ctr, $item['objectName'], $item['dateAdded']);
                    $ctr+=1;
                }
            } else {
                echoNone();
            }


        } else {
            if ($trashClsfr->countObjectsByClassification($trashClsfr::NONBIODEGRADEABLE)) {
                $ctr = 1;
                foreach($trashClsfr->gatherObjectsByClassification($trashClsfr::NONBIODEGRADEABLE) as $item) {
                    echoItems($ctr, $item['objectName'], $item['dateAdded']);
                    $ctr+=1;
                }
            } else {
                echoNone();
            }
        }
    } else {
        die(400);
    }
?>