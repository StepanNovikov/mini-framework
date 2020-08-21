<?php
    ini_set('display_errosp', 1);
    error_reporting(E_ALL);

    function debug($str){
        echo '<pre>';
        var_dump($str);
        echo '</pre>';
        exit;
    }