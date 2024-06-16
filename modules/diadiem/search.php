<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}


// Bao gồm file header và footer
layouts('header');

// Xử lý tìm kiếm
if (isPost()) {
    $filterAll = filter();
    $keyword = $filterAll['search'];
    $listSearch = getRaw("SELECT * FROM tbdiadiem WHERE tendiadiem LIKE '%$keyword%'");
}


// Hiển thị kết quả tìm kiếm
?>
<div class="container">
    <h2>Kết quả tìm kiếm</h2>
    <table class="table table-bordered table-hover">
        <thead class="table-info">
            <th>ID</th>
            <th>Tên địa điểm</th>
            <th>Mô tả</th>
            <th>Hình ảnh</th>
            <th width=5%>Sửa</th>
            <th with=5%>Xóa</th>
        </thead>
        <tbody>
            <?php if (!empty($listSearch)) : ?>
                <?php foreach ($listSearch as $item) : ?>
                    <tr>
                        <td><?php echo $item['madiadiem'] ?></td>
                        <td><?php echo $item['tendiadiem'] ?></td>
                        <td><?php echo $item['mota'] ?></td>
                        <td>
                            <img height=" 200" width="auto" src="<?php echo _WEB_HOST_TEMPLATES; ?>/anh/<?php echo $item['hinhanh']; ?>">
                        </td>
                        <td><a href="<?php echo _WEB_HOST ?>?modules=diadiem&action=edit&madiadiem=<?php echo $item['madiadiem'] ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><a href="<?php echo _WEB_HOST ?>?modules=diadiem&action=delete&madiadiem=<?php echo $item['madiadiem'] ?>" onclick=" return confirm('Bạn có chắc muốn xóa?')" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                    </tr>
                <?php endforeach;
            else :
                ?>
                <tr>
                    <td colspan="7">
                        <div class="alert alert-danger text-center">Không tìm thấy địa điểm nào</div>
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
<a href="?modules=diadiem&action=list"><button type="button" class="btn btn-secondary">Quay lại</button></a>