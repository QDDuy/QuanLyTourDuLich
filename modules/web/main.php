<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

$data = [
    'pageTitle' => 'VIETNAM-NATURE'
];
layouts('header-site', $data);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <section>
        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/hinhnen.jpg" alt="">
    </section>

    <?php $list_tour = getRaw("SELECT  tendiadiem FROM tbdiadiem ") ?>
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <div class="col-md-3 mb-2 mb-md-0">
            <a href="<?php echo _WEB_HOST ?>?modules=web&action=main" class="d-inline-flex link-body-emphasis text-decoration-none">
                <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap">
                    <img class="img-fluid" src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/logo2.png" alt="">
                </svg>
            </a>
        </div>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="<?php echo _WEB_HOST; ?>?modules=web&action=gioithieu" class="nav-link px-4 text-warning fs-5 ">Về chúng tôi</a></li>
            <li><a href="<?php echo _WEB_HOST; ?>?modules=web&action=danhsachtour" class="nav-link px-4 text-warning fs-5  dropdown-toggle " role="button" data-bs-toggle="dropdown" aria-expanded="false">Tour</a>
                <ul class="dropdown-menu">
                    <?php if (!empty($list_tour)) :
                        foreach ($list_tour as $item) : ?>
                            <li><a style="text-transform: uppercase;" class="dropdown-item" href="?modules=web&action=search&tendiadiem=<?php echo $item['tendiadiem'] ?>">du
                                    lịch <?php echo $item['tendiadiem'] ?></a>
                            </li>


                    <?php
                        endforeach;
                    endif;
                    ?>
                </ul>
            </li>
            <li><a href="<?php echo _WEB_HOST; ?>?modules=web&action=lienhe" class="nav-link px-4 text-warning fs-5  ">Liên hệ</a></li>
        </ul>
        <div class="col-md-3 text-end">
            <form method="post" action="?modules=web&action=search" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                <input name="search" style="  background: rgba(255, 255, 255, 0.3);" type="search" class="custom-placeholder text-warning  form-control  border-0 outline-0" placeholder="Tìm kiếm tour....">
            </form>
        </div>
    </header>


    <!-- <div class="select-tour ">
        <div class="container">
            <div class="row">
                <form action="" class=" d-flex  ">
                    <div class="col ">
                        <select class="form-select-lg mx-2   form-control">
                            <option selected>Tour</option>

                        </select>
                    </div>
                    <div class="col">
                        <select class=" form-select-lg mx-2 form-control" aria-label="Small select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-1">
                        <div class="btn-search-tour ">
                            <button type="submit" class="btn btn-success form-control btn-lg ml-2">Success</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div> -->

    <section class="service ">
        <div class="container ">
            <div class="row ">
                <div class="col d-flex ml-5 ">
                    <div class="number">
                        <h1>01</h1>
                    </div>
                    <div class="content-service ml-3">
                        <p>Bán tour số 1 Việt Nam</p>
                        <span>Ứng dụng công nghệ mới nhất</span>
                    </div>
                    <div class="icon-service">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                </div>
                <div class=" col d-flex">
                    <div class="number">
                        <h1>02</h1>
                        <span></span>
                    </div>
                    <div class="content-service  ">
                        <p>Thanh toán linh hoạt</p>
                        <span>Liên kết với các tỏ chức tài chính</span>
                    </div>
                    <div class="icon-service">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                </div>
                <div class=" col d-flex">
                    <div class="number">
                        <h1>03</h1>
                        <span></span>
                    </div>
                    <div class="content-service ">
                        <p>Giá tour luôn tốt nhất</p>
                        <span>Chúng tôi luôn có giá tốt nhất cho bạn</span>
                    </div>

                </div>
            </div>

        </div>
        <hr>
    </section>

    <section class="section-about">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-7 col-lg-6 col-12">
                    <div class="about-contents">
                        <div class="title-main">
                            <h2>HÃY CHỌN VIETNAM-NATURE</h2>
                        </div>
                        <p class="min">1.000 lý do tại sao bạn nên chọn đến với chúng tôi TravelGo, có 1 thế giới tuyệt
                            đẹp
                            quanh ta hãy
                            đến với chúng tôi</p>
                        <p class="lage">Với hơn 16 năm kinh nghiệm tổ chức và triển khai các tour du lịch trong và ngoài
                            nước, chúng tôi
                            cam kết đem lại cho khách hàng những hành trình tuyệt vời và ấn tượng nhất thông qua những
                            dịch
                            vụ chuyên nghiệp mà chúng tôi thực hiện như :</p>
                    </div>
                    <div class="wrap-about form-control">
                        <div class="row">
                            <div class="col-xl-4 col-lg-6 col-sm-4  ">
                                <div class="item d-flex">
                                    <div class="icon">
                                        <i class="fa-solid fa-plane"></i>
                                    </div>
                                    <div class="title-about">
                                        <p>Chuyến bay đẳng cấp</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-sm-4  ">
                                <div class="item d-flex">
                                    <div class="icon">
                                        <i class="fa-solid fa-ship"></i>
                                    </div>
                                    <div class="title-about">
                                        <p>Hành trình hấp dẫn</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-sm-4  ">
                                <div class="item d-flex">
                                    <div class="icon">
                                        <i class="fa-solid fa-clock-rotate-left"></i>
                                    </div>
                                    <div class="title-about">
                                        <p>Quản lý chặt chẽ</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-sm-4  ">
                                <div class="item d-flex">
                                    <div class="icon">
                                        <i class="fa-solid fa-hotel "></i>
                                    </div>
                                    <div class="title-about">
                                        <p>Khách sạn tiện nghi</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-sm-4  ">
                                <div class="item d-flex">
                                    <div class="icon">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                    <div class="title-about">
                                        <p>Chất lượng đỉnh cao</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-sm-4  ">
                                <div class="item d-flex">
                                    <div class="icon">
                                        <i class="fa-solid fa-route"></i>
                                    </div>
                                    <div class="title-about">
                                        <p>Nhiều tour hấp dẫn</p>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 col-12">
                    <div class="img-item">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/hinh1.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    $list_location_product = getRaw("SELECT hinhanh, tendiadiem
FROM tbdiadiem

LIMIT 6;  -- Chỉ lấy 6 bản ghi
");
    $list_tour_product = getRaw("SELECT tbtourdulich.matour , tbtourdulich.tentour, tbtourdulich.gia, tbtourdulich.ngaybatdau, MAX(tbdiadiem.hinhanh) AS hinhanh, MAX(tbdiadiem.tendiadiem) AS tendiadiem
    FROM tbtourdulich
    LEFT JOIN tbhanhtrinhtour ON tbtourdulich.matour = tbhanhtrinhtour.matour
    LEFT JOIN tbdiadiem ON tbhanhtrinhtour.madiadiem = tbdiadiem.madiadiem
    GROUP BY tbtourdulich.tentour, tbtourdulich.gia, tbtourdulich.ngaybatdau
LIMIT 4;
");
    ?>
    <div class="destination">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="title-module-main">
                        <h2>
                            <a href=""> Các địa điểm nổi bật</a>
                        </h2>
                        <p class="des">Với hơn nhiều năm kinh nghiệm tổ chức và triển khai các tour trong và ngoài nước,
                            chúng tôi cam kết đem lại cho khách hàng những hành trình tuyệt vời và ấn tượng nhất thông
                            qua
                            những dịch vụ chuyên nghiệp mà chúng tôi thực hiện như:
                        </p>
                    </div>
                </div>

            </div>
        </div>



        <div class="wrap-full-screen ">
            <?php
            if (!empty($list_location_product)) :
                foreach ($list_location_product as $item) :
            ?>
                    <div class="col-xl-4 col-lg-6 col-sm-6 col-xs-12">
                        <div class="product-thumbnail">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/anh/<?php echo $item['hinhanh']; ?>">

                        </div>
                        <div class="product-location">
                            <p><i class="fa-solid fa-location-dot"> </i> <?php echo $item['tendiadiem'] ?></p>
                        </div>
                    </div>
            <?php
                endforeach;
            else :
                echo "Không có kết quả.";
            endif;
            ?>
        </div>

    </div>


    <div class="tour-products">
        <div class="title-header">
            <ul>
                <li class="title"><a href="">Tour du lịch</a></li>
                <li class="see-more"><a href="<?php echo _WEB_HOST; ?>?modules=web&action=danhsachtour">Xem thêm
                        tour</a></li>
            </ul>
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
                                        <a href="<?php echo _WEB_HOST; ?>/?modules=web&action=chitiettour&matour=<?php echo $item['matour'] ?>"><img class="imge" src="<?php echo _WEB_HOST_TEMPLATES; ?>/anh/<?php echo $item['hinhanh']; ?>"></a>

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

    </div>
    <?php
    $list_reviews = getRaw("SELECT tenkhachhang, phanhoicuakhach
    FROM tbdattour;");
    ?>
    <div class="reviews">
        <div class="container ">
            <div class="title-main">
                <h2>
                    Khách Hàng Đánh giá
                </h2>
                <p class="des">Mục tiêu hàng đầu của chúng tôi là sự hài lòng của khách hàng</p>
            </div>
            <div class="row list-reviews">
                <?php if (!empty($list_reviews)) :
                    foreach ($list_reviews as $item) : ?>
                        <div class="offset-lg-2 col-lg-8 col-12">
                            <div class="summary-reviews form-control">
                                <p class="review-customer"><?php echo $item['phanhoicuakhach']; ?></p>
                                <h3 class="name-customer"><?php echo $item['tenkhachhang']; ?></h3>
                            </div>

                        </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </div>



</body>

</html>


<?php
// Include footer file
layouts('footersp');
?>