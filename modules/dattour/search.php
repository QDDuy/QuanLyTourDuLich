<?php
if (!defined('_CODE')) {
    die("Access denied...");
}

// Include header and footer files
layouts('header');

$filterAll = filter();

// Process search
if (isPost()) {
    $keyword = $filterAll['search'];
    // Perform the search
    $listSearch = getRaw("SELECT * FROM tbdattour WHERE(tenkhachhang LIKE'%$keyword%' OR sodienthoai LIKE '%$keyword%')");
}

// Display search results
?>
<div class="container">
    <h2>Kết quả tìm kiếm</h2>
    <a href="?modules=dattour&action=add" class="btn btn-success btn-sm"><i class="fa-solid fa-plus"></i> Thêm người
        dùng</a>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <form class="d-flex" role="search" action="?modules=dattour&action=search" method="post">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>


        </div>
    </nav>
    <table class="table table-bordered table-hover">
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
            <th>Phản hồi của khách</th>
            <th>Cọc</th>
            <th with=5%>Sửa</th>
            <th with=5%>Xóa</th>
        </thead>

        <tbody>
            <?php
            if (!empty($listSearch)) :
                foreach ($listSearch as $item) :
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
                <td><?php echo $item['phanhoicuakhach'] ?></td>
                <td><?php echo $item['coc'] ?></td>
                <td><a href="<?php echo _WEB_HOST ?>?modules=dattour&action=edit&madattour=<?php echo $item['madattour'] ?>"
                        class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                <td><a href="<?php echo _WEB_HOST ?>?modules=dattour&action=delete&madattour=<?php echo $item['madattour'] ?>"
                        onclick=" return confirm('Bạn có chắc muốn xóa?')" class="btn btn-danger btn-sm"><i
                            class="fa-solid fa-trash"></i></a>
                </td>
            </tr>

            <?php
                endforeach;
            else :
                ?>
            <tr>
                <td colspan="15">
                    <div class="alert alert-danger text-center">Không tìm thấy thông tin đặt tour nào</div>
                </td>
            </tr>
            <?php
            endif;
            ?>
        </tbody>
    </table>
</div>

<?php
// Include footer file
layouts('footer');
?>