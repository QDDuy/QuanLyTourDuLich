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
    $listSearch = getRaw("SELECT * FROM tbnguoidung WHERE (hoten LIKE '%$keyword%' OR email LIKE '%$keyword%')");
}

// Display search results
?>
<div class="container">
    <h2>Kết quả tìm kiếm</h2>
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
    <table class="table table-bordered table-hover">
        <!-- Table headers -->
        <thead class="table-info">
            <th>ID</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Mật khẩu</th>
            <th>Quyền</th>
            <th>Ngày đăng ký</th>
            <th width="5%">Sửa</th>
            <th width="5%">Xóa</th>
        </thead>

        <tbody>
            <?php if (!empty($listSearch)) : ?>
                <?php foreach ($listSearch as $item) : ?>
                    <!-- Display each row -->
                    <tr>
                        <td><?php echo htmlspecialchars($item['manguoidung']); ?></td>
                        <td><?php echo htmlspecialchars($item['hoten']); ?></td>
                        <td><?php echo htmlspecialchars($item['email']); ?></td>
                        <td><?php echo htmlspecialchars($item['matkhau']); ?></td>
                        <td><?php echo htmlspecialchars($item['quyentruycap']); ?></td>
                        <td><?php echo htmlspecialchars($item['ngaydangky']); ?></td>
                        <td>
                            <a href="<?php echo _WEB_HOST ?>?modules=users&action=edit&manguoidung=<?php echo htmlspecialchars($item['manguoidung']); ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                        <td>
                            <a href="<?php echo _WEB_HOST ?>?modules=users&action=delete&manguoidung=<?php echo htmlspecialchars($item['manguoidung']); ?>" onclick="return confirm('Bạn có chắc muốn xóa?')" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach;
            else :
                ?>
                <tr>
                    <td colspan="8">
                        <div class="alert alert-danger text-center">Không tìm thấy người dùng nào</div>
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