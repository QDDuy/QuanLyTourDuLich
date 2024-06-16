<!-- <------------------Edit ----------------->
<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

$filterAll = filter();

if (!empty($filterAll['madattour'])) {
    $madattour = $filterAll['madattour'];

    //kiểm tra tồn tại trong db hay không

    //nếu tồn tại lấy ra thông tin người dùng

    //nếu không tồn tại chuyển hướng về trang list
    $datTourDetail = oneRaw("SELECT * FROM tbdattour WHERE madattour='$madattour'");
    if (!empty($datTourDetail)) {
        setFlashData('dattour-detail', $datTourDetail);
    } else {
        redirect('?modules=dattour&action=list');
    }
}

if (isPost()) {
    $filterAll = filter();

    $errors = [];

    if (empty($filterAll['matour'])) {
        $errors['matour']['require'] = "Mã tour bắt buộc phải nhập";
    } else {
        $matour = $filterAll['matour'];
        $sql = "SELECT matour FROM tbtourdulich WHERE matour = '$matour'";
        if (getRows($sql) == 0) {
            $errors['matour']['require'] = "Mã tour này không tại";
        }
    }


    if (empty($filterAll['tenkhachhang'])) {
        $errors['tenkhachhang']['require'] = "Tên khách bắt buộc phải nhập";
    } else {
        if (strlen($filterAll['tenkhachhang']) < 5) {
            $errors['tenkhachhang']['min'] = "Họ và tên khách ít nhất phải lớn hơn 5 ký tự";
        }
    }
    if (empty($filterAll['sodienthoai'])) {
        $errors['sodienthoai']['require'] = "Số điện thoại bắt buộc phải nhập";
    } else {
        if (!isPhone($filterAll['sodienthoai'])) {
            $errors['sodienthoai']['isPhone'] = "Số điện thoại không hợp lệ";
        }
    }
    if (empty($filterAll['ngaydat'])) {
        $errors['ngaydat']['require'] = "Ngày đặt bắt buộc phải nhập";
    }


    if (empty($filterAll['soluongnguoi'])) {
        $errors['soluongnguoi']['require'] = "Số lượng người bắt buộc phải nhập";
    }
    if (empty($filterAll['thongtinphong'])) {
        $errors['thongtinphong']['require'] = "Thông tin phòng bắt buộc phải nhập";
    }
    if (empty($filterAll['coc'])) {
        $errors['coc']['require'] = "Tiền cọc bắt buộc phải nhập";
    }


    if (strtotime($filterAll['ngayditour']) === false || strtotime($filterAll['ngayditour']) > strtotime($filterAll['ngayvetour'])) {
        $errors['ngayditour']['require'] = 'Ngày đi tour không hợp lệ';
    }


    if (empty($errors)) {
        $dataUpdate = [
            'matour' => $filterAll['matour'],
            'tenkhachhang' => $filterAll['tenkhachhang'],
            'sodienthoai' => $filterAll['sodienthoai'],
            'ngaydat' => $filterAll['ngaydat'],
            'soluongnguoi' => $filterAll['soluongnguoi'],
            'thongtinphong' => $filterAll['thongtinphong'],
            'xacnhandattour' => $filterAll['xacnhandattour'],
            'xacnhanthanhtoan' => $filterAll['xacnhanthanhtoan'],
            'xacnhanditour' => $filterAll['xacnhanditour'],
            'ngayditour' => $filterAll['ngayditour'],
            'ngayvetour' => $filterAll['ngayvetour'],
            'phanhoicuakhach' => $filterAll['phanhoicuakhach'],
            'coc' => $filterAll['coc']
        ];


        $condition = "madattour=$madattour";
        $updateStatus = update('tbdattour', $dataUpdate, $condition);
        if ($updateStatus) {
            setFlashData('smg', 'Sửa tour đặt thành công!!');
            setFlashData('smg_type', 'success');
        } else {
            setFlashData('smg', 'Hệ thống đang lỗi vui lòng thử lại sau!!');
            setFlashData('smg_type', 'danger');
        }
    } else {

        setFlashData('smg', 'Vui lòng kiểm tra dữ liệu');
        setFlashData('smg_type', 'danger');
        setFlashData('error', $errors);
        setFlashData('old', $filterAll);
    }

    redirect('?modules=dattour&action=edit&id=' . $madattour);
}




