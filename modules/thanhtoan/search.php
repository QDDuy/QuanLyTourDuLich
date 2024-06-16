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

    $listSearch = getRaw("SELECT * FROM tbthanhtoan WHERE(tenkhachhang LIKE'%$keyword%' OR madattour LIKE '%$keyword%')");
}

// Display search results
?>
<div class="container">
    <h2>Kết quả tìm kiếm</h2>
    <a href="?modules=thanhtoan&action=add" class="btn btn-success btn-sm"><i class="fa-solid fa-plus"></i> Thêm thông
        tin</a>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <form class="d-flex" role="search" action="?modules=thanhtoan&action=search" method="post">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>


        </div>
    </nav>
    <table class="table table-bordered table-hover">
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
            if (!empty($listSearch)) :
                foreach ($listSearch as $item) :
            ?>
            <tr>
                <td><?php echo $item['mathanhtoan'] ?></td>
                <td><?php echo $item['madattour'] ?></td>
                <td><?php echo $item['tenkhachhang'] ?></td>
                <td><?php echo $item['ngaythanhtoan'] ?></td>
                <td><?php echo $item['sotien'] ?></td>
                <td><?php echo $item['phuongthucthanhtoan'] ?></td>
                <td><a href="<?php echo _WEB_HOST ?>?modules=thanhtoan&action=edit&mathanhtoan=<?php echo $item['mathanhtoan'] ?>"
                        class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                <td><a href="<?php echo _WEB_HOST ?>?modules=thanhtoan&action=delete&mathanhtoan=<?php echo $item['mathanhtoan'] ?>"
                        onclick=" return confirm('Bạn có chắc muốn xóa?')" class="btn btn-danger btn-sm"><i
                            class="fa-solid fa-trash"></i></a>
                </td>
            </tr>

            <?php
                endforeach;
            else :
                ?>
            <tr>
                <td colspan="8">
                    <div class="alert alert-danger text-center">Không tìm thấy thanh toán nào</div>
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