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

        echo "<div class=\"card\">
                                    <div class=\"image\">
                                        <img src=\"resources/images/defaultTrashIcon.jpg\">
                                    </div>
                                    <div class=\"content\">
                                        <div class=\"header\">
                                            Elliot Fu
                                        </div>
                                        <div class=\"meta\">
                                            Friends of Veronika
                                        </div>
                                        <div class=\"description\">
                                            Elliot requested permission to view your contact details
                                        </div>
                                    </div>
                                    <div class=\"extra content\">
                                        <div class=\"ui three buttons\">
                                            <div class=\"ui green button\">Biodeg</div>
                                            <div class=\"ui blue button\">NonBio</div>
                                            <div class=\"ui red button\" onclick=\"deleteObject('".$itemName."', $('#id$ctr'))\">Delete</div>
                                        </div>
                                    </div>";
    }

    function echoNone() {
        echo "<font style='color: white; font-size: 20px;'>No instance matches your query.</font>";
    }

    if (
        $_POST['referrer']=='biodegradable'
        )
     {
        if (!empty($_POST['query'])) {
            if ($trashClsfr->countObjectsByItemInClassification($_POST['query'],$trashClsfr::BIODEGRADABLE)) {
                $ctr = 1;
                foreach($trashClsfr->gatherObjectsByItemInClassification($_POST['query'],$trashClsfr::BIODEGRADABLE) as $item) {
                    echoItems($ctr, $item['objectName'], $item['dateAdded']);
                    $ctr+=1;
                }
            } else {
                echoNone();
            }


        } else {
            if ($trashClsfr->countObjectsByClassification($trashClsfr::BIODEGRADABLE)) {
                $ctr = 1;
                foreach($trashClsfr->gatherObjectsByClassification($trashClsfr::BIODEGRADABLE) as $item) {
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