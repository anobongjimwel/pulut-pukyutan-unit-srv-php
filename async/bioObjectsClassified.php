<?php
include_once '../helpers/dbcon.php';
$q = $db->query("SELECT * FROM wasteobjects WHERE objectType = 'biodegradable'");
if ($q->rowCount()==0) {
    echo "0 Object(s)";
} else {
    echo $q->rowCount()." Object(s)";
}