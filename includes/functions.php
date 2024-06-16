<?php

use function PHPSTORM_META\type;

if (!defined('_CODE')) {
    die("Access dinied....");
}


function layouts($layoutName = 'header', $data = [])
{
    if (file_exists(_WEB_PATH_TEMPLATES . '/layout/' . $layoutName . '.php')) {
        require_once(_WEB_PATH_TEMPLATES . '/layout/' . $layoutName . '.php');
    }
}
///Kiểm tra phương thức GET
function isGet()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        return true;
    }
    return false;
}

//Kiểm tra phương thức post
function isPost()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        return true;
    }
    return false;
}


//Lọc dữ liệu
function filter()
{
    if (isGet()) {
        $filterArray = [];
        //xử lý  cái dữ liệu  trước khi hiển thị ra
        // return $_GET;
        if (!empty($_GET)) {
            foreach ($_GET as $key => $value) {
                $key = strip_tags($key);
                if (is_array($value)) {
                    $filterArray[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                } else {
                    $filterArray[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }

    if (isPost()) {
        $filterArray = [];

        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $key = strip_tags($key);
                if (is_array($value)) {
                    $filterArray[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                } else {
                    $filterArray[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }

    return $filterArray;
}


//kiểm tra mail

function isEmail($email)
{
    $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    return $checkEmail;
}



//kiểm tra số nguyên
function isNumberInt($number)
{
    $checkNumber = filter_var($number, FILTER_VALIDATE_INT);
    return $checkNumber;
}


//kiểm tra số thực
function isNumberFloat($number)
{
    $checkNumber = filter_var($number, FILTER_VALIDATE_FLOAT);
    return $checkNumber;
}
//kiểm tra số điện thoại
function isPhone($phone)
{
    $checkZero = false;

    //dk 1 ký tự đầu tiên là số không
    if ($phone[0] == '0') {
        $checkZero = true;
        $phone = substr($phone, 1);
    }
    //dk 2 đăng sau có 9 số
    $checkNumber = false;
    if (isNumberInt($phone) && (strlen($phone) == 9)) {
        $checkNumber = true;
    }
    if ($checkNumber && $checkZero) {
        return true;
    }
    return false;
}
// thông báo lỗi

function getSmg($smg, $type = 'success')
{
    echo '<div class="alert alert-' . $type . '">';
    echo $smg;
    echo '</div>';
}



//Hàm chuyển hương
function redirect($path = 'index.php')
{
    header("Location: $path");
    exit;
}
