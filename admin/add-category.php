<?php
if (isset($_GET['update'])) {
    
    $update = $_GET['update'];
    $sql_update = "select * from loaihanghoa where maloaihang = '$update'";
    $query_update = mysqli_query($conn, $sql_update);
    $row_update = mysqli_fetch_assoc($query_update);
} else {
    $row_update['tenloaihang'] = '';
}
if (isset($_POST['submit'])) {
    
    if (isset($_GET['update'])) {
        if (isset($_POST['tenloaihang'])) {
            $maloaihang = $_GET['update'];
            $tenloaihang = $_POST['tenloaihang'];
            $sql_category = "select * from loaihanghoa where tenloaihang = '$tenloaihang'";
            $query_category = mysqli_query($conn, $sql_category);
            $row_category = mysqli_num_rows($query_category);
            if($row_category== 0){
                $sql_update = "update loaihanghoa set tenloaihang = '$tenloaihang' where maloaihang = '$maloaihang'";
                $query_update = mysqli_query($conn, $sql_update);
                header('location: index.php?page=category');
            }else echo "<script type='text/javascript'>alert('Danh mục đã tồn tại!');</script>";
            
        }
    }else{
        if (isset($_POST['tenloaihang'])) {
            
            $tenloaihang = $_POST['tenloaihang'];
            $sql_category = "select * from loaihanghoa where tenloaihang = '$tenloaihang'";
            $query_category = mysqli_query($conn, $sql_category);
            $row_category = mysqli_num_rows($query_category);
            if($row_category== 0){
                $sql_add = "insert into loaihanghoa(tenloaihang) values('$tenloaihang')";
                $query_add = mysqli_query($conn, $sql_add);
                header('location: index.php?page=category');
            }else echo "<script type='text/javascript'>alert('Danh mục đã tồn tại!');</script>";
            
        }
    }
}

?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">TRANG CHỦ</a></li>
        <li class="breadcrumb-item active" aria-current="page">THÊM, CẬP NHẬP DANH MỤC</li>
    </ol>
</nav>
<div class="container mt-5 d-flex justify-content-center">
    <div class="row">
        <div class="col">
            <form action="" method="post" class="shadow-lg rounded bg-light p-2" style="width: 700px;">
                <h4 class="text-center text-danger">Thông tin danh mục</h4>
                <div class="form-group">
                    <label for="name">Tên danh mục:</label>
                    <input type="text" class="form-control" name="tenloaihang" value="<?php echo $row_update['tenloaihang'] ?>" required>
                </div>
                <div class="text-center">
                    <button type="submit" name = "submit" class="btn btn-success">
                        <h4>Đồng ý</h4>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>