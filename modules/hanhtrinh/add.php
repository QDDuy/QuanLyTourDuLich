<?php
if (!defined('_CODE')) {
    die("Access dinied....");
}

if (isPost()) {
    $filterAll = filter();

    $errors = [];

    if (empty($filterAll['matour'])) {
        $errors['matour']['require'] = "Mã tour bắt buộc phải nhập";
    } else {
        $matour = $filterAll['matour'];
        $sql = "SELECT matour FROM tbtourdulich WHERE matour = '$matour'";
        if (getRows($sql) == 0) {
            $errors['matour']['require'] = "Mã tour này không tại";
        }
    }
    if (empty($filterAll['madiadiem'])) {
        $errors['madiadiem']['require'] = "Mã diadiem bắt buộc phải nhập";
    } else {
        $madiadiem = $filterAll['madiadiem'];
        $sql = "SELECT madiadiem FROM tbdiadiem WHERE madiadiem = '$madiadiem'";
        if (getRows($sql) == 0) {
            $errors['madiadiem']['require'] = "Mã diaidiem này không tại";
        }
    }
    if (empty($filterAll['tendiadiem'])) {
        $errors['tendiadiem']['require'] = "Tên diadiem bắt buộc phải nhập";
    } else {
        $madiadiem = $filterAll['madiadiem'];
        $tendiadiem = $filterAll['tendiadiem'];  // Sửa lỗi chính tả
        $sql = "SELECT * FROM tbdiadiem WHERE tendiadiem = '$tendiadiem' AND madiadiem = '$madiadiem'";
        if (getRows($sql) == 0) {
            $errors['tendiadiem']['require'] = "Tên diadiem này không phải của mã địa điểm trên";  // Sửa thông điệp lỗi
        }
    }
    // Kiểm tra Thứ tự
    if (empty($filterAll['thutu'])) {
        $errors['thutu']['require'] = "Thứ tự bắt buộc phải nhập";
    } else {
        if (!is_numeric($filterAll['thutu'])) {
            $errors['thutu']['invalid'] = "Thứ tự phải là số";
        } elseif ($filterAll['thutu'] < 1) {
            $errors['thutu']['min'] = "Thứ tự phải lớn hơn hoặc bằng 1";
        }
    }

    if (empty($errors)) {
        $datainsert = [
            'matour' => $filterAll['matour'],
            'madiadiem' => $filterAll['madiadiem'],
            'tendiadiem' => $filterAll['tendiadiem'],
            'thutu' => $filterAll['thutu'],
        ];

        $insertStatus = insert('tbhanhtrinhtour', $datainsert);

        if ($insertStatus) {
            setFlashData('smg', 'Thêm hành trình thành công!!');
            setFlashData('smg_type', 'success');
            redirect('?modules=hanhtrinh&action=list');
        } else {
            setFlashData('smg', 'Hệ thống đang lỗi vui lòng thử lại sau!!');
            setFlashData('smg_type', 'danger');
        }
    } else {
        setFlashData('smg', 'Vui lòng kiểm tra dữ liệu');
        setFlashData('smg_type', 'danger');
        setFlashData('error', $errors);
        setFlashData('old', $filterAll);
        redirect('?modules=hanhtrinh&action=add');
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
        <h2 class="text-center text-uppercase mb-4">Thêm hành trình</h2>
        <?php
        if (!empty($smg)) {
            getSmg($smg, $smg_type);
        }
        ?>
        <form action="" method="post">
            <div class="row ">
                <div class="col">
                    <div class="form-group mg-form">
                        <label for="">Mã tour</label>
                        <input name="matour" type="text" class="form-control" placeholder="Mã tour" value="<?php echo (!empty($old['matour'])) ? $old['matour'] : null ?>">
                        <?php echo (!empty($errors['matour'])) ? '<span class="error">' . reset($errors['matour']) . '</span>' : null; ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Mã địa điểm</label>
                        <input name="madiadiem" type="text" class="form-control" placeholder="Địa điểm" value="<?php echo (!empty($old['madiadiem'])) ? $old['madiadiem'] : null ?>">
                        <?php echo (!empty($errors['madiadiem'])) ? '<span class="error">' . reset($errors['madiadiem']) . '</span>' : null; ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Tên địa điểm</label>
                        <input name="tendiadiem" type="text" class="form-control" placeholder="Địa điểm" value="<?php echo (!empty($old['tendiadiem'])) ? $old['tendiadiem'] : null ?>">
                        <?php echo (!empty($errors['tendiadiem'])) ? '<span class="error">' . reset($errors['tendiadiem']) . '</span>' : null; ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Thứ tự</label>
                        <input name="thutu" type="text" class="form-control" placeholder="Thứ tự" value="<?php echo (!empty($old['thutu'])) ? $old['thutu'] : null ?>">
                        <?php echo (!empty($errors['thutu'])) ? '<span class="error">' . reset($errors['thutu']) . '</span>' : null; ?>
                    </div>
                    <button type="submit" class="mg-btn mg-form btn btn-success btn-block">
                        Thêm
                    </button>
                    <a href="?modules=hanhtrinh&action=list"><button type="button" class="btn btn-secondary">Quay
                            lại</button></a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
layouts('footer');
?>