<!-- <------------------Thêm ----------------->
<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

$filterAll = filter();

if (!empty($filterAll['manguoidung'])) {
    $manguoidung = $filterAll['manguoidung'];

    $userDetail = oneRaw("SELECT * FROM tbnguoidung WHERE manguoidung='$manguoidung'");
    if (!empty($userDetail)) {
        setFlashData('user-detail', $userDetail);
    } else {
        redirect('?modules=users&action=list');
    }
}

if (isPost()) {
    $filterAll = filter();

    $errors = [];
    //validate fullname: bắt buộc phải nhập , số ký tự phải trên 5

    if (empty($filterAll['hoten'])) {
        $errors['hoten']['require'] = "Ho tên bắt buộc phải nhập";
    } else {
        if (strlen($filterAll['hoten']) < 5) {
            $errors['hoten']['require'] = "Họ tên ít nhất phải có trên 5 ký tự";
        }
    }

    //validate email: có trong db hay không,bắt buộc phải nhâp
    if (empty($filterAll['email'])) {
        $errors['email']['require'] = "Email bắt buộc phải nhập";
    } else {
        $email = $filterAll['email'];
        $sql = "SELECT manguoidung FROM tbnguoidung WHERE email='$email'AND manguoidung<>$manguoidung";
        if (getRows($sql) > 0) {
            $errors['email']['unique'] = "Email đã tồn tại";
        }
    }
    if (empty($filterAll['password_confirm'])) {
        $errors['password_confirm']['required'] = "Bạn phải nhập lại mật khẩu";
    } else {
        if (($filterAll['password']) !== ($filterAll['password_confirm'])) {
            $errors['password_confirm']['match'] = "Mật khẩu nhập lại không đúng";
        }
    }
    if (empty($errors)) {
        $dataUpdate = [
            'hoten' => $filterAll['hoten'],
            'email' => $filterAll['email'],
            'quyentruycap' => $filterAll['quyentruycap']
        ];

        if (!empty($filterAll['password'])) {
            $dataUpdate['matkhau'] = $filterAll['password'];
        }
        $condition = "manguoidung=$manguoidung";
        $updateStatus = update('tbnguoidung', $dataUpdate, $condition);
        if ($updateStatus) {
            setFlashData('smg', 'Sửa thành công!!');
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

    redirect('?modules=users&action=edit&id=' . $manguoidung);
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
                        <label for="">Email</label>
                        <input name="email" type="email" class="form-control" placeholder="Địa chỉ email" value="<?php echo (!empty($old['email'])) ? $old['email'] : null ?>">
                        <?php
                        echo (!empty($errors['email'])) ?  '<span class="error">' . reset($errors['email']) . '</span>' : null;
                        ?>
                    </div>
                    <div class=" form-group mg-form">
                        <label for="">Họ tên</label>
                        <input name="hoten" type="text" class="form-control" placeholder="Họ tên" value="<?php echo (!empty($old['hoten'])) ? $old['hoten'] : null ?>">
                        <?php
                        echo (!empty($errors['hoten'])) ?  '<span class="error">' . reset($errors['hoten']) . '</span>' : null;
                        ?>
                    </div>
                    <div class="form-group mg-form"> <label for="">Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Mật khẩu(Không thay đổi thì không nhâp)">
                        <?php
                        echo (!empty($errors['password'])) ?  '<span class="error">' . reset($errors['password']) . '</span>' : null;
                        ?>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group mg-form">
                        <label for="">Nhập lại Password</label>
                        <input name="password_confirm" type="password" class="form-control" placeholder="Nhập lại mật khẩu(Không thay đổi thì không nhập)">
                        <?php
                        echo (!empty($errors['password_confirm'])) ?  '<span class="error">' . reset($errors['password_confirm']) . '</span>' : null;
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Quyền truy cập</label>
                        <select name="quyentruycap" id="" class="form-control">
                            <option value="Quản Lý" <?php echo ((!empty($old['quyentruycap']) && $old['quyentruycap'] == 'Quản lý') ? 'selected' : '');
                                                    ?>>
                                Quản
                                Lý</option>
                            <option value="Nhân Viên" <?php echo ((!empty($old['quyentruycap']) && $old['quyentruycap'] == 'Nhân Viên') ? 'selected' : '');
                                                        ?>>
                                Nhân
                                Viên</option>
                        </select>

                    </div>
                </div>
            </div>


            <input type="hidden" name="manguoidung" value="<?php echo $manguoidung ?>">

            <button type="submit" class="mg-btn mg-form btn btn-warning btn-block ">
                Update
            </button>
            <a href="?modules=users&action=list"><button type="button" class="btn btn-secondary">Quay lại</button></a>

        </form>
    </div>
</div>

<?php
layouts('footer');
?>