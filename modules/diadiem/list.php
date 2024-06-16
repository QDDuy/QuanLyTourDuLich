<!-- Quản lý tour du lịch -->
<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}
$data = [
    'pageTitle' => 'Danh sách người dùng'
];
layouts('header', $data);
$listUsers = getRaw("SELECT * FROM tbdiadiem ");

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');


?>
<div class="container">

    <h2>Quản lý địa điểm</h2>
    <a href="?modules=diadiem&action=add" class="btn btn-success btn-sm"><i class="fa-solid fa-plus"></i> Thêm địa
        điểm</a>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <form class="d-flex" role="search" action="?modules=diadiem&action=search" method="post">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>


        </div>
    </nav>
    <?php
    if (!empty($smg)) {
        getSmg($smg, $smg_type);
    }
    $kq = getRows("SELECT * FROM tbdiadiem");
    echo "Đang có $kq địa điểm du lịch:";
    ?>
    <table class="table table-bordered table-hover mt-3">
        <thead class="table-info">
            <th>ID</th>
            <th>Tên địa điểm</th>
            <th>Mô tả</th>
            <th>Hình ảnh</th>
            <th with=5%>Sửa</th>
            <th with=5%>Xóa</th>
        </thead>
        <tbody>
            <?php if (!empty($listUsers)) : ?>
            <?php foreach ($listUsers as $item) : ?>
            <tr>
                <td><?php echo $item['madiadiem'] ?></td>
                <td><?php echo $item['tendiadiem'] ?></td>
                <td><?php echo $item['mota'] ?></td>
                <td>
                    <img style="border-radius: 10px;box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" height="200"
                        width="250" src="<?php echo _WEB_HOST_TEMPLATES; ?>/anh/<?php echo $item['hinhanh']; ?>">
                </td>
                <td><a href="<?php echo _WEB_HOST ?>?modules=diadiem&action=edit&madiadiem=<?php echo $item['madiadiem'] ?>"
                        class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                <td><a href="<?php echo _WEB_HOST ?>?modules=diadiem&action=delete&madiadiem=<?php echo $item['madiadiem'] ?>"
                        onclick=" return confirm('Bạn có chắc muốn xóa?')" class="btn btn-danger btn-sm"><i
                            class="fa-solid fa-trash"></i></a>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php
layouts('footer');
?>