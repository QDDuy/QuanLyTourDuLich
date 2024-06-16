<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

//kiểm tra mã người dùng trong db nếu tồn tại tiến hành xóa
$filterAll = filter();
if (!empty($filterAll['mahanhtrinh'])) {
    $mahanhtrinh = $filterAll['mahanhtrinh'];

    $userDetail = getRows("SELECT * FROM tbhanhtrinhtour WHERE mahanhtrinh=$mahanhtrinh");
    if ($userDetail > 0) {
        $deleteDattour = delete('tbhanhtrinhtour', "mahanhtrinh=$mahanhtrinh");
        if ($deleteDattour) {
            setFlashData('smg', 'Xóa đặt tour thành công');
            setFlashData('smg_type', 'success');
        } else {
            setFlashData('smg', 'Lỗi hệ thống ');
            setFlashData('smg_type', 'danger');
        }
    } else {
        setFlashData('smg', 'Tour đã đặt  tồn tại trong hệ thống ');
        setFlashData('smg_type', 'danger');
    }
} else {
    setFlashData('smg', 'Liên kết không tồn tại');
    setFlashData('smg_type', 'danger');
}

redirect('?modules=hanhtrinh&action=list');