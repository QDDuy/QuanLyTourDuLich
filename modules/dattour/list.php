<!-- Danh sách người dùng -->
<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}
$data = [
    'pageTitle' => 'Danh sách đặt tour'
];
layouts('header', $data);

$listDatTour = getRaw("SELECT * FROM tbdattour ");

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');


?>
<div class="container">

    <h2>Quản lý đặt tour</h2>
    <a href="?modules=dattour&action=add" class="btn btn-success btn-sm"><i class="fa-solid fa-plus"></i> Thêm đặt
        tour</a>

    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <form class="d-flex" role="search" action="?modules=dattour&action=search" method="post">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <?php
    if (!empty($smg)) {
        getSmg($smg, $smg_type);
    }
    $kq = getRows("SELECT * FROM tbdattour");
    echo "Đang có $kq đơn đặt tour:";
    ?>
    <table class="table table-bordered table-hover mt-3">
        <thead class="table-info">
            <th>ID</th>
            <th>Mã tour</th>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Ngày Đặt</th>
            <th>Số Lượng Người</th>
            <th>Thông tin phòng</th>
            <th>Xác Nhận đặt tuor</th>
            <th>Xác nhận thanh toán</th>
            <th>Xác nhận đi tour</th>
            <th>Ngày đi tour</th>
            <th>Ngày về tour</th>
            <th>Phản hồi của khách</th>
            <th>Cọc</th>
            <th with=5%>Sửa</th>
            <th with=5%>Xóa</th>
        </thead>

        <tbody>
            <?php
            if (!empty($listDatTour)) :
                foreach ($listDatTour as $item) :
            ?>
                    <tr>
                        <td><?php echo $item['madattour'] ?></td>
                        <td><?php echo $item['matour'] ?></td>
                        <td><?php echo $item['tenkhachhang'] ?></td>
                        <td><?php echo $item['sodienthoai'] ?></td>
                        <td><?php echo $item['ngaydat'] ?></td>
                        <td><?php echo $item['soluongnguoi'] ?></td>
                        <td><?php echo $item['thongtinphong'] ?></td>
                        <td><?php echo $item['xacnhandattour'] ?></td>
                        <td><?php echo $item['xacnhanthanhtoan'] ?></td>
                        <td><?php echo $item['xacnhanditour'] ?></td>
                        <td><?php echo $item['ngayditour'] ?></td>
                        <td><?php echo $item['ngayvetour'] ?></td>
                        <td><?php echo $item['phanhoicuakhach'] ?></td>
                        <td><?php echo number_format($item['coc'], 0, ',', '.') ?> đ</td>
                        <td><a href="<?php echo _WEB_HOST ?>?modules=dattour&action=edit&madattour=<?php echo $item['madattour'] ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><a href="<?php echo _WEB_HOST ?>?modules=dattour&action=delete&madattour=<?php echo $item['madattour'] ?>" onclick=" return confirm('Bạn có chắc muốn xóa?')" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
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