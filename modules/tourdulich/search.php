<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}


// Bao gồm file header và footer
layouts('header');

// Xử lý tìm kiếm
$searchTerm = '';
if (isPost()) {
    $filterAll = filter();
    $keyword = $filterAll['search'];
    $listSearch = getRaw("SELECT * FROM tbtourdulich WHERE(matour LIKE '%$keyword%' OR tentour LIKE '%$keyword%')");
}
// Hiển thị kết quả tìm kiếm
?>
<div class="container">
    <h2>Kết quả tìm kiếm</h2>
    <table class="table table-bordered table-hover">
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
            <?php if (!empty($listSearch)) : ?>
                <?php foreach ($listSearch as $item) : ?>
                    <tr>
                        <td><?php echo $item['matour'] ?></td>
                        <td><?php echo $item['tentour'] ?></td>
                        <td><?php echo $item['gia'] ?></td>
                        <td><?php echo $item['mota'] ?></td>
                        <td><?php echo $item['ngaybatdau'] ?></td>
                        <td><?php echo $item['ngayketthuc'] ?></td>
                        <td><a href="<?php echo _WEB_HOST ?>?modules=tourdulich&action=edit&matour=<?php echo $item['matour'] ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><a href="<?php echo _WEB_HOST ?>?modules=tourdulich&action=delete&matour=<?php echo $item['matour'] ?>" onclick=" return confirm('Bạn có chắc muốn xóa?')" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                    </tr>
                <?php endforeach;
            else :
                ?>
                <tr>
                    <td colspan="8">
                        <div class="alert alert-danger text-center">Không tìm thấy tour du lịch nào</div>
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