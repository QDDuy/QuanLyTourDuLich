<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

$data = [
    'pageTitle' => 'Tour'
];
layouts('headersp', $data);

$filterAll = filter();
$searchCount = 0;
// Lưu trữ số lượng tour tìm được
$totalSearchCount = 0;
// Process search
if (isPost()) {
    $keyword = $filterAll['search'];
    // Perform the search
    $listSearch = getRaw("SELECT tbtourdulich.matour, tbtourdulich.tentour, tbtourdulich.gia, tbtourdulich.ngaybatdau, MAX(tbdiadiem.hinhanh) AS hinhanh, MAX(tbdiadiem.tendiadiem) AS tendiadiem
    FROM tbtourdulich
    LEFT JOIN tbhanhtrinhtour ON tbtourdulich.matour = tbhanhtrinhtour.matour
    LEFT JOIN tbdiadiem ON tbhanhtrinhtour.madiadiem = tbdiadiem.madiadiem
    WHERE tbtourdulich.tentour LIKE '%$keyword%'
    GROUP BY tbtourdulich.matour, tbtourdulich.tentour, tbtourdulich.gia, tbtourdulich.ngaybatdau;
    ");
    // Đếm số lượng tour tìm được
    $totalSearchCount = count($listSearch);
}
if (isGet()) {
    $keyword = $filterAll["tendiadiem"];


    // Perform the search
    $listSearch = getRaw("SELECT tbtourdulich.matour, tbtourdulich.tentour, tbtourdulich.gia, tbtourdulich.ngaybatdau, MAX(tbdiadiem.hinhanh) AS hinhanh, MAX(tbdiadiem.tendiadiem) AS tendiadiem
    FROM tbtourdulich
    LEFT JOIN tbhanhtrinhtour ON tbtourdulich.matour = tbhanhtrinhtour.matour
    LEFT JOIN tbdiadiem ON tbhanhtrinhtour.madiadiem = tbdiadiem.madiadiem
    WHERE tbtourdulich.tentour LIKE '%$keyword%'
    GROUP BY tbtourdulich.tentour, tbtourdulich.gia, tbtourdulich.ngaybatdau;");
    $totalSearchCount = count($listSearch);
}

?>

<div class="title-full">
    <div class="container-fluid">
        <h1 class="title-page">
            <a href="?modules=web&action=danhsachtour">Tour</a>
        </h1>
        <p style="color: #99c53c; text-align:center;">Có <?php echo $totalSearchCount; ?> kết quả phù hợp </p>
    </div>

</div>

<div class="container-fluid">
    <div class="list-product">
        <form action="" method="post" class="wrap-full-screen ">
            <?php
            if (!empty($listSearch)) :
                foreach ($listSearch as $item) :
                    $searchCount++;
            ?>
            <div class="col-xl-3 col-lg-6 col-sm-6 col-xs-12 ">
                <div class="product-main">
                    <div class="product-thumbnai">
                        <a
                            href="<?php echo _WEB_HOST; ?>/?modules=web&action=chitiettour&matour=<?php echo $item['matour'] ?>"><img
                                src="<?php echo _WEB_HOST_TEMPLATES; ?>/anh/<?php echo $item['hinhanh']; ?>"></a>

                    </div>
                    <div class="product-info">
                        <div class="product-name">
                            <a
                                href="<?php echo _WEB_HOST; ?>/?modules=web&action=chitiettour&matour=<?php echo $item['matour'] ?>">
                                <?php echo $item['tentour'] ?>
                            </a>

                        </div>
                        <div class="product-startdate">
                            <i class="fa-regular fa-clock"></i>
                            <p>
                                <?php echo $item['ngaybatdau'] ?>
                                <i class="fa-solid fa-car "></i>
                                <i class="fa-solid fa-plane"></i>
                            </p>
                        </div>
                        <div class="product-pice">
                            <p><?php echo number_format($item['gia'], 0, ',', '.') ?>đ</p>

                        </div>
                    </div>
                    <div class="btn-chitiet">
                        <a
                            href="<?php echo _WEB_HOST; ?>/?modules=web&action=chitiettour&matour=<?php echo $item['matour'] ?>">Xem
                            chi
                            tiết</a>

                    </div>

                </div>

            </div>

            <?php
                endforeach;
            else :
                echo "Không có kết quả.";
            endif;
            ?>
        </form>

    </div>

</div>


<script>
function submitForm() {
    document.getElementById("filter-form").submit();
}
</script>
<?php
// Include footer file
layouts('footersp', $data);
?>