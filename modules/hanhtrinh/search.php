<?php
if (!defined('_CODE')) {
    die("Access denied...");
}

// Include header and footer files
layouts('header');

$filterAll = filter();
if (isPost()) {
    $keyword = $filterAll['search'];
    $listSearch = getRaw("SELECT * FROM tbhanhtrinhtour WHERE matour LIKE '%$keyword%'");
}

// Display search results
?>
<div class="container">
    <h2>Kết quả tìm kiếm</h2>
    <a href="?modules=hanhtrinh&action=add" class="btn btn-success btn-sm"><i class="fa-solid fa-plus"></i> Thêm hành
        trình</a>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <form class="d-flex" role="search" action="?modules=hanhtrinh&action=search" method="post">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>


        </div>
    </nav>
    <table class="table table-bordered table-hover">
        <thead class="table-info">
            <th>Mã tour</th>
            <th>Mã địa điểm</th>
            <th>Thứ tự</th>
            <th with=5%>Sửa</th>
            <th with=5%>Xóa</th>
        </thead>

        <tbody>
            <?php
            if (!empty($listSearch)) :
                foreach ($listSearch as $item) :
            ?>
                    <tr>
                        <td><?php echo $item['matour'] ?></td>
                        <td><?php echo $item['madiadiem'] ?></td>
                        <td><?php echo $item['thutu'] ?></td>
                        <td><a href="<?php echo _WEB_HOST ?>?modules=hanhtrinh&action=edit&matour=<?php echo $item['matour'] ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><a href="<?php echo _WEB_HOST ?>?modules=hanhtrinh&action=delete&matour=<?php echo $item['matour'] ?>" onclick=" return confirm('Bạn có chắc muốn xóa?')" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>

                <?php
                endforeach;
            else :
                ?>
                <tr>
                    <td colspan="7">
                        <div class="alert alert-danger text-center">Không tìm thấy hành trình nào</div>
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