<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}



try {
    if (class_exists('PDO')) {
        $dsn = 'mysql:dbname=' . dbname . ';host=' . servername;

        $conn = new PDO($dsn, username, password);
    }
} catch (Exception $exception) {
    echo $exception->getMessage() . '<br>';
    die();
}
