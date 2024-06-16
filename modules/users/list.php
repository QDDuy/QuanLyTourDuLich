<!-- Danh sách người dùng -->
<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}
$data = [
    'pageTitle' => 'Danh sách người dùng'
];
layouts('header', $data);


$listUsers = getRaw("SELECT * FROM tbnguoidung ORDER BY ngaydangky");

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');


?>
<div class="container">

    <h2>Quản lý người dùng</h2>
    <a href="?modules=users&action=add" class="btn btn-success btn-sm"><i class="fa-solid fa-plus"></i> Thêm người
        dùng</a>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <form class="d-flex" role="search" action="?modules=users&action=search" method="post">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>


        </div>
    </nav>
    <?php
    if (!empty($smg)) {
        getSmg($smg, $smg_type);
    }
    $kq = getRows("SELECT * FROM tbnguoidung ");
    echo "Đang có $kq người dùng";
    ?>
    <table class="table table-bordered table-hover mt-3">
        <thead class="table-info">
            <th>ID</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Mật khẩu</th>
            <th>Quyền</th>
            <th>Ngày đăng ký</th>
            <th with=5%>Sửa</th>
            <th with=5%>Xóa</th>
        </thead>

        <tbody>
            <?php
            if (!empty($listUsers)) :
                foreach ($listUsers as $item) :
            ?>
                    <tr>
                        <td><?php echo $item['manguoidung'] ?></td>
                        <td><?php echo $item['hoten'] ?></td>
                        <td><?php echo $item['email'] ?></td>
                        <td><?php echo $item['matkhau'] ?></td>
                        <td><?php echo $item['quyentruycap'] ?></td>
                        <td><?php echo $item['ngaydangky'] ?></td>
                        <td><a href="<?php echo _WEB_HOST ?>?modules=users&action=edit&manguoidung=<?php echo $item['manguoidung'] ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><a href="<?php echo _WEB_HOST ?>?modules=users&action=delete&manguoidung=<?php echo $item['manguoidung'] ?>" onclick=" return confirm('Bạn có chắc muốn xóa?')" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                <?php
                endforeach;
            else :
                ?>
                <tr>
                    <td colspan="7">
                        <div class="alert alert-danger text-center">Không thấy người dùng nào</div>
                    </td>
                </tr>
            <?php
            endif;
            ?>
        </tbody>


    </table>
</div>
<?php
layouts('footer');
?>