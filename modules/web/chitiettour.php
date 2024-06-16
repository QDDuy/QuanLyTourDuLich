<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

$data = [
    'pageTitle' => 'Tour'
];
layouts('headersp', $data);




$filterAll = filter();

if (isPost()) {

    $errors = [];


    if (empty($filterAll['tenkhachhang'])) {
        $errors['tenkhachhang']['require'] = "Tên khách bắt buộc phải nhập";
    } else {
        if (strlen($filterAll['tenkhachhang']) < 5) {
            $errors['tenkhachhang']['min'] = "Họ và tên khách ít nhất phải lớn hơn 5 ký tự";
        }
    }




    //password_confirm : password không được để trống, password_confirm phải giống password ;
    if (empty($filterAll['soluongnguoi'])) {
        $errors['soluongnguoi']['require'] = "Số lượng người bắt buộc phải nhập";
    }
    if (empty($filterAll['thongtinphong'])) {
        $errors['thongtinphong']['require'] = "Thông tin phòng bắt buộc phải nhập";
    }
    if (empty($errors)) {
        $datainsert = [
            'matour' => $filterAll['matour'],
            'tenkhachhang' => $filterAll['tenkhachhang'],
            'sodienthoai' => $filterAll['sodienthoai'],
            'soluongnguoi' => $filterAll['soluongnguoi'],
            'thongtinphong' => $filterAll['thongtinphong'],
            'ngayditour' => $filterAll['ngayditour'],
        ];


        $insertStatus = insert('tbdattour', $datainsert);
        if ($insertStatus) {
            setFlashData('smg', 'Cảm ơn quý khách đã đặt tour!!');
            setFlashData('smg_type', 'success');
        } else {
            setFlashData('smg', 'Hệ thống đang lỗi vui lòng thử lại sau!!');
            setFlashData('smg_type', 'danger');
        }
    } else {

        setFlashData('smg', 'Vui lòng nhập lại bạn đang nhập sai');
        setFlashData('smg_type', 'danger');
        setFlashData('error', $errors);
        setFlashData('old', $filterAll);
    }


    $smg = getFlashData('smg');
    $smg_type = getFlashData('smg_type');
    $errors = getFlashData('error');
    $old = getFlashData('old');
}
if (!empty($filterAll['matour'])) {
    $matour = $filterAll['matour'];
    $list_phanhoi = getRaw("SELECT phanhoicuakhach,tenkhachhang FROM tbdattour WHERE matour = '$matour'");
}
if (!empty($filterAll['matour'])) {
    $matour = $filterAll['matour'];


    $list_tour_product = getRaw("SELECT tbdiadiem.hinhanh, tbdiadiem.tendiadiem, tbtourdulich.tentour, tbtourdulich.gia, tbtourdulich.ngaybatdau, tbhanhtrinhtour.thutu
    FROM tbdiadiem
    JOIN tbhanhtrinhtour ON tbdiadiem.madiadiem = tbhanhtrinhtour.madiadiem
    JOIN tbtourdulich ON tbhanhtrinhtour.matour = tbtourdulich.matour
    WHERE tbtourdulich.matour = '$matour';
    ");
    $list_hanhtrinh = getRaw("SELECT
    tbtourdulich.matour,
    tbtourdulich.tentour,
    tbtourdulich.gia,
    tbtourdulich.ngaybatdau,
    tbdiadiem.tendiadiem,
    tbdiadiem.hinhanh,
    tbhanhtrinhtour.thutu
FROM
    tbtourdulich
LEFT JOIN tbhanhtrinhtour ON tbtourdulich.matour = tbhanhtrinhtour.matour
LEFT JOIN tbdiadiem ON tbhanhtrinhtour.madiadiem = tbdiadiem.madiadiem
WHERE
    tbtourdulich.matour = '$matour'
ORDER BY tbhanhtrinhtour.thutu ASC;
");
}
?>
<style>
    .image-slider {
        width: 700px;
        margin-left: 30px;

    }

    .image {
        height: 400px;
        width: 700px;
        margin-bottom: 50px;
    }

    .image img {
        margin-top: 50px;
        height: 100%;
        width: 100%;
        object-fit: cover;
        border-radius: 12px;
    }

    .slick-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: white;
        border: none;
        z-index: 5;
        padding: 10px 20px;
        height: 60px;
        width: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
        font-size: 20px;
        color: #333;
        background-color: rgba(255, 255, 255, 0.5);
    }

    .slick-arrow:hover {
        background-color: #8dc700;
        color: white;
    }

    .slick-prev {
        border-radius: 0 30px 30px 0;
        left: 0;

    }

    .slick-next {
        right: 0;
        border-radius: 30px 0 0 30px;

    }
</style>
<div class="container-fluid">
    <div class="row tour-detail">
        <div class=" col ">
            <div class="image-slider">
                <?php
                if (!empty($list_tour_product)) {
                    foreach ($list_tour_product as $item) {

                ?>
                        <div class="image-item">
                            <div class="image">
                                <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/anh/<?php echo $item['hinhanh']; ?>">
                            </div>
                        </div>

                    <?php
                    }
                    ?>
            </div>
        </div>

        <div class="col list-info-tour offset-1">


            <?php
                    if (!empty($smg)) {
                        getSmg($smg, $smg_type);
                    }
            ?>
            <div class="tour-info">
                <div class="name-tour">
                    <a href="">
                        <?php echo $item['tentour'] ?>
                    </a>

                </div>
                <div class="tour-startdate">
                    <div class="date-start">
                        <i class="fa-regular fa-clock">
                        </i>
                        <p>
                            Khởi hành : <?php echo $item['ngaybatdau'] ?>
                        </p>
                    </div>
                    <div class="location-start">
                        <i class="fa-solid fa-location-dot"></i>
                        <p>
                            Nơi khởi hành : <?php echo $item['tendiadiem'] ?>
                        </p>
                    </div>

                </div>
                <div class="tour-price">
                    <p><?php echo number_format($item['gia'], 0, ',', '.') ?>đ</p>
                </div>

            </div>

            <div class="btn-dattour">
                <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Đặt Tour</button>
                <a style=" text-decoration: none" href="tel:0000000000"><button style="border:none;background-color: #8dc700;height: 38px;width: 150px;font-weight: bold; color: #fff;" type="button">Gọi Ngay</button></a>

            </div>
        </div>

    </div>
</div>


<?php

                } else {
                    echo "No products found.";
                }

?>
<script>
    function calculateTotal() {
        var gia = <?php echo $item['gia']; ?>;
        var soluongnguoi = document.getElementById('soluongnguoi').value;
        var totalPrice = gia * soluongnguoi;
        document.getElementById('totalPrice').innerText = 'Tổng tiền: ' + totalPrice + 'đ';
    }
</script>







<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Đặt Tour</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <div class="mb-3">
                        <input name="matour" type="hidden" class="form-control" value="<?php echo $matour ?>">
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Số điện thoại:</label>
                        <input name="sodienthoai" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Họ và tên:</label>
                        <input name="tenkhachhang" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Số lượng người:</label>
                        <input name="soluongnguoi" type="number" class="form-control" id="soluongnguoi" oninput="calculateTotal()">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Loại phòng và số lượng phòng:</label>
                        <input name="thongtinphong" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Ngày đi:</label>
                        <input name="ngayditour" type="date" class="form-control">
                    </div>
                    <p style="color:tomato;" id="totalPrice">Tổng tiền: 0 đ</p>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Gửi ngay</button>
            </div>
            </form>
        </div>

    </div>
</div>



<div class="tab-container">
    <ul class="tab-header">
        <li name="tab-1" class="active" onclick="tabClicked(this)">Tiêu chuẩn </li>
        <li name="tab-2" onclick="tabClicked(this)">Chi tiết tour</li>
        <li name="tab-3" onclick="tabClicked(this)">Lưu ý</li>
        <li name="tab-4" onclick="tabClicked(this)">Ý kiến khách hàng</li>
    </ul>
    <div class=" tab-content">
        <div id="tab-1" class=" tab active ">
            <p>Đưa đón miễn phí</p>
            <p> Bảo hiểm an toàn</p>
            <p> Ăn uống miễn phí</p>
        </div>
        <div id="tab-2" class="tab">
            <?php
            if (!empty($list_hanhtrinh)) :
                foreach ($list_hanhtrinh as $item) :
            ?>
                    <p>Ngày thứ
                        <?php echo $item['thutu'] ?>:
                        <?php echo $item['tendiadiem'] ?>
                    </p>
                    <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/anh/<?php echo $item['hinhanh'] ?>" alt="">



            <?php endforeach;
            endif; ?>

        </div>
        <div id="tab-3" class="tab">
            <p>Các điểm kiện đăng ký tour :</p>
            <p>- Hộ chiếu của Quý khách phải còn thời hạn trên 6 tháng tính đến ngày về. </p>
            <p>- Khi đến đăng ký, Quý khách vui lòng mang hộ chiếu bản gốc và đóng 50% giá trị tour . Quý khách sẽ thanh
                toán hết trước 20 ngày khởi hành đối với tour Tết.
            </p>
            <p>- Quý khách mang 2 Quốc tịch hoặc Travel document (chưa nhập quốc tịch) vui lòng thông báo với nhân viên
                bán tour ngay thời điểm đăng ký tour và nộp bản gốc kèm các giấy tờ có liên quan (nếu có). </p>
            <p>- Quý khách dưới 16 tuổi phải có Bố Mẹ hoặc người nhà trên 16 tuổi đi cùng. Trường hợp đi với người nhà
                phải nộp kèm giấy ủy quyền được chính quyền địa phương xác nhận (do Bố Mẹ ủy quyền dắt đi tour)
            </p>
            <hr>
            <p>Giá tour bao gồm:</p>
            <p>- Khách sạn (phòng hai người).</p>
            <p>- Ăn uống, tham quan và vận chuyển như chương trình.
            </p>
            <p>- Hướng dẫn viên suốt tuyến.
            </p>
            <p>- Bảo hiểm du lịch.
            </p>
            <p>Đặc biệt VIETNAM-NATURE tặng thêm cho mỗi du khách phí Bảo hiểm du lịch với mức bồi thường tối đa là
                210.000.000 VNĐ cho nhân mạng và 21.000.000 VNĐ cho hành lý.

            </p>
            <hr>
            <p>Giá tour không bao gồm:</p>
            <p>- Nước uống (bia rượu trong bữa ăn), điện thoại, giặt ủi, hành lý quá cước theo quy định của hàng không.
            </p>
            <p>- Thuốc men, bệnh viện… và chi phí cá nhân của khách ngoài chương trình.
            </p>
            <hr>
            <p>Tiền bồi dưỡng:
            </p>
            <p>- Tiền bồi dưỡng cho hướng dẫn viên và tài xế địa phương (70.000 VND/khách/ngày).
            </p>
            <hr>
            <p>Các điều kiện huỷ tour: (đối với ngày thường):</p>
            <p>- Nếu hủy hoặc chuyển sang các tuyến du lịch khác trước ngày khởi hành 20 ngày: Không mất chi phí.</p>
            <p>- Nếu hủy hoặc chuyển sang các chuyến du lịch khác từ 15-19 ngày trước ngày khởi hành: Chi phí chuyển/huỷ
                tour là 50% tiền cọc tour.</p>
            <p>- Nếu hủy hoặc chuyển sang các chuyến du lịch khác từ 12-14 ngày trước ngày khởi: Chi phí chuyển/huỷ tour
                là 100% tiền cọc tour.</p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
        </div>
        <div id="tab-4" class="tab">
            <div class="container">
                <?php if (empty($list_phanhoi)) : ?>
                    <div class="no-feedback-message">
                        <p>Không có phản hồi nào.</p>
                    </div>
                <?php else : ?>
                    <?php foreach ($list_phanhoi as $item) : ?>
                        <div class="wrap-phanhoi form-control mb-3">
                            <div class="title-name">
                                <p><?php echo $item['tenkhachhang'] ?></p>
                            </div>
                            <div class="title-content">
                                <p><?php echo $item['phanhoicuakhach'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>

        </div>
    </div>
</div>





<?php
// Include footer file
layouts('footersp', $data);
?>