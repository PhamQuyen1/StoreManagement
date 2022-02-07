<?php
    if (isset($_GET['delete'])) {
        $delete = $_GET['delete'];
        $sql_delete = "delete from loaihanghoa where maloaihang = '$delete'";
        $squery_delete = mysqli_query($conn, $sql_delete);
    }

?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">TRANG CHỦ</a></li>
        <li class="breadcrumb-item active" aria-current="page">QUẢN LÝ DANH MỤC</li>
    </ol>
</nav>
<a href="./index.php?page=add-category" class="btn btn-outline-primary btn-lg m-3"><i class="fas fa-address-card mr-2"></i>Thêm danh mục</a>
<hr>
<div class="container">
    <h4 class="text-success" style="padding-left: 150px;">Danh sách danh mục</h4>
    <table class="table table-hover table-light " style="width: 600px;">
        <thead>
            <tr>
                <th class="text-center" scope="col">Mã danh mục</th>

                <th scope="col">Tên danh mục</th>

                <th class="text-center" scope="col">Cập nhập</th>
                <th class="text-center" scope="col">Xóa</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $sql = "select * from loaihanghoa";
            $query = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($query)){
        ?>
            <tr>
                
                    <th class="text-center" scope="row"><?php echo $row['maloaihang'] ?></th>
                    <td scope="row"><?php echo $row['tenloaihang'] ?></td>

                    <td class="text-center" scope="col"><a class="btn btn-success" href="./index.php?page=add-category&update=<?php echo $row['maloaihang']; ?>">Cập nhập</a></td>
                    <td class="text-center" scope="col"><a class="btn btn-danger" href="./index.php?page=category&delete=<?php echo $row['maloaihang']; ?>">Xóa</a></td>

                
            </tr>
        <?php
            }
        ?>
            
        </tbody>
    </table>
</div>