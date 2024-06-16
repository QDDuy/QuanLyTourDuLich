<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

//gán session
function setSession($key, $value)
{
    return $_SESSION[$key] = $value;
}

//dọc session
function getSession($key = '')
{
    if (empty($key)) {
        return $_SESSION;
    } else {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }
}

//xóa session

function removeSession($key = '')
{
    if (empty($key)) {
        session_destroy();
    } else {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
            return true;
        }
    }
}


//gán  flash data

function setFlashData($key, $value)
{
    $key = 'flash_' . $key;
    return setSession($key, $value);
}

function getFlashData($key)
{
    $key = 'flash_' . $key;
    $data = getSession($key);
    removeSession($key);
    return $data;
}