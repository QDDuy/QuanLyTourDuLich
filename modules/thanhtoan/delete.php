<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

//kiểm tra mã người dùng trong db nếu tồn tại tiến hành xóa
$filterAll = filter();
if (!empty($filterAll['mathanhtoan'])) {
    $mathanhtoan = $filterAll['mathanhtoan'];

    $userDetail = getRows("SELECT * FROM tbthanhtoan WHERE mathanhtoan=$mathanhtoan");
    if ($userDetail > 0) {
        $deleteThanhtoan = delete('tbthanhtoan',"mathanhtoan=$mathanhtoan");
        if ($deleteThanhtoan) {
            setFlashData('smg', 'Xóa thông tin thanh toán thành công');
            setFlashData('type_error', 'success');
        } else {
            setFlashData('smg', 'Lỗi hệ thống ');
            setFlashData('type_error', 'danger');
        }
    } else {
        setFlashData('smg', 'Thông tin thanh toán đã tồn tại trong hệ thống ');
        setFlashData('type_error', 'danger');
    }
} else {
    setFlashData('smg', 'Liên kết không tồn tại');
    setFlashData('type_error', 'danger');
}

redirect('?modules=thanhtoan&action=list');