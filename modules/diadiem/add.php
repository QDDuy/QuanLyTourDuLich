<!-- <------------------Thêm ----------------->
<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

if (isPost()) {
    $filterAll = filter();

    $errors = [];
    //validate tên tour: bắt buộc phải nhập , số ký tự phải trên 5

    if (empty($filterAll['tendiadiem'])) {
        $errors['tendiadiem']['require'] = "Tên địa điểm bắt buộc phải nhập";
    } else {
        if (strlen($filterAll['tendiadiem']) < 5) {
            $errors['tendiadiem']['require'] = "Họ tên ít nhất phải có trên 5 ký tự";
        }
    }

    if (empty($errors)) {
        $datainsert = [
            'tendiadiem' => $filterAll['tendiadiem'],
            'mota' => $filterAll['mota'],
            'hinhanh' => $filterAll['hinhanh']
        ];

        $insertStatus = insert('tbdiadiem', $datainsert);
        if ($insertStatus) {
            setFlashData('smg', 'Thêm địa điểm du lịch thành công!!');
            setFlashData('smg_type', 'success');
            redirect('?modules=diadiem&action=list');
        } else {
            setFlashData('smg', 'Hệ thống đang lỗi vui lòng thử lại sau!!');
            setFlashData('smg_type', 'danger');
        }

        redirect('?modules=diadiem&action=add');
    } else {

        setFlashData('smg', 'Vui lòng kiểm tra dữ liệu');
        setFlashData('smg_type', 'danger');
        setFlashData('error', $errors);
        setFlashData('old', $filterAll);
        redirect('?modules=diadiem&action=add');
    }
}




layouts('header');

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
$errors = getFlashData('error');
$old = getFlashData('old');
?>


<div class="container">
    <div class="row" style="margin: 100px auto; ">
        <h2 class="text-center text-uppercase mb-4">Thêm địa điểm du lịch</h2>
        <?php
        if (!empty($smg)) {
            getSmg($smg, $smg_type);
        }
        ?>
        <form action="" method="post">
            <div class="row ">
                <div class="col">
                    <div class="form-group mg-form">
                        <label for="">Tên địa điểm</label>
                        <input name="tendiadiem" type="text" class="form-control" placeholder="Tên địa điểm">
                        <?php
                        echo (!empty($errors['tendiadiem'])) ?  '<span class="error">' . reset($errors['tendiadiem']) . '</span>' : null;
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Mô tả</label>
                        <input name="mota" type="text" class="form-control" placeholder="Mô tả">
                        <?php
                        echo (!empty($errors['mota'])) ?  '<span class="error">' . reset($errors['mota']) . '</span>' : null;
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Hình ảnh</label>
                        <input name="hinhanh" type="file" class="form-control" placeholder="Hình ảnh">
                        <?php
                        echo (!empty($errors['hinhanh'])) ?  '<span class="error">' . reset($errors['hinhanh']) . '</span>' : null;
                        ?>
                    </div>
                </div>
            </div>




            <button type="submit" class="mg-btn mg-form btn btn-success btn-block ">
                Thêm
            </button>
            <a href="?modules=diadiem&action=list"><button type="button" class="btn btn-secondary">Quay
                    lại</button></a>

        </form>
    </div>
</div>

<?php
layouts('footer');
?>