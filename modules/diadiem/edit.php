<!-- <------------------Sửa ----------------->
<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

$filterAll = filter();

if (!empty($filterAll['madiadiem'])) {
    $madiadiem = $filterAll['madiadiem'];
    $userDetail = oneRaw("SELECT * FROM tbdiadiem WHERE madiadiem='$madiadiem'");
    if (!empty($userDetail)) {
        // mã người dùng tồn tại
        setFlashData('user-detail', $userDetail);
    } else {
        redirect('?modules=diadiem&action=list');
    }
}

if (isPost()) {
    $filterAll = filter();

    $errors = [];
    //validate fullname: bắt buộc phải nhập , số ký tự phải trên 5

    if (empty($filterAll['tendiadiem'])) {
        $errors['tendiadiem']['require'] = "Tên địa điểm bắt buộc phải nhập";
    } else {
        if (strlen($filterAll['tendiadiem']) < 5) {
            $errors['tendiadiem']['require'] = "địa điểm ít nhất phải có trên 5 ký tự";
        }
    }



    if (empty($errors)) {
        $dataUpdate = [
            'tendiadiem' => $filterAll['tendiadiem'],
            'mota' => $filterAll['mota'],
            'hinhanh' => $filterAll['hinhanh']
        ];

        $condition = "madiadiem=$madiadiem";
        $updateStatus = update('tbdiadiem', $dataUpdate, $condition);
        if ($updateStatus) {
            setFlashData('smg', 'Sửa địa điểm thành công!!');
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

    redirect('?modules=diadiem&action=edit&id=' . $madiadiem);
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
        <h2 class="text-center text-uppercase mb-4">Sửa địa điểm du lịch</h2>
        <?php
        if (!empty($smg)) {
            getSmg($smg, $smg_type);
        }
        ?>
        <form action="" method="post">
            <div class="row ">
                <div class="col">
                    <div class="form-group mg-form">
                        <label for="">Tên địa điểm</label>
                        <input name="tendiadiem" type="text" class="form-control" placeholder="Tên địa điểm" value=" <?php echo (!empty($old['tendiadiem'])) ? $old['tendiadiem'] : null ?>">
                        <?php
                        echo (!empty($errors['tendiadiem'])) ?  '<span class="error">' . reset($errors['tendiadiem']) . '</span>' : null;
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Mô tả</label>
                        <input name="mota" type="text" class="form-control" placeholder="Mô tả" value="<?php echo (!empty($old['mota'])) ? $old['mota'] : null ?>">
                        <?php
                        echo (!empty($errors['mota'])) ?  '<span class="error">' . reset($errors['mota']) . '</span>' : null;
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Hình ảnh </label>
                        <input name="hinhanh" type="file" class="form-control" placeholder="Hình ảnh" value="<?php echo (!empty($old['hinhanh'])) ? $old['hinhanh'] : null ?>">
                        <?php
                        echo (!empty($errors['hinhanh'])) ?  '<span class="error">' . reset($errors['hinhanh']) . '</span>' : null;
                        ?>
                    </div>
                </div>
            </div>


            <input type="hidden" name="madiadiem" value="<?php echo $madiadiem ?>">

            <button type="submit" class="mg-btn mg-form btn btn-warning btn-block ">
                Update
            </button>
            <a href="?modules=diadiem&action=list"><button type="button" class="btn btn-secondary">Quay
                    lại</button></a>

        </form>
    </div>
</div>

<?php
layouts('footer');
?>