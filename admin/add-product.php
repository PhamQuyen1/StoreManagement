<?php
if (isset($_GET['update_product'])) {
    $update_product = $_GET['update_product'];
    $sql_update_product = "select * from hanghoa where mshh = '$update_product'";
    $query_update_product = mysqli_query($conn, $sql_update_product);
    $row_update_product = mysqli_fetch_assoc($query_update_product);
} else {
    $row_update_product['tenhh'] = '';
    $row_update_product['gia'] = '';
    $row_update_product['soluonghang'] = '';
    $row_update_product['quycach'] = '';
    $row_update_product['ghichu'] = '';
}
if (isset($_POST['submit'])) {
    $tenhh = $_POST['tenhh'];
    $maloaihang = $_POST['danhmuc'];
    $gia = $_POST['gia'];
    $soluong = $_POST['soluong'];
    $quycach = $_POST['quycach'] ? $_POST['quycach'] : '';
    $ghichu = $_POST['ghichu'] ? $_POST['ghichu'] : '';


    if (isset($_GET['update_product'])) {
        $mshh = $_GET['update_product'];

        if ($_FILES['hinhanh']['name'] != '') {

            $hinhanh_name = $_FILES['hinhanh']['name'];

            $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
            $sql_product_update = "update hanghoa set tenhh = '$tenhh', maloaihang = '$maloaihang',
             gia = '$gia', quycach = '$quycach', ghichu = '$ghichu', soluonghang = '$soluong', hinhanh = '$hinhanh_name' where mshh = '$mshh'";

            if (!file_exists('../img/' . $hinhanh_name)) {
                $query_product_update = mysqli_query($conn, $sql_product_update);
                move_uploaded_file($hinhanh_tmp, '../img/' . $hinhanh_name);
                unlink('../img/' . $row_update_product['hinhanh']);
                header('location: index.php?page=product');
            } else {
                echo "<script type='text/javascript'>alert('Tên hình ảnh đã tồn tại. Vui lòng chọn hình khác hoặc đổi tên hình !');</script>";
            }
        } else {
            $sql_product_update = "update hanghoa set tenhh = '$tenhh', maloaihang = '$maloaihang',
             gia = '$gia', quycach = '$quycach', ghichu = '$ghichu', soluonghang = '$soluong' where mshh = '$mshh'";
            $query_product_update = mysqli_query($conn, $sql_product_update);
            header('location: index.php?page=product');
        }
    } else {
        if ($_FILES['hinhanh']['name'] != '') {
            /*
            $tenhh = $_POST['tenhh'];
            $maloaihang = $_POST['danhmuc'];
            $gia = $_POST['gia'];
            $soluong = $_POST['soluong'];
            $quycach = $_POST['quycach'] ? $_POST['quycach'] : '';
            $ghichu = $_POST['ghichu'] ? $_POST['ghichu'] : '';
*/
            $hinhanh_name = $_FILES['hinhanh']['name'];

            $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
            $sql_product_add = "insert into hanghoa(tenhh, quycach, gia, soluonghang, maloaihang, ghichu, hinhanh) values('$tenhh', '$quycach', '$gia', '$soluong', '$maloaihang', '$ghichu', '$hinhanh_name')";

            if (!file_exists('../img/' . $hinhanh_name)) {
                $query_product_add = mysqli_query($conn, $sql_product_add);
                move_uploaded_file($hinhanh_tmp, '../img/' . $hinhanh_name);
                header('location: index.php?page=product');
            } else {
                echo "<script type='text/javascript'>alert('Tên hình ảnh đã tồn tại. Vui lòng chọn hình khác hoặc đổi tên hình !');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Vui lòng chọn hình ảnh!');</script>";
        }
    }
}

?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">TRANG CHỦ</a></li>
        <li class="breadcrumb-item active" aria-current="page">THÊM, CẬP NHẬP SẢN PHẨM</li>
    </ol>
</nav>
<div class="container mt-5 d-flex justify-content-center mb-4">
    <div class="row">
        <div class="col">
            <form action="" method="post" class="shadow-lg rounded bg-light p-2" style="width: 700px;" enctype="multipart/form-data">
                <h4 class="text-center text-danger">Thông tin sản phẩm</h4>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="name">Tên sản phẩm:</label>
                        <input type="text" class="form-control" name="tenhh" value="<?php echo $row_update_product['tenhh'] ?>" required>
                    </div>
                    <div class="form-group col">
                        <label for="danhmuc">Loại sản phẩm: </label>
                        <select id="action" class="custom-select" id="danhmuc" name="danhmuc">
                            <?php
                            $sql = "select * from loaihanghoa";
                            $query = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <option value="<?php echo $row['maloaihang'] ?>" <?php if (isset($_GET['update_product'])) {
                                                                                        if ($row_update_product['maloaihang'] == $row['maloaihang']) echo 'selected = "selected"';
                                                                                    } ?>><?php echo $row['tenloaihang'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col">
                        <label for="price">Giá:</label>
                        <input type="number" class="form-control" id="price" name="gia" value="<?php echo $row_update_product['gia'] ?>" required>
                    </div>
                    <div class="form-group col">
                        <label for="quanlity">Số lượng:</label>
                        <input type="number" class="form-control" id="quanlity" name="soluong" value="<?php echo $row_update_product['soluonghang'] ?>" required min="1">
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-3">
                        <label for="quycach">Quy cách:</label>
                        <textarea class="form-control " value="" id="quycach" name="quycach"><?php echo $row_update_product['quycach'] ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="note">Ghi chú:</label>
                    <input type="text" class="form-control" value="<?php echo $row_update_product['ghichu'] ?>" id="note" name="ghichu">
                </div>
                <div class="">
                    <label for="file">Hình ảnh:</label>
                    <br>
                    <?php
                    if (isset($_GET['update_product']))
                        echo '<img src="../img/' . $row_update_product['hinhanh'] . '" alt="lohoa1" width="150px">';
                    ?>
                    <br>
                    <input type="file" name="hinhanh" id="hinhanh" class="mt-2" id="file">
                </div>
                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-success">
                        <h4>Đồng ý</h4>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>