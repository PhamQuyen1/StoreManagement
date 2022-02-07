<?php
if (isset($_GET['dm'])) {
  $dm = $_GET['dm'];
  $sql_dm = "select * from hanghoa where maloaihang = '$dm' order by mshh desc";
  $query_dm = mysqli_query($conn, $sql_dm);
}else{
  
  $sql_dm = "select * from hanghoa order by mshh desc";
  $query_dm = mysqli_query($conn, $sql_dm);
}
?>

<section class="content container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./index.php">TRANG CHỦ</a></li>
      <li class="breadcrumb-item active text-uppercase" aria-current="page">
      <?php 
      if (isset($_GET['dm'])) {
        $sql_ten = "select * from loaihanghoa where maloaihang = '$dm'";
        $query_ten = mysqli_query($conn, $sql_ten);
        $row_ten = mysqli_fetch_assoc($query_ten);
        echo $row_ten['tenloaihang'];
      } else
      echo 'TẤT CẢ SẢN PHẨM';
      ?>
      </li>
    </ol>
  </nav>
  <div class="container shadow-lg p-3 mb-5 bg-white rounded">
    <div class="row row-cols-1 row-cols-md-4">
      <?php
      while ($row_dm = mysqli_fetch_array($query_dm)) {
      ?>
        <div class="col mb-4">
          <div class="card" style="height: 482px;">
            <img src="../img/<?php echo $row_dm['hinhanh'] ?>" class="card-img-top" alt="<?php echo $row_dm['tenhh'] ?>">
            <div class="card-body">
              <h5 class="card-title text-success text-center" style="height: 44px;"><?php echo $row_dm['tenhh'] ?></h5>
              <span class="card-price"><?php echo number_format($row_dm['gia']) . ' VNĐ' ?></span>

              <a href="./addcard.php?mshh=<?php echo $row_dm['mshh'] ?>" class="btn btn-danger d-flex justify-content-center">Thêm vào Giỏ hàng</a>
              <a href="./index.php?page=detail&mshh=<?php echo $row_dm['mshh'] ?>" class="btn btn-primary d-flex justify-content-center mt-3">Thông tin chi tiết</a>
            </div>
          </div>
        </div>
      <?php
      }
      ?>

    </div>
  </div>

</section>