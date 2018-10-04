<?php
    include_once '../classes/InfoManager.php';
    if (!empty($_POST['u'] && !empty($_POST['p']))) {
        $username = $_POST['u'];
        $password = $_POST['p'];
        echo $infoMgr->updateCredentials($username, $password);
    }