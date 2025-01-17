<?php
session_start();
require_once 'config.php';
require_once './includes/connectDB.php';
require_once './includes/functions.php';
require_once './includes/database.php';
require_once './includes/session.php';




$modules = _MODULE;
$action = _ACTION;
if (!empty($_GET['modules'])) {
    if (is_string($_GET['modules'])) {
        $modules = trim($_GET['modules']);
    }
}

if (!empty($_GET['action'])) {

    if (is_string($_GET['action'])) {
        $action = trim($_GET['action']);
    }
}


$path = 'modules/' . $modules . '/' . $action . '.php';

if (file_exists($path)) {
    require_once($path);
} else {
    require_once 'modules/error/404.php';
}