
<?php
    if (isset($_GET['employee'])) {
        $employee = $_GET['employee'];
        $sql_employee = "delete from nhanvien where msnv = '$employee'";
        $squery_employee = mysqli_query($conn, $sql_employee);
    }

?>
<?php
    $sql = "select * from nhanvien";
    $query = mysqli_query($conn, $sql);
    
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">TRANG CHỦ</a></li>
        <li class="breadcrumb-item active" aria-current="page">QUẢN LÝ NHÂN VIÊN</li>
    </ol>
</nav>
<a href="./index.php?page=add-employee" class="btn btn-outline-primary btn-lg m-3"><i class="fas fa-address-card mr-2"></i>Thêm nhân viên</a>
<hr>
<div class="container">
    <h4 class="text-success text-center">Danh sách nhân viên</h4>
    <table class="table table-hover table-light ">
        <thead>
            <tr>
                <th class="text-center" scope="col">ID</th>

                <th scope="col">Tên Nhân viên</th>
                <th scope="col">Chức vụ</th>
                <th class="text-center" scope="col">Địa chỉ</th>
                <th class="text-center" scope="col">Số điện thoại</th>

                <th class="text-center" scope="col">Cập nhập</th>
                <th class="text-center" scope="col">Xóa</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while($row = mysqli_fetch_array($query)){
        ?>
            <tr>
                <form action="#" method="post">
                    <th class="text-center" scope="row"><?php echo $row['msnv'] ?></th>
                    <td class="text-center" scope="row"><?php echo $row['hotennv'] ?></td>
                    <td><?php echo $row['chucvu'] ?></td>
                    <td style="max-width: 400px;"><?php echo $row['diachi'] ?></td>
                    <td class="text-center" scope="col"><?php echo $row['sodienthoai'] ?></td>
                    <td class="text-center" scope="col"><a class="btn btn-success" href="./index.php?page=add-employee&employee=<?php echo $row['msnv'] ?>">Cập nhập</a></td>
                    <td class="text-center" scope="col"><a class="btn btn-danger" href="./index.php?page=employee&employee=<?php echo $row['msnv'] ?>">Xóa</a></td>

                </form>
            </tr>
        <?php
            }
        ?>
            
        </tbody>
    </table>
</div>