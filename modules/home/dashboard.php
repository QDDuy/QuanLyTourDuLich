<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

$data = [
    'pageTitle' => 'Trang chủ'
];
layouts('header', $data);
$filterAll = filter();

if (isPost()) {
    // Lấy giá trị từ người dùng
    $selectedMonth = $filterAll["selectedMonth"];
    $selectedYear = $filterAll["selectedYear"];

    $thongkedattour = getRaw("
        SELECT 
            DAY(ngaydat) AS ngay,
            COUNT(*) AS soluongdat,
            SUM(soluongnguoi) AS tongnguoidat
        FROM 
            tbdattour
        WHERE
            MONTH(ngaydat) = $selectedMonth
            AND YEAR(ngaydat) = $selectedYear
        GROUP BY 
            ngay
        ORDER BY 
            ngay ASC;
    ");

    // Hiển thị kết quả trong bảng HTML

}
$thongketinhhinhdattour = getRaw("SELECT COUNT(*) AS soluongdattour,
        SUM(CASE WHEN xacnhanthanhtoan = 1 THEN 1 ELSE 0 END) AS soluongthanhtoan
    FROM 
        tbdattour;
");

$thongkephanhoi = getRaw("SELECT
COUNT(*) AS total_feedback,
SUM(CASE WHEN phanhoicuakhach IS NOT NULL AND phanhoicuakhach <> '' THEN 1 ELSE 0 END) AS feedback_count,
(SUM(CASE WHEN phanhoicuakhach IS NOT NULL AND phanhoicuakhach <> '' THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS feedback_percentage
FROM
tbdattour");
?>
<div class="container">
    <div class="row ">
        <div class="col bg-danger rounded">
            <h2 class="text-warning">Thống kê đặt tour</h2>

            <form action="" method="post">
                <label for="selectedMonth">Chọn tháng:</label>
                <select id="selectedMonth" name="selectedMonth" required>
                    <?php
                    // Tạo danh sách các tháng
                    for ($i = 1; $i <= 12; $i++) {
                        echo "<option value=\"$i\">Tháng $i</option>";
                    }
                    ?>
                </select>

                <label for="selectedYear">Chọn năm:</label>
                <select id="selectedYear" name="selectedYear" required>
                    <?php
                    // Tạo danh sách các năm (ví dụ từ năm 2000 đến năm hiện tại)
                    $currentYear = date("Y");
                    for ($i = $currentYear; $i >= 2000; $i--) {
                        echo "<option value=\"$i\">Năm $i</option>";
                    }
                    ?>
                </select>

                <button type="submit">Thống kê</button>
            </form>


            <table class="table table-bordered table-hover ">
                <thead class="table-info">
                    <th>Ngày</th>
                    <th>Số lượng đặt</th>
                    <th>Tổng người đặt</th>

                </thead>

                <tbody>
                    <?php
                    if (!empty($thongkedattour)) :
                        foreach ($thongkedattour as $item) :
                    ?>
                    <tr>
                        <td><?php echo $item['ngay'] ?></td>
                        <td><?php echo $item['soluongdat'] ?></td>
                        <td><?php echo $item['tongnguoidat'] ?></td>

                    </tr>
                </tbody>

                <?php
                        endforeach;
                    endif;
        ?>
            </table>
        </div>
        <div class="col bg-success mx-5 rounded p-5">
            <h2 class="text-warning">Thống kê phản hồi</h2>
            <?php
            if (!empty($thongkephanhoi)) :
                foreach ($thongkephanhoi as $item) :
            ?>
            <p>Tổng số phản hồi : <?php echo $item['total_feedback'] ?></p>
            <p>Số lượng phản hồi có giá trị : <?php echo $item['feedback_count'] ?></p>
            <p>Phần trăm phản hồi có giá trị: <?php echo number_format($item['feedback_percentage'], 1) ?>%</p>

            <?php
                endforeach;
            endif;
            ?>
        </div>

        <div class="col bg-warning rounded p-5 text-lg">
            <h2 class="text-info"> Tình hình thanh toán</h2>

            <?php
            if (!empty($thongketinhhinhdattour)) :
                foreach ($thongketinhhinhdattour as $item) :
                    $soLuongDatTour = isset($item['soluongdattour']) ? $item['soluongdattour'] : 0;
                    $soLuongThanhToan = isset($item['soluongthanhtoan']) ? $item['soluongthanhtoan'] : 0;
                    $tyLeThanhToan = ($soLuongDatTour > 0) ? ($soLuongThanhToan / $soLuongDatTour) * 100 : 0;
            ?>
            <p>Số lượng đặt tour: <?php echo $soLuongDatTour ?></p>
            <p>Số lượng thanh toán: <?php echo $soLuongThanhToan ?></p>
            <p>Tỷ lệ thanh toán: <?php echo number_format($tyLeThanhToan, 1) ?>%</p>

            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</div>
<?php
layouts('footer');
?>

<style>
label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Tùy chỉnh kiểu dáng cho nút submit */
button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

p {
    font-size: 19px;
    font-weight: bold;
}
</style>