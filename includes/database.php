<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

function query($sql, $data = [], $check = false)
{
    global $conn;
    $ketqua = false;

    try {
        $stmt = $conn->prepare($sql);
        if (!empty($data)) {
            $ketqua = $stmt->execute($data);
        } else {
            $ketqua = $stmt->execute();
        }
    } catch (Exception $exception) {
        echo $exception->getMessage();
        die();
    }


    if ($check) {
        return $stmt;
    }
    return $ketqua;
}

function insert($table, $data)
{
    $key = array_keys($data);
    $truong = implode(',', $key);
    $valuetb = ':' . implode(',:', $key);


    $sql = 'INSERT INTO ' . $table . ' (' . $truong . ') VALUES (' . $valuetb . ')';


    $kq = query($sql, $data);
    return $kq;
}


//Hàm update 
function update($table, $data, $condition = '')
{
    $update = "";
    foreach ($data as $key => $value) {
        $update .= $key . '= :' . $key . ',';
    }
    $update = trim($update, ',');

    if (!empty($condition)) {
        $sql = "UPDATE  $table  SET  $update  WHERE  $condition";
    } else {
        $sql = "UPDATE $table  SET  $update";
    }

    $kq = query($sql, $data);
    return $kq;
}

//Hàm delete

function delete($table, $condition = '')
{
    if (!empty($condition)) {
        $sql = "DELETE FROM $table WHERE $condition";
    } else {
        $sql = "DELETE FROM $table";
    }

    $kq = query($sql);
    return $kq;
}




//Hàm select

//lấy nhiều dòng dữ liệu

function getRaw($sql)
{
    $kq = query($sql, '', true);
    if (is_object($kq)) {
        $dataFetch = $kq->fetchAll(PDO::FETCH_ASSOC);
    }
    return $dataFetch;
}

//lấy 1 dòng dữ liệu
function oneRaw($sql)
{
    $kq = query($sql, '', true);
    if (is_object($kq)) {
        $dataFetch = $kq->fetch(PDO::FETCH_ASSOC);
    }
    return $dataFetch;
}


//đếm số dòng
function getRows($sql)
{
    $kq = query($sql, '', true);
    if (!empty($kq)) {
        return $kq->rowCount();
    }
}