<?php
if (isset($_GET['employee'])) {
    $employee = $_GET['employee'];
    $sql = "select * from nhanvien where msnv = $employee";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
} else {
    $row['msnv'] = '';
    $row['hotennv'] = '';
    $row['diachi'] = '';
    $row['sodienthoai'] = '';
    $row['chucvu'] = '';
}
if (isset($_POST['submit'])) {

    $hotennv = $_POST['hotennv'];
    $chucvu = $_POST['chucvu'];
    $sodienthoai = $_POST['sodienthoai'];
    $diachi = $_POST['diachi'];

    if (isset($_GET['employee'])) {
        $employee = $_GET['employee'];
        $sql_update = "update nhanvien set hotennv = '$hotennv', chucvu = '$chucvu', sodienthoai = '$sodienthoai', diachi = '$diachi' where msnv = '$employee'";
        $query_update = mysqli_query($conn, $sql_update);
    } else {
        $sql_insert = "insert into nhanvien(hotennv, chucvu, sodienthoai, diachi) values('$hotennv', '$chucvu', '$sodienthoai', '$diachi')";
        $query_insert = mysqli_query($conn, $sql_insert);
    }
    header('location: index.php?page=employee');
}
?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">TRANG CHỦ</a></li>
        <li class="breadcrumb-item active" aria-current="page">THÊM, CẬP NHẬP NHÂN VIÊN</li>
    </ol>
</nav>
<div class="container mt-5 d-flex justify-content-center">
    <div class="row">
        <div class="col">
            <form action="" method="post" class="shadow-lg rounded bg-light p-2" style="width: 700px;">
                <h4 class="text-center text-danger">Thông tin nhân viên</h4>

                <div class="form-group">
                    <label for="name">Họ tên:</label>
                    <input type="text" class="form-control" id="name" name="hotennv" value="<?php echo $row['hotennv'] ?>" required>
                </div>

                <div class="form-row">
                    <div class="form-group col">
                        <label for="chucvu">Chức vụ</label>
                        <input type="text" class="form-control" id="chucvu" name="chucvu" value="<?php echo $row['chucvu'] ?>" required>
                    </div>
                    <div class="form-group col">
                        <label for="phone">Số điện thoại:</label>
                        <input type="text" class="form-control" id="phone" name="sodienthoai" value="<?php echo $row['sodienthoai'] ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Địa chỉ:</label>
                    <input type="text" class="form-control" id="inputAddress" name="diachi" value="<?php echo $row['diachi'] ?>" required>
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