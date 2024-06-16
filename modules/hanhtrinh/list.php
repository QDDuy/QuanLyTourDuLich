<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

$data = [
    'pageTitle' => 'Quản lý hành trình'
];
layouts('header', $data);



$listHanhTrinhTour = getRaw("SELECT * FROM tbhanhtrinhtour
ORDER BY matour ASC;
");

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
?>
<div class="container">
    <h2>Quản lý hành trình</h2>
    <a href="?modules=hanhtrinh&action=add" class="btn btn-success btn-sm"><i class="fa-solid fa-plus"></i> Thêm hành
        trình</a>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <form class="d-flex" role="search" action="?modules=hanhtrinh&action=search" method="post">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <?php
    if (!empty($smg)) {
        getSmg($smg, $smg_type);
    }
    ?>
    <table class="table table-bordered table-hover mt-3">
        <thead class="table-info">
            <th>Mã tour</th>
            <th>Mã địa điểm</th>
            <th>Tên địa điểm</th>
            <th>Thứ tự</th>
            <th with=5%>Sửa</th>
            <th with=5%>Xóa</th>
        </thead>

        <tbody>
            <?php
            if (!empty($listHanhTrinhTour)) :
                foreach ($listHanhTrinhTour as $item) :
            ?>
                    <tr>
                        <td><?php echo $item['matour'] ?></td>
                        <td><?php echo $item['madiadiem'] ?></td>
                        <td><?php echo $item['tendiadiem'] ?></td>
                        <td><?php echo $item['thutu'] ?></td>
                        <td><a href="<?php echo _WEB_HOST ?>?modules=hanhtrinh&action=edit&mahanhtrinh=<?php echo $item['mahanhtrinh'] ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><a href="<?php echo _WEB_HOST ?>?modules=hanhtrinh&action=delete&mahanhtrinh=<?php echo $item['mahanhtrinh'] ?>" onclick=" return confirm('Bạn có chắc muốn xóa?')" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
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