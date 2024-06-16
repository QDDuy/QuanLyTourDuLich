<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

//kiểm tra mã người dùng trong db nếu tồn tại tiến hành xóa
$filterAll = filter();
if (!empty($filterAll['manguoidung'])) {
    $manguoidung = $filterAll['manguoidung'];

    $userDetail = getRows("SELECT * FROM tbnguoidung WHERE manguoidung=$manguoidung");
    if ($userDetail > 0) {
        $deleteUser = delete('tbnguoidung', "manguoidung=$manguoidung");
        if ($deleteUser) {
            setFlashData('smg', 'Xóa người dùng thành công');
            setFlashData('smg_type', 'success');
        } else {
            setFlashData('smg', 'Lỗi hệ thống ');
            setFlashData('smg_type', 'danger');
        }
    } else {
        setFlashData('smg', 'Người dùng không tồn tại trong hệ thống ');
        setFlashData('smg_type', 'danger');
    }
} else {
    setFlashData('smg', 'Liên kết không tồn tại');
    setFlashData('smg_type', 'danger');
}

redirect('?modules=users&action=list');