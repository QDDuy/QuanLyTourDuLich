<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

//kiểm tra mã tour trong db nếu tồn tại tiến hành xóa
$filterAll = filter();
if (!empty($filterAll['matour'])) {
    $matour = $filterAll['matour'];

    $userDetail = getRows("SELECT * FROM tbtourdulich WHERE matour='$matour'");
    if ($userDetail > 0) {
        $deleteUser = delete('tbtourdulich', "matour=$matour");
        if ($deleteUser) {
            setFlashData('smg', 'Xóa tour thành công');
            setFlashData('smg_type', 'success');
        } else {
            setFlashData('smg', 'Lỗi hệ thống ');
            setFlashData('smg_type', 'danger');
        }
    } else {
        setFlashData('smg', 'tour không tồn tại trong hệ thống ');
        setFlashData('smg_type', 'danger');
    }
} else {
    setFlashData('smg', 'Liên kết không tồn tại');
    setFlashData('smg_type', 'danger');
}

redirect('?modules=tourdulich&action=list');