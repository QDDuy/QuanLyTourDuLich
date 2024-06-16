<!-- Đăng nhập -->
<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

$data = [
    'pageTitle' => 'Đăng Nhập'
];
layouts('header-login', $data);



if (isPost()) {
    $filterAll = filter();

    if (!empty(trim($filterAll['email'])) && !empty(trim($filterAll['matkhau']))) {
        $email = $filterAll['email'];
        $matkhau = $filterAll['matkhau'];
        //truy vấn lấy thông tin theo email
        $userQuery = oneRaw("SELECT manguoidung, matkhau, quyentruycap,email FROM tbnguoidung WHERE email='$email'");
        if (!empty($userQuery)) {
            if ($matkhau === $userQuery['matkhau']) {
                setSession('logged_in', true);
                setSession('user_id', $userQuery['manguoidung']);
                setSession('quyentruycap', $userQuery['quyentruycap']);
                redirect('?modules=home&action=dashboard');
            } else {
                setFlashData('msg', 'Mật khẩu không chính xác');
                setFlashData('msg_type', 'danger');
            }
        } else {
            setFlashData('msg', 'Email không tồn tại');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Vui lòng nhập email và mật khẩu.');
        setFlashData('msg_type', 'danger');
    }
    redirect('?modules=auth&action=login');
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
?>
<div class="row">
    <div class="col-4" style="margin: 100px auto; ">
        <h2 class="text-center text-uppercase">Đăng Nhập Quản Lý</h2>
        <?php
        if (!empty($msg)) {
            getSmg($msg, $msg_type);
        }
        ?>
        <form action="" method="post">

            <div class="form-group mg-form">
                <label for="">Email</label>
                <input name="email" type="email" class="form-control" placeholder="Địa chỉ email">
            </div>
            <div class="form-group mg-form">
                <label for="">Password</label>
                <input name="matkhau" type="password" class="form-control" placeholder="Mật khẩu">
            </div>

            <button type="submit" class="mg-btn mg-form btn btn-primary btn-block w-100">
                Đăng Nhập
            </button>
            <hr>
            <p class="text-center"><a href="?modules=auth&action=register">Đăng Ký</a></p>
        </form>
    </div>
</div>





<?php
layouts('footer-login');
?>