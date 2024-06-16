<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

//kiểm tra mã người dùng trong db nếu tồn tại tiến hành xóa
$filterAll = filter();
if (!empty($filterAll['madiadiem'])) {
    $madiadiem = $filterAll['madiadiem'];

    $userDetail = getRows("SELECT * FROM tbdiadiem WHERE madiadiem=$madiadiem");
    if ($userDetail > 0) {
        $deleteUser = delete('tbdiadiem', "madiadiem=$madiadiem");
        if ($deleteUser) {
            setFlashData('smg', 'Xóa địa điểm thành công');
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

redirect('?modules=diadiem&action=list');