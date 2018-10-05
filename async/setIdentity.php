<?php
    include_once '../classes/InfoManager.php';
    if (!empty($_POST['f'] && !empty($_POST['s']))) {
        $fullname = $_POST['f'];
        $subtitle = $_POST['s'];
        echo $infoMgr->updateIdentity($fullname, $subtitle);
    }