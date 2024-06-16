<!-- Danh sách người dùng -->
<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}
$data = [
    'pageTitle' => 'Danh sách thông tin thanh toán'
];
layouts('header', $data);

$listthanhToan = getRaw("SELECT * FROM tbthanhtoan ");

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');


?>
<div class="container">

    <h2>Quản lý thông tin thanh toán</h2>
    <a href="?modules=thanhtoan&action=add" class="btn btn-success btn-sm"><i class="fa-solid fa-plus"></i> Thêm thông
        tin </a>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <form class="d-flex" role="search" action="?modules=thanhtoan&action=search" method="post">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <?php
    if (!empty($smg)) {
        getSmg($smg, $smg_type);
    }
    $kq = getRows("SELECT * FROM tbthanhtoan");
    echo "Đang có $kq thanh toán:";
    ?>
    <table class="table table-bordered table-hover mt-3">
        <thead class="table-info">
            <th>Mã thanh toán</th>
            <th>Mã đặt tour</th>
            <th>Tên khách hàng</th>
            <th>Ngày thanh toán</th>
            <th>Số tiền</th>
            <th>Phương thức thanh toán</th>
            <th with=5%>Sửa</th>
            <th with=5%>Xóa</th>
        </thead>

        <tbody>
            <?php
            if (!empty($listthanhToan)) :
                foreach ($listthanhToan as $item) :
            ?>
            <tr>
                <td><?php echo $item['mathanhtoan'] ?></td>
                <td><?php echo $item['madattour'] ?></td>
                <td><?php echo $item['tenkhachhang'] ?></td>
                <td><?php echo $item['ngaythanhtoan'] ?></td>
                <td><?php echo number_format($item['sotien'], 0, ',', '.') ?> đ</td>
                <td><?php echo $item['phuongthucthanhtoan'] ?></td>
                <td><a href="<?php echo _WEB_HOST ?>?modules=thanhtoan&action=edit&mathanhtoan=<?php echo $item['mathanhtoan'] ?>"
                        class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                <td><a href="<?php echo _WEB_HOST ?>?modules=thanhtoan&action=delete&mathanhtoan=<?php echo $item['mathanhtoan'] ?>"
                        onclick=" return confirm('Bạn có chắc muốn xóa?')" class="btn btn-danger btn-sm"><i
                            class="fa-solid fa-trash"></i></a>
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