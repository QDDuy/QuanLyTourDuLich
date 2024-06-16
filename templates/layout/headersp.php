<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !empty($data['pageTitle']) ? $data['pageTitle'] : 'Quản lý người dùng'; ?></title>
    <link rel="shortcut icon" href="<?php echo _WEB_HOST_TEMPLATES; ?>/image/logo2.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES; ?>/css/web-site.css">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES; ?>/css/dstour.css">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES; ?>/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES; ?>/css/chitiettour.css">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES; ?>/css/lienhe.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>
    <?php $list_tour = getRaw("SELECT  tendiadiem
FROM tbdiadiem ") ?>
    <header style="background-color: #fff;" class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <div class="col-md-3 mb-2 mb-md-0">
            <a href="<?php echo _WEB_HOST ?>?modules=web&action=main" class="d-inline-flex link-body-emphasis text-decoration-none">
                <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap">
                    <img class="img-fluid" src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/logo2.png" alt="">
                </svg>
            </a>
        </div>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="<?php echo _WEB_HOST; ?>?modules=web&action=gioithieu" class="nav-link px-4 text-warning fs-5 ">Về chúng tôi</a></li>
            <li><a href="#" class="nav-link px-4 text-warning fs-5  dropdown-toggle " role="button" data-bs-toggle="dropdown" aria-expanded="false">Tour</a>
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

                <input name="search" style="background: rgba(255, 255, 255, 0.3); color: #333;" type="search" class="custom-placeholder text-warning form-control  border-0 outline-0" placeholder="Tìm kiếm tour...">
            </form>
        </div>
    </header>

</body>

</html>