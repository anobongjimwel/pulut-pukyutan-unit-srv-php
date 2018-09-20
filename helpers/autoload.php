<?php
    foreach(glob('classes/*.php') as $filename) {
        include_once $filename;
    }
?>