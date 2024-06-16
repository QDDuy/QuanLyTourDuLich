<!-- <------------------Thêm ----------------->
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
            'matkhau' => $filterAll['password'],
            'quyentruycap' => $filterAll['quyentruycap']
        ];

        $insertStatus = insert('tbnguoidung', $datainsert);
        if ($insertStatus) {
            setFlashData('smg', 'Thêm người dùng thành công!!');
            setFlashData('smg_type', 'success');
            redirect('?modules=users&action=list');
        } else {
            setFlashData('smg', 'Hệ thống đang lỗi vui lòng thử lại sau!!');
            setFlashData('smg_type', 'danger');
        }

        redirect('?modules=users&action=add');
    } else {

        setFlashData('smg', 'Vui lòng kiểm tra dữ liệu');
        setFlashData('smg_type', 'danger');
        setFlashData('error', $errors);
        setFlashData('old', $filterAll);
        redirect('?modules=users&action=add');
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
        <h2 class="text-center text-uppercase mb-4">Thêm người dùng</h2>
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
                        <input name="email" type="email" class="form-control" placeholder="Địa chỉ email">
                        <?php
                        echo (!empty($errors['email'])) ?  '<span class="error">' . reset($errors['email']) . '</span>' : null;
                        ?>
                    </div>
                    <div class=" form-group mg-form">
                        <label for="">Họ tên</label>
                        <input name="hoten" type="text" class="form-control" placeholder="Họ tên"
                            value="<?php echo (!empty($old['hoten'])) ? $old['hoten'] : null ?>">
                        <?php
                        echo (!empty($errors['hoten'])) ?  '<span class="error">' . reset($errors['hoten']) . '</span>' : null;
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Mật khẩu"
                            value="<?php echo (!empty($old['password'])) ? $old['password'] : null ?>">
                        <?php
                        echo (!empty($errors['password'])) ?  '<span class="error">' . reset($errors['password']) . '</span>' : null;
                        ?>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group mg-form">
                        <label for="">Nhập lại Password</label>
                        <input name="password_confirm" type="password" class="form-control"
                            placeholder="Nhập lại mật khẩu"
                            value="<?php echo (!empty($old['password_confirm'])) ? $old['password_confirm'] : null ?>">
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




            <button type="submit" class="mg-btn mg-form btn btn-success btn-block ">
                Thêm
            </button>
            <a href="?modules=users&action=list"><button type="button" class="btn btn-secondary">Quay lại</button></a>

        </form>
    </div>
</div>

<?php
layouts('footer');
?>