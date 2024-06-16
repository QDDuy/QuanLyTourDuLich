<?php
if (!defined('_CODE')) {
    die("Access denied....");
}

$data = [
    'pageTitle' => 'Tour'
];
layouts('headersp', $data);

$filterAll = filter();
$selectedPriceRange = '';

if (isPost()) {
    $selectedPriceRange = $filterAll['price-range'];
    $priceRanges = explode('-', $selectedPriceRange);
    // Chuyển đổi giá tiền thành số nguyên để sử dụng trong truy vấn SQL
    $minPrice = intval($priceRanges[0]);
    $maxPrice = intval($priceRanges[1]);

    // Thực hiện truy vấn SQL với điều kiện lọc theo giá tiền
    // Thực hiện truy vấn SQL với điều kiện lọc theo giá tiền
    if ($selectedPriceRange == "> 10000000") {
        // Xử lý mức giá lớn hơn 10,000,000đ
        $list_tour_product = getRaw("SELECT tbtourdulich.matour, tbtourdulich.tentour, tbtourdulich.gia, tbtourdulich.ngaybatdau, MAX(tbdiadiem.hinhanh) AS hinhanh, MAX(tbdiadiem.tendiadiem) AS tendiadiem
    FROM tbtourdulich
    LEFT JOIN tbhanhtrinhtour ON tbtourdulich.matour = tbhanhtrinhtour.matour
    LEFT JOIN tbdiadiem ON tbhanhtrinhtour.madiadiem = tbdiadiem.madiadiem
    WHERE tbtourdulich.gia > 10000000
    GROUP BY tbtourdulich.tentour, tbtourdulich.gia, tbtourdulich.ngaybatdau;");
    } else {
        $list_tour_product = getRaw("SELECT tbtourdulich.matour, tbtourdulich.tentour, tbtourdulich.gia, tbtourdulich.ngaybatdau, MAX(tbdiadiem.hinhanh) AS hinhanh, MAX(tbdiadiem.tendiadiem) AS tendiadiem
    FROM tbtourdulich
    LEFT JOIN tbhanhtrinhtour ON tbtourdulich.matour = tbhanhtrinhtour.matour
    LEFT JOIN tbdiadiem ON tbhanhtrinhtour.madiadiem = tbdiadiem.madiadiem
    WHERE tbtourdulich.gia BETWEEN $minPrice AND $maxPrice
    GROUP BY tbtourdulich.tentour, tbtourdulich.gia, tbtourdulich.ngaybatdau;");
    }
} else {
    $list_tour_product = getRaw("SELECT tbtourdulich.matour ,tbtourdulich.tentour, tbtourdulich.gia, tbtourdulich.ngaybatdau, MAX(tbdiadiem.hinhanh) AS hinhanh, MAX(tbdiadiem.tendiadiem) AS tendiadiem
    FROM tbtourdulich
    LEFT JOIN tbhanhtrinhtour ON tbtourdulich.matour = tbhanhtrinhtour.matour
    LEFT JOIN tbdiadiem ON tbhanhtrinhtour.madiadiem = tbdiadiem.madiadiem
    GROUP BY tbtourdulich.tentour, tbtourdulich.gia, tbtourdulich.ngaybatdau;");
}
?>

<div class="title-full">
    <div class="container-fluid">
        <h1 class="title-page">
            <a href="?modules=web&action=danhsachtour">Tour</a>
        </h1>
    </div>
    <form action="" method="post" class="wrap-full-screen" id="filter-form">
        <select name="price-range" id="price-range" onchange="submitForm()">
            <option value="mucgia">Mức giá</option>
            <option value="0 - 1000000đ">Dưới 1,000,000đ</option>
            <option value="1000000đ - 5000000đ">1,000,000đ - 5,000,000đ</option>
            <option value="5000000đ - 10000000đ">5,000,000đ - 10,000,000đ</option>
            <option value="- > 10000000">>10,000,000đ</option>
        </select>
        <?php
        // Kiểm tra xem đang có yêu cầu lọc không
        if (isPost()) :
        ?>
            <div class="filter-price"> <a href=" <?php echo _WEB_HOST; ?>?modules=web&action=danhsachtour">X
                    mức giá:<?php echo $filterAll['price-range']; ?></a></div>

        <?php endif; ?>
    </form>

</div>

<div class="container-fluid">
    <div class="list-product">
        <form action="" method="post" class="wrap-full-screen ">
            <?php
            if (!empty($list_tour_product)) :
                foreach ($list_tour_product as $item) :
            ?>
                    <div class="col-xl-3 col-lg-6 col-sm-6 col-xs-12 ">
                        <div class="product-main">
                            <div class="product-thumbnai">
                                <a href="<?php echo _WEB_HOST; ?>/?modules=web&action=chitiettour&matour=<?php echo $item['matour'] ?>"><img src="<?php echo _WEB_HOST_TEMPLATES; ?>/anh/<?php echo $item['hinhanh']; ?>"></a>
                            </div>
                            <div class="product-info">
                                <div class="product-name">
                                    <a href="<?php echo _WEB_HOST; ?>/?modules=web&action=chitiettour&matour=<?php echo $item['matour'] ?>">
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
                                <a href="<?php echo _WEB_HOST; ?>/?modules=web&action=chitiettour&matour=<?php echo $item['matour'] ?>">Xem
                                    chi tiết</a>
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