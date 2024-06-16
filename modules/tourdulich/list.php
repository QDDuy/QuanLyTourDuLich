<!-- Quản lý tour du lịch -->
<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}
$data = [
    'pageTitle' => 'Danh sách người dùng'
];
layouts('header', $data);
$listUsers = getRaw("SELECT * FROM tbtourdulich ");

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');


?>
<div class="container">

    <h2>Quản lý tour du lịch</h2>
    <a href="?modules=tourdulich&action=add" class="btn btn-success btn-sm"><i class="fa-solid fa-plus"></i> Thêm tour
        du lịch</a>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <form class="d-flex" role="search" action="?modules=tourdulich&action=search" method="post">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>


        </div>
    </nav>
    <?php
    if (!empty($smg)) {
        getSmg($smg, $smg_type);
    }
    $kq = getRows("SELECT * FROM tbtourdulich");
    echo "Web hiện tại đang có $kq tour du lịch";
    ?>
    <table class="table table-bordered table-hover mt-3">
        <thead class="table-success">
            <th>ID</th>
            <th>Tên tour</th>
            <th>Giá</th>
            <th>Mô tả</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th with=5%>Sửa</th>
            <th with=5%>Xóa</th>
        </thead>

        <tbody>
            <?php
            if (!empty($listUsers)) :
                foreach ($listUsers as $item) :
            ?>
                    <tr>
                        <td><?php echo $item['matour'] ?></td>
                        <td><?php echo $item['tentour'] ?></td>
                        <td><?php echo number_format($item['gia'], 0, ',', '.') ?> đ</td>
                        <td><?php echo $item['mota'] ?></td>
                        <td><?php echo $item['ngaybatdau'] ?></td>
                        <td><?php echo $item['ngayketthuc'] ?></td>
                        <td><a href="<?php echo _WEB_HOST ?>?modules=tourdulich&action=edit&matour=<?php echo $item['matour'] ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><a href="<?php echo _WEB_HOST ?>?modules=tourdulich&action=delete&matour=<?php echo $item['matour'] ?>" onclick=" return confirm('Bạn có chắc muốn xóa?')" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
        </tbody>

<?php
                endforeach;
            endif;
?>
    </table>
</div>
<?php
layouts('footer');
?>