<?php
if (!defined('_CODE')) {
    die("Access denied....");
}

// Check if the user is not logged in
if (!getSession('logged_in')) {
    // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
    redirect('?modules=auth&action=login');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !empty($data['pageTitle']) ? $data['pageTitle'] : 'Quản lý người dùng'; ?></title>
    <link rel="shortcut icon" href="<?php echo _WEB_HOST_TEMPLATES; ?>/image/logo2.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES; ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES; ?>/css/style.css?ver=<?php echo rand() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="?modules=home&action=dashboard"
                    class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <img class="img-fluid" src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/logo2.png" alt="">
                        </use>
                    </svg>
                </a>

                <ul class="offset-1 nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="?modules=home&action=dashboard" class="nav-link px-2 link-body-emphasis">Trang chủ</a>
                    </li>
                    <?php
                    // Check if the user has the role 'Quản Lý'
                    if (getSession('quyentruycap') && getSession('quyentruycap') === 'Quản Lý') :
                    ?>
                    <li><a href="?modules=users&action=list" class="nav-link px-2 link-body-emphasis">Người dùng</a>
                    </li>
                    <?php endif; ?>

                    <li><a href="?modules=dattour&action=list" class="nav-link px-2 link-body-emphasis">Đặt Tour</a>
                    </li>
                    <li><a href="?modules=tourdulich&action=list" class="nav-link px-2 link-body-emphasis">Tour Du
                            Lịch</a></li>
                    <li><a href="?modules=diadiem&action=list" class="nav-link px-2 link-body-emphasis">Địa điểm</a>
                    </li>
                    <li><a href="?modules=hanhtrinh&action=list" class="nav-link px-2 link-body-emphasis">Hành Trình</a>
                    </li>
                    <li><a href="?modules=thanhtoan&action=list" class="nav-link px-2 link-body-emphasis">Thanh Toán</a>
                    </li>
                </ul>

                <div class="dropdown text-end">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small">
                        <li><a class="dropdown-item">
                                <?php
                                // Check user's role and display appropriate message
                                if (empty(getSession('quyentruycap'))) {
                                    redirect('?modules=auth&action=login');
                                    exit();
                                } else {
                                    $quyentruycap = getSession('quyentruycap');

                                    if ($quyentruycap === 'Quản Lý') {
                                        echo 'Quyền Quản Lý';
                                    } else if ($quyentruycap === 'Nhân Viên') {
                                        echo 'Quyền Nhân Viên';
                                    }
                                }
                                ?></a></li>
                        <li><a class="dropdown-item" href="?modules=web&action=main">Visit site</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="?modules=auth&action=login">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Rest of the HTML content -->

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chờ DOM được load hoàn toàn
        setTimeout(function() {
            // Ẩn đi thông báo
            var welcomeMessage = document.getElementById('welcomeMessage');
            if (welcomeMessage) {
                welcomeMessage.style.display = 'none';
            }
        }, 2000); // 2 giây
    });
    </script>
</body>

</html>