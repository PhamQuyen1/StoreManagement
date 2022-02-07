<?php
    if (isset($_GET['delete_product'])) {
        $delete = $_GET['delete_product'];
        $sql_delete = "delete from hanghoa where mshh = '$delete'";
        
        $sql_file = "select * from hanghoa where mshh = '$delete'";
        $query_file = mysqli_query($conn, $sql_file);
        $row_file = mysqli_fetch_assoc($query_file);
        
        unlink('../img/'.$row_file['hinhanh']);
        $squery_delete = mysqli_query($conn, $sql_delete);
    }

?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./index.php">TRANG CHỦ</a></li>
        <li class="breadcrumb-item active" aria-current="page">QUẢN LÝ SẢN PHẨM</li>
    </ol>
</nav>
<a href="./index.php?page=add-product" class="btn btn-outline-primary btn-lg m-3"><i class="fas fa-address-card mr-2"></i>Thêm sản phẩm</a>
<hr>
<div class="container">
    <h4 class="text-success text-center">Danh sách sản phẩm</h4>
    <table class="table table-hover table-light ">
        <thead>
            <tr>
                <th class="text-center" scope="col">ID</th>

                <th scope="col">Tên sản phẩm</th>
                <th class="text-center" scope="col">Hình ảnh</th>
                <th class="text-center" scope="col">Phân loại</th>
                <th class="text-center" scope="col">Số lượng</th>
                <th class="text-center" scope="col">Giá</th>
                <th class="text-center" scope="col">Cập nhập</th>
                <th class="text-center" scope="col">Xóa</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $sql = "select hh.*, l.tenloaihang from hanghoa hh join loaihanghoa l on hh.maloaihang = l.maloaihang order by mshh desc";
            $query = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($query)){
        ?>
            <tr>
                <form action="#" method="post">
                    <th class="text-center" scope="row"><?php echo $row['mshh'] ?></th>
                    <td scope="row"><?php echo $row['tenhh'] ?></td>
                    <td class="text-center"><img src="../img/<?php echo $row['hinhanh'] ?>" alt="lohoa1" width="150px"></td>
                    <td class="text-center"><?php echo $row['tenloaihang'] ?></td>
                    <td class="text-center" scope="col"><?php echo $row['soluonghang'] ?></td>
                    <td class="text-center" scope="col"><?php echo number_format($row['gia']).' VNĐ' ?></td>
                    <td class="text-center" scope="col"><a class="btn btn-success" href="./index.php?page=add-product&update_product=<?php echo $row['mshh']; ?>">Cập nhập</a></td>
                    <td class="text-center" scope="col"><a class="btn btn-danger" href="./index.php?page=product&delete_product=<?php echo $row['mshh']; ?>">Xóa</a></td>

                </form>
            </tr>
        <?php
            }
        ?>
            
        </tbody>
    </table>
</div>