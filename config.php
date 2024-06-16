<!-- các hằng số của project -->



<!-- $modules ='home';
$action = 'dashboard'; -->

<?php
const _MODULE = 'home';
const _ACTION = 'dashboard';
const _CODE = true; //truy cập hợp lệ?

// Thiết lập host
define('_WEB_HOST', 'http://' . $_SERVER['HTTP_HOST'] . '/LearnPHP/baitaplon/');
define('_WEB_HOST_TEMPLATES',    _WEB_HOST . '/templates');


//Thiết lập path

define('_WEB_PATH', __DIR__);
define('_WEB_PATH_TEMPLATES', _WEB_PATH . '/templates');

//Thông tin kết nối
const servername = 'localhost:3306';
const username = 'root';
const password = '';
const dbname = 'dbtravel';
