<?php
    include_once '../classes/Securer.php';
    $secure = new \pulut\Securer();
    if (!empty($_POST['u']) && !empty($_POST['p'])) {
        if ($secure->checkCredentials($_POST['u'], $_POST['p'])) {
            $_SESSION['username'];
            echo "GOOD";
        } else {
            echo "BAD";
        }
    }

