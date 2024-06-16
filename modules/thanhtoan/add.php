<!-- <------------------Thêm ----------------->
<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

if (isPost()) {
    $filterAll = filter();
    if (empty($filterAll['madattour'])) {
        $errors['madattour']['require'] = "Mã đặt tour bắt buộc phải nhập";
    } else {
        $madattour  = $filterAll['madattour'];
        $sql = "SELECT madattour  FROM tbdattour WHERE madattour  = '$madattour'";
        if (getRows($sql) == 0) {
            $errors['madattour']['require'] = "Mã tour này không tại";
        }
    }
    if (empty($filterAll['tenkhachhang'])) {
        $errors['tenkhachhang']['require'] = "Tên khách hàng bắt buộc phải nhập";
    } else {
        $madattour = $filterAll['madattour'];
        $tenkhachhang = $filterAll['tenkhachhang'];  // Sửa lỗi chính tả
        $sql = "SELECT * FROM tbdattour WHERE tenkhachhang = '$tenkhachhang' AND madattour = '$madattour'";
        if (getRows($sql) == 0) {
            $errors['tenkhachhang']['require'] = "Tên khách hàng này không phải của mã đặt tour trên";  // Sửa thông điệp lỗi
        }
    }
    if (empty($filterAll['ngaythanhtoan'])) {
        $errors['ngaythanhtoan']['require'] = "Ngày thanh toán bắt buộc phải nhập";
    }


    //password_confirm : password không được để trống, password_confirm phải giống password ;
    if (empty($filterAll['sotien'])) {
        $errors['sotien']['require'] = "Số tiền bắt buộc phải nhập";
    }
    if (empty($filterAll['phuongthucthanhtoan'])) {
        $errors['phuongthucthanhtoan']['require'] = "Phương thức thanh toán bắt buộc phải nhập";
    }
    if (empty($errors)) {
        $datainsert = [
            'madattour' => $filterAll['madattour'],
            'tenkhachhang' => $filterAll['tenkhachhang'],
            'ngaythanhtoan' => $filterAll['ngaythanhtoan'],
            'sotien' => $filterAll['sotien'],
            'phuongthucthanhtoan' => $filterAll['phuongthucthanhtoan'],
        ];


        $insertStatus = insert('tbthanhtoan', $datainsert);


        if ($insertStatus) {
            $dataUpdate = [
                'xacnhanthanhtoan' => '1',
                'xacnhandattour' => '1',
            ];
            $condition = "madattour = '{$filterAll['madattour']}'";
            $updateStatus = update('tbdattour', $dataUpdate, $condition);

            setFlashData('smg', 'Thêm thành công!!');
            setFlashData('smg_type', 'success');
            redirect('?modules=thanhtoan&action=list');
        } else {
            setFlashData('smg', 'Hệ thống đang lỗi vui lòng thử lại sau!!');
            setFlashData('smg_type', 'danger');
        }

        redirect('?modules=thanhtoan&action=add');
    } else {

        setFlashData('smg', 'Vui lòng kiểm tra dữ liệu');
        setFlashData('smg_type', 'danger');
        setFlashData('error', $errors);
        setFlashData('old', $filterAll);
        redirect('?modules=thanhtoan&action=add');
    }
}




layouts('header');

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
$errors = getFlashData('error');
$old = getFlashData('old');
?>


<div class="container">
    <div class="row" style="margin: 100px auto; ">
        <h2 class="text-center text-uppercase mb-4">Thêm thông tin thanh toán</h2>
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
                        <input name="madattour" type="text" class="form-control" placeholder="Mã đặt tour" value="<?php echo (!empty($old['madattour'])) ? $old['madattour'] : null ?>">
                        <?php
                        echo (!empty($errors['madattour'])) ?  '<span class="error">' . reset($errors['madattour']) . '</span>' : null;
                        ?>
                    </div>
                    <div class=" form-group mg-form">
                        <label for="">Tên khách hàng</label>
                        <input name="tenkhachhang" type="text" class="form-control" placeholder="Tên khách hàng" value="<?php echo (!empty($old['tenkhachhang'])) ? $old['tenkhachhang'] : null ?>">
                        <?php
                        echo (!empty($errors['tenkhachhang'])) ?  '<span class="error">' . reset($errors['tenkhachhang']) . '</span>' : null;
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Ngày thanh toán</label>
                        <input name="ngaythanhtoan" type="date" class="form-control" placeholder="Ngày thanh toán" value="<?php echo (!empty($old['ngaythanhtoan'])) ? $old['ngaythanhtoan'] : null ?>">
                        <?php
                        echo (!empty($errors['ngaythanhtoan'])) ?  '<span class="error">' . reset($errors['ngaythanhtoan']) . '</span>' : null;
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Số tiền</label>
                        <input name="sotien" type="text" class="form-control" placeholder="Số tiền" value="<?php echo (!empty($old['sotien'])) ? $old['sotien'] : null ?>">
                        <?php
                        echo (!empty($errors['sotien'])) ?  '<span class="error">' . reset($errors['sotien']) . '</span>' : null;
                        ?>
                    </div>
                    <div class=" form-group mg-form">
                        <label for="">Phương thức thanh toán</label>
                        <input name="phuongthucthanhtoan" type="text" class="form-control" placeholder="Phương thức thanh toán" value="<?php echo (!empty($old['phuongthucthanhtoan'])) ? $old['phuongthucthanhtoan'] : null ?>">
                        <?php
                        echo (!empty($errors['phuongthucthanhtoan'])) ?  '<span class="error">' . reset($errors['phuongthucthanhtoan']) . '</span>' : null;
                        ?>
                    </div>
                    <button type="submit" class="mg-btn mg-form btn btn-success btn-block ">
                        Thêm
                    </button>
                    <a href="?modules=thanhtoan&action=list"><button type="button" class="btn btn-secondary">Quay
                            lại</button></a>

        </form>
    </div>
</div>

<?php
layouts('footer');
?>