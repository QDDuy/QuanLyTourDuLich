<!-- <------------------Sửa ----------------->
<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

$filterAll = filter();

if (!empty($filterAll['matour'])) {
    $matour = $filterAll['matour'];

    //kiểm tra tồn tại trong db hay không

    //nếu tồn tại lấy ra thông tin người dùng

    //nếu không tồn tại chuyển hướng về trang list
    $userDetail = oneRaw("SELECT * FROM tbtourdulich WHERE matour='$matour'");
    if (!empty($userDetail)) {
        // mã người dùng tồn tại
        setFlashData('user-detail', $userDetail);
    } else {
        redirect('?modules=tourdulich&action=list');
    }
}

if (isPost()) {
    $filterAll = filter();

    $errors = [];
    //validate fullname: bắt buộc phải nhập , số ký tự phải trên 5

    if (empty($filterAll['tentour'])) {
        $errors['tentour']['require'] = "Tên tour bắt buộc phải nhập";
    } else {
        if (strlen($filterAll['tentour']) < 5) {
            $errors['tentour']['require'] = "Họ tên ít nhất phải có trên 5 ký tự";
        }
    }

    //validate mã địa điểm: có trong db hay không,bắt buộc phải nhâp
    

    //validate giá tour: bắt buộc phải nhập
    if (empty($filterAll['gia'])) {
        $errors['gia']['require'] = "giá tour bắt buộc phải nhập";
    } 




    if (empty($errors)) {
        $dataUpdate = [
            'tentour' => $filterAll['tentour'],
            'gia' => $filterAll['gia'],
            'mota' => $filterAll['mota'],
            'ngaybatdau' => $filterAll['ngaybatdau'],
            'ngayketthuc' => $filterAll['ngayketthuc']
        ];

        $condition = "matour=$matour";
        $updateStatus = update('tbtourdulich', $dataUpdate, $condition);
        if ($updateStatus) {
            setFlashData('smg', 'Sửa tour thành công!!');
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

    redirect('?modules=tourdulich&action=edit&id=' . $matour);
}




layouts('header');

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
$errors = getFlashData('error');
$old = getFlashData('old');
$userDetailll = getFlashData('user-detail');
if (!empty($userDetailll)) {
    $old = $userDetailll;
}



?>


<div class="container">
    <div class="row" style="margin: 100px auto; ">
        <h2 class="text-center text-uppercase mb-4">Sửa tour du lịch</h2>
        <?php
        if (!empty($smg)) {
            getSmg($smg, $smg_type);
        } 
        ?>
        <form action="" method="post">
            <div class="row ">
                <div class="col">
                    <div class="form-group mg-form">
                        <label for="">Tên tour</label>
                        <input name="tentour" type="text" class="form-control" placeholder="Tên tour"
                            value=" <?php echo (!empty($old['tentour'])) ? $old['tentour'] : null ?>">
                        <?php
                        echo (!empty($errors['tentour'])) ?  '<span class="error">' . reset($errors['tentour']) . '</span>' : null;
                        ?>
                    </div>

                    <div class="form-group mg-form">
                        <label for="">Giá</label>
                        <input name="gia" type="text" class="form-control" placeholder="Giá"
                            value="<?php echo (!empty($old['gia'])) ? $old['gia'] : null ?>">
                        <?php
                        echo (!empty($errors['gia'])) ?  '<span class="error">' . reset($errors['gia']) . '</span>' : null;
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Mô tả</label>
                        <input name="mota" type="text" class="form-control" placeholder="Mô tả"
                            value="<?php echo (!empty($old['mota'])) ? $old['mota'] : null ?>">
                        <?php
                        echo (!empty($errors['mota'])) ?  '<span class="error">' . reset($errors['mota']) . '</span>' : null;
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Ngày bắt đầu </label>
                        <input name="ngaybatdau" type="date" class="form-control" placeholder="Ngày bắt đầu"
                            value="<?php echo (!empty($old['ngaybatdau'])) ? $old['ngaybatdau'] : null ?>">
                        <?php
                        echo (!empty($errors['ngaybatdau'])) ?  '<span class="error">' . reset($errors['ngaybatdau']) . '</span>' : null;
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Ngày kết thúc</label>
                        <input name="ngayketthuc" type="date" class="form-control" placeholder="Ngày kết thúc"
                            value="<?php echo (!empty($old['ngayketthuc'])) ? $old['ngayketthuc'] : null ?>">
                        <?php
                        echo (!empty($errors['ngayketthuc'])) ?  '<span class="error">' . reset($errors['ngayketthuc']) . '</span>' : null;
                        ?>
                    </div>
                </div>
            </div>


            <input type="hidden" name="matour" value="<?php echo $matour ?>">

            <button type="submit" class="mg-btn mg-form btn btn-warning btn-block ">
                Update
            </button>
            <a href="?modules=tourdulich&action=list"><button type="button" class="btn btn-secondary">Quay
                    lại</button></a>

        </form>
    </div>
</div>

<?php
layouts('footer');
?>