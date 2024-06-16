<!-- <------------------Thêm ----------------->
<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

if (isPost()) {
    $filterAll = filter();

    $errors = [];
    //validate tên tour: bắt buộc phải nhập , số ký tự phải trên 5

    if (empty($filterAll['tentour'])) {
        $errors['tentour']['require'] = "Tên tour bắt buộc phải nhập";
    } else {
        if (strlen($filterAll['tentour']) < 5) {
            $errors['tentour']['require'] = "Họ tên ít nhất phải có trên 5 ký tự";
        }
    }

    //validate mã địa điểm: có trong db hay không,bắt buộc phải nhâp


    //validate giá tour: bắt buộc phải nhập
    if (empty($filterAll['gia'])) {
        $errors['gia']['require'] = "giá tour bắt buộc phải nhập";
    }

    if (empty($errors)) {
        $datainsert = [
            'tentour' => $filterAll['tentour'],
            'gia' => $filterAll['gia'],
            'mota' => $filterAll['mota'],
            'mota' => $filterAll['mota'],
            'ngaybatdau' => $filterAll['ngaybatdau'],
            'ngayketthuc' => $filterAll['ngayketthuc']
        ];

        $insertStatus = insert('tbtourdulich', $datainsert);
        if ($insertStatus) {
            setFlashData('smg', 'Thêm tour du lịch thành công!!');
            setFlashData('smg_type', 'success');
            redirect('?modules=tourdulich&action=list');
        } else {
            setFlashData('smg', 'Hệ thống đang lỗi vui lòng thử lại sau!!');
            setFlashData('smg_type', 'danger');
        }

        redirect('?modules=tourdulich&action=add');
    } else {

        setFlashData('smg', 'Vui lòng kiểm tra dữ liệu');
        setFlashData('smg_type', 'danger');
        setFlashData('error', $errors);
        setFlashData('old', $filterAll);
        redirect('?modules=tourdulich&action=add');
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
        <h2 class="text-center text-uppercase mb-4">Thêm tour du lịch</h2>
        <?php
        if (!empty($smg)) {
            getSmg($smg, $smg_type);
        }
        ?>
        <form action="" method="post">
            <div class="row ">
                <div class="col">
                    <div class="form-group mg-form">
                        <label for="">Tên tour</label>
                        <input name="tentour" type="text" class="form-control" placeholder="Tên tour">
                        <?php
                        echo (!empty($errors['tentour'])) ?  '<span class="error">' . reset($errors['tentour']) . '</span>' : null;
                        ?>
                    </div>

                    <div class="form-group mg-form">
                        <label for="">Giá</label>
                        <input name="gia" type="text" class="form-control" placeholder="Giá">
                        <?php
                        echo (!empty($errors['gia'])) ?  '<span class="error">' . reset($errors['gia']) . '</span>' : null;
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
                        <label for="">Ngày bắt đầu</label>
                        <input name="ngaybatdau" type="date" class="form-control" placeholder="Ngày bắt đầu">
                        <?php
                        echo (!empty($errors['ngaybatdau'])) ?  '<span class="error">' . reset($errors['ngaybatdau']) . '</span>' : null;
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Ngày kết thúc</label>
                        <input name="ngayketthuc" type="date" class="form-control" placeholder="Ngày kết thúc">
                        <?php
                        echo (!empty($errors['ngayketthuc'])) ?  '<span class="error">' . reset($errors['ngayketthuc']) . '</span>' : null;
                        ?>
                    </div>
                </div>
            </div>




            <button type="submit" class="mg-btn mg-form btn btn-success btn-block ">
                Thêm
            </button>
            <a href="?modules=tourdulich&action=list"><button type="button" class="btn btn-secondary">Quay
                    lại</button></a>

        </form>
    </div>
</div>

<?php
layouts('footer');
?>