layouts('header');

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
$errors = getFlashData('error');
$old = getFlashData('old');
$datTourDetailll = getFlashData('dattour-detail');

if (!empty($datTourDetailll)) {
    $old = $datTourDetailll;
}
?>


<div class="container">
    <div class="row" style="margin: 100px auto; ">
        <h2 class="text-center text-uppercase mb-4">Sửa người dùng</h2>
        <?php
        if (!empty($smg)) {
            getSmg($smg, $smg_type);
        }
        ?>
        <form action="" method="post">
            <div class="row ">
                <div class="col">
                    <div class="form-group mg-form">
                        <label for="">Mã tour</label>
                        <input name="matour" type="text" class="form-control" placeholder="Mã tour" value="<?php echo (!empty($old['matour'])) ? $old['matour'] : null ?>">
                        <?php
                        echo (!empty($errors['matour'])) ?  '<span class="error">' . reset($errors['matour']) . '</span>' : null;
                        ?>
                    </div>
                    <div class=" form-group mg-form">
                        <label for="">Họ tên khách hàng</label>
                        <input name="tenkhachhang" type="text" class="form-control" placeholder="Họ tên" value="<?php echo (!empty($old['tenkhachhang'])) ? $old['tenkhachhang'] : null ?>">
                        <?php
                        echo (!empty($errors['tenkhachhang'])) ?  '<span class="error">' . reset($errors['tenkhachhang']) . '</span>' : null;
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Số điện thoại</label>
                        <input name="sodienthoai" type="text" class="form-control" placeholder="Số điện thoại " value="<?php echo (!empty($old['sodienthoai'])) ? $old['sodienthoai'] : null ?>">
                        <?php
                        echo (!empty($errors['sodienthoai'])) ?  '<span class="error">' . reset($errors['sodienthoai']) . '</span>' : null;
                        ?>
                    </div>
                    <div class=" form-group mg-form">
                        <label for="">Ngày đặt </label>
                        <input name="ngaydat" type="date" class="form-control" placeholder="Ngày đặt tour" value="<?php echo (!empty($old['ngaydat'])) ? $old['ngaydat'] : null ?>">
                        <?php echo (!empty($errors['ngaydat'])) ?  '<span class="error">' . reset($errors['ngaydat']) . '</span>' : null;
                        ?>
                    </div>
                    <div class=" form-group mg-form">
                        <label for="">Số lượng người</label>
                        <input name="soluongnguoi" type="text" class="form-control" placeholder="Số lượng người" value="<?php echo (!empty($old['soluongnguoi'])) ? $old['soluongnguoi'] : null ?>">
                        <?php
                        echo (!empty($errors['soluongnguoi'])) ?  '<span class="error">' . reset($errors['soluongnguoi']) . '</span>' : null;
                        ?>
                    </div>
                    <div class=" form-group mg-form">
                        <label for="">Thông tin phòng</label>
                        <input name="thongtinphong" type="text" class="form-control" placeholder="Thông tin phòng" value="<?php echo (!empty($old['thongtinphong'])) ? $old['thongtinphong'] : null ?>">
                        <?php
                        echo (!empty($errors['thongtinphong'])) ?  '<span class="error">' . reset($errors['thongtinphong']) . '</span>' : null;
                        ?>
                    </div>
                    <div class=" form-group mg-form">
                        <label for="">Xác nhận đặt tour</label>
                        <select name="xacnhandattour" id="" class="form-control">
                            <option value="0" <?php echo ((!empty($old['xacnhanditour']) && $old['xacnhanditour'] == 0) ? 'selected' : '');
                                                ?>>Chưa Đặt</option>
                            <option value="1" <?php echo ((!empty($old['xacnhanditour']) && $old['xacnhanditour'] == 1) ? 'selected' : '');
                                                ?>>Đã Đặt</option>
                        </select>
                        <?php
                        echo (!empty($errors['xacnhandattour'])) ?  '<span class="error">' . reset($errors['xacnhandattour']) . '</span>' : null;
                        ?>
                    </div>
                </div>
                <div class="col">
                    <div class=" form-group mg-form">
                        <label for="">Xác nhận thanh toán</label>
                        <select name="xacnhanthanhtoan" id="" class="form-control">
                            <option value="1" <?php echo ((!empty($old['xacnhanthanhtoan']) && $old['xacnhanthanhtoan'] == 1) ? 'selected' : '');
                                                ?>>Đã thanh toán</option>
                            <option value="0" <?php echo ((!empty($old['xacnhanthanhtoan']) && $old['xacnhanthanhtoan'] == 0) ? 'selected' : '');
                                                ?>>Chưa thanh toán</option>
                        </select>
                        <?php
                        echo (!empty($errors['xacnhanthanhtoan'])) ?  '<span class="error">' . reset($errors['xacnhanthanhtoan']) . '</span>' : null;
                        ?>
                    </div>
                    <div class=" form-group mg-form">
                        <label for="">Xác nhận đi tour</label>
                        <select name="xacnhanditour" id="" class="form-control">
                            <option value="1" <?php echo ((!empty($old['xacnhanditour']) && $old['xacnhanditour'] == 1) ? 'selected' : '');
                                                ?>>Có đi</option>
                            <option value="01" <?php echo ((!empty($old['xacnhanditour']) && $old['xacnhanditour'] == 0) ? 'selected' : '');
                                                ?>>Chưa đi</option>
                        </select>
                        <?php
                        echo (!empty($errors['xacnhanditour'])) ?  '<span class="error">' . reset($errors['xacnhanditour']) . '</span>' : null;
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Ngày đi tour</label>
                        <input name="ngayditour" type="date" class="form-control" placeholder="Ngày đi" value="<?php echo (!empty($old['ngayditour'])) ? $old['ngayditour'] : null ?>">
                        <?php
                        echo (!empty($errors['ngayditour'])) ?  '<span class="error">' . reset($errors['ngayditour']) . '</span>' : null;
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Ngày về tour</label>
                        <input name="ngayvetour" type="date" class="form-control" placeholder="Ngày đi" value="<?php echo (!empty($old['ngayvetour'])) ? $old['ngayvetour'] : null ?>">
                        <?php
                        echo (!empty($errors['ngayvetour'])) ?  '<span class="error">' . reset($errors['ngayvetour']) . '</span>' : null;
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Phản hồi của khách</label>
                        <input name="phanhoicuakhach" class="form-control" placeholder="Phản hồi của khách" value="<?php echo (!empty($old['phanhoicuakhach'])) ? $old['phanhoicuakhach'] : null ?>"></input>
                        <?php
                        echo (!empty($errors['phanhoicuakhach'])) ?  '<span class="error">' . reset($errors['phanhoicuakhach']) . '</span>' : null;
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Cọc</label>
                        <input name="coc" type="text" class="form-control" placeholder="Cọc" value="<?php echo (!empty($old['coc'])) ? $old['coc'] : null ?>">
                        <?php
                        echo (!empty($errors['coc'])) ?  '<span class="error">' . reset($errors['coc']) . '</span>' : null;
                        ?>
                    </div>
                </div>
            </div>



            <input type="hidden" name="madattour" value="<?php echo $madattour ?>">


            <button type="submit" class="mg-btn mg-form btn btn-warning btn-block ">
                Update
            </button>
            <a href="?modules=dattour&action=list"><button type="button" class="btn btn-secondary">Quay
                    lại</button></a>

        </form>
    </div>
</div>

<?php
layouts('footer');
?>