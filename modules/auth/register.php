<!-- <------------------Đăng ký----------------->
<?php
if (!defined('_CODE')) {
    die("Access dinied....");
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
        $sql = "SELECT manguoidung FROM tbnguoidung WHERE email='$email'";
        if (getRows($sql) > 0) {
            $errors['email']['unique'] = "Email đã tồn tại";
        }
    }

    //validate password: bắt buộc phải nhập,>= 8 ký tự
    if (empty($filterAll['password'])) {
        $errors['password']['require'] = "Mật khẩu bắt buộc phải nhập";
    } else {
        if (strlen($filterAll['password']) < 8) {
            $errors['password']['min'] = "Mật khẩu ít nhất phải lớn hơn 8 ký tự";
        }
    }


    //password_confirm : password không được để trống, password_confirm phải giống password ;
    if (empty($filterAll['password_confirm'])) {
        $errors['password_confirm']['require'] = "Mật khẩu nhập lại bắt buộc phải nhập";
    } else {
        if ($filterAll['password_confirm'] != $filterAll['password']) {
            $errors['password_confirm']['require'] = "Mật khẩu nhập lại không đúng";
        }
    }

    if (empty($errors)) {
        $datainsert = [
            'hoten' => $filterAll['hoten'],
            'email' => $filterAll['email'],
            'matkhau' => $filterAll['password'] // Không sử dụng password_hash
        ];

        $insertStatus = insert('tbnguoidung', $datainsert);
        if ($insertStatus) {
            setFlashData('smg', 'Đăng ký thành công!!');
            setFlashData('smg_type', 'success');
        }

        redirect('?modules=auth&action=register');
    } else {

        setFlashData('smg', 'Vui lòng kiểm tra dữ liệu');
        setFlashData('smg_type', 'danger');
        setFlashData('error', $errors);
        setFlashData('old', $filterAll);

        redirect('?modules=auth&action=register');
    }
}




layouts('header-login');

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
$errors = getFlashData('error');
$old = getFlashData('old');


?>


<div class="row">
    <div class="col-4" style="margin: 100px auto;">
        <h2 class="text-center text-uppercase">Đăng Ký</h2>
        <?php
        if (!empty($smg)) {
            getSmg($smg, $smg_type);
        }
        ?>
        <form action="" method="post">
            <div class="form-group mg-form">
                <label for="">Email</label>
                <input name="email" type="email" class="form-control" placeholder="Địa chỉ email" value="<?php echo (!empty($old['email'])) ? $old['email'] : null ?>">
                <?php
                echo (!empty($errors['email'])) ?  '<span class="error">' . reset($errors['email']) . '</span>' : null;
                ?>
            </div>
            <div class=" form-group mg-form ">
                <label for="">Họ tên</label>
                <input name=" hoten" type="text" class="form-control" placeholder="Họ tên" value="<?php echo (!empty($old['hoten'])) ? $old['hoten'] : null ?>">

                <?php
                echo (!empty($errors['hoten'])) ?  '<span class="error">' . reset($errors['hoten']) . '</span>' : null;
                ?>
            </div>
            <div class=" form-group mg-form">
                <label for="">Password</label>
                <input name="password" type="text" class="form-control" placeholder="Mật khẩu" value="<?php echo (!empty($old['password_confirm'])) ? $old['password_confirm'] : null ?>">
                <?php
                echo (!empty($errors['password'])) ?  '<span class="error">' . reset($errors['password']) . '</span>' : null;
                ?>
            </div>
            <div class="form-group mg-form">
                <label for="">Nhập lại Password</label>
                <input name="password_confirm" type="password" class="form-control" placeholder="Nhập lại mật khẩu" value="<?php echo (!empty($old['password_confirm'])) ? $old['password_confirm'] : null ?>">
                <?php
                echo (!empty($errors['password_confirm'])) ?  '<span class="error">' . reset($errors['password_confirm']) . '</span>' : null;
                ?>
            </div>



            <button type="submit" class="mg-btn mg-form btn btn-primary btn-block w-100">
                Đăng Ký
            </button>
            <hr>
            <p class="text-center"><a href="?modules=auth&action=login">Đăng nhập tài khoản</a></p>
        </form>
    </div>
</div>

<?php
layouts('footer-login');
?>