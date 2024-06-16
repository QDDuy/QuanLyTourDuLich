<!-- <------------------Edit ----------------->
<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

$filterAll = filter();

if (!empty($filterAll['mathanhtoan'])) {
    $mathanhtoan = $filterAll['mathanhtoan'];

    //kiểm tra tồn tại trong db hay không

    //nếu tồn tại lấy ra thông tin người dùng

    //nếu không tồn tại chuyển hướng về trang list
    $thanhToanDetail = oneRaw("SELECT * FROM tbthanhtoan WHERE mathanhtoan='$mathanhtoan'");
    if (!empty($thanhToanDetail)) {
        setFlashData('thanhtoan-detail', $thanhToanDetail);
    } else {
        redirect('?modules=thanhtoan&action=list');
    }
}

if (isPost()) {
    $filterAll = filter();

    $errors = [];
    if (empty($filterAll['madattour'])) {
        $errors['madattour']['require'] = "Mã đặt tour bắt buộc phải nhập";
    } else {
        $madattour  = $filterAll['madattour'];
        $sql = "SELECT madattour  FROM tbdattour WHERE madattour = '$madattour'";
        if (getRows($sql) == 0) {
            $errors['madattour']['require'] = "Mã tour này không tại";
        }
    }


    if (empty($filterAll['ngaythanhtoan'])) {
        $errors['ngaythanhtoan']['require'] = "Ngày thanh toán bắt buộc phải nhập";
    }


    if (empty($filterAll['sotien'])) {
        $errors['sotien']['require'] = "Số tiền bắt buộc phải nhập";
    }
    if (empty($filterAll['phuongthucthanhtoan'])) {
        $errors['phuongthucthanhtoan']['require'] = "Phương thức thanh toán bắt buộc phải nhập";
    }
    if (empty($errors)) {
        $dataUpdate = [
            'madattour' => $filterAll['madattour'],
            'ngaythanhtoan' => $filterAll['ngaythanhtoan'],
            'sotien' => $filterAll['sotien'],
            'phuongthucthanhtoan' => $filterAll['phuongthucthanhtoan'],
        ];


        $condition = "mathanhtoan=$mathanhtoan";
        $updateStatus = update('tbthanhtoan', $dataUpdate, $condition);
        if ($updateStatus) {
            setFlashData('smg', 'Sửa thông tin thanh toán thành công!!');
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

    redirect('?modules=thanhtoan&action=edit&id=' . $mathanhtoan);
}




layouts('header');

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
$errors = getFlashData('error');
$old = getFlashData('old');
$thanhToanDetailll = getFlashData('thanhtoan-detail');

if (!empty($thanhToanDetailll)) {
    $old = $thanhToanDetailll;
}
?>


<div class="container">
    <div class="row" style="margin: 100px auto; ">
        <h2 class="text-center text-uppercase mb-4">Sửa thông tin</h2>
        <?php
        if (!empty($smg)) {
            getSmg($smg, $smg_type);
        }
        ?>
        <form action="" method="post">
            <div class="row ">
                <div class="col">
                    <div class=" form-group mg-form">
                        <label for="">Mã đặt tour</label>
                        <input name="madattour" type="text" class="form-control" placeholder="Mã đặt tour"
                            value="<?php echo (!empty($old['madattour'])) ? $old['madattour'] : null ?>">
                        <?php
                        echo (!empty($errors['madattour'])) ?  '<span class="error">' . reset($errors['madattour']) . '</span>' : null;
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Ngày thanh toán</label>
                        <input name="ngaythanhtoan" type="date" class="form-control" placeholder="Ngày thanh toán "
                            value="<?php echo (!empty($old['ngaythanhtoan'])) ? $old['ngaythanhtoan'] : null ?>">
                        <?php
                        echo (!empty($errors['ngaythanhtoan'])) ?  '<span class="error">' . reset($errors['ngaythanhtoan']) . '</span>' : null;
                        ?>
                    </div>
                    <div class=" form-group mg-form">
                        <label for="">Số tiền</label>
                        <input name="sotien" type="text" class="form-control" placeholder="Số tiền"
                            value="<?php echo (!empty($old['sotien'])) ? $old['sotien'] : null ?>">
                        <?php
                        echo (!empty($errors['sotien'])) ?  '<span class="error">' . reset($errors['sotien']) . '</span>' : null;
                        ?>
                    </div>
                    <div class=" form-group mg-form">
                        <label for="">Phương thức thanh toán</label>
                        <input name="phuongthucthanhtoan" type="text" class="form-control"
                            placeholder="Phương thức thanh toán"
                            value="<?php echo (!empty($old['phuongthucthanhtoan'])) ? $old['phuongthucthanhtoan'] : null ?>">
                        <?php
                        echo (!empty($errors['phongthucthanhtoan'])) ?  '<span class="error">' . reset($errors['phuongthucthanhtoan']) . '</span>' : null;
                        ?>
                    </div>

                    <input type="hidden" name="mathanhtoan" value="<?php echo $mathanhtoan ?>">


                    <button type="submit" class="mg-btn mg-form btn btn-warning btn-block ">
                        Update
                    </button>
                    <a href="?modules=thanhtoan&action=list"><button type="button" class="btn btn-secondary">Quay
                            lại</button></a>

        </form>
    </div>
</div>

<?php
layouts('footer');
?>