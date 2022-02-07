<?php
if (isset($_GET['mshh'])) {
  $mshh = $_GET['mshh'];
  $sql_hh = "select * from hanghoa where mshh = '$mshh'";
  $query_hh = mysqli_query($conn, $sql_hh);
  $row = mysqli_fetch_assoc($query_hh);
  $lienquan = $row['maloaihang'];
  $sql_lienquan = "select * from hanghoa where maloaihang = '$lienquan' and mshh != '$mshh' ORDER BY mshh DESC limit 4";
  $query_lienquan = mysqli_query($conn, $sql_lienquan);
}
?>


<section class="content container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./index.php">TRANG CHỦ</a></li>
      <li class="breadcrumb-item active" aria-current="page">CHI TIẾT SẢN PHẨM</li>
    </ol>
  </nav>
  <div class="container shadow-lg p-3 mb-5 bg-white rounded">
    <div class="row">
      <div class="col-4">
        <img src="../img/<?php echo $row['hinhanh'] ?>" alt="<?php echo $row['tenhh'] ?>">
      </div>
      <div class="col-8 p-3 pl-5">
        <h3 class="title text-success text-center"><?php echo $row['tenhh'] ?></h3>
        <hr>
        <span class="card-price ml-3"><?php echo number_format($row['gia']) . ' VNĐ' ?></span>

        <div class="pl-3">Kho: <span id="max"><?php echo $row['soluonghang'] ?></span></div>

        <a href="./addcard.php?mshh=<?php echo $row['mshh'] ?>" class="btn btn-danger d-flex justify-content-center addtocard ml-2 mt-1">Thêm vào Giỏ hàng</a>
        <div class="infor">PHÍ VẬN CHUYỂN TOÀN QUỐC</div>
        <div class="infor">ĐỔI TRẢ MIỄN PHÍ</div>
        <p>Hỗ trợ dổi trả sản phẩm trong vòng 3 đến 5 ngày, nếu không vừa size, sản phẩm bị lỗi (giữ sản phẩm sạch và chưa qua sử dụng) bạn sẽ đổi hoặc trả sản phẩm mà không tốn phí.</p>
        <div class="infor">THANH TOÁN KHI NHẬN HÀNG</div>
      </div>
    </div>
    <hr>
    <div class="detail">
      <div class="detail-title">MÔ TẢ SẢN PHẨM</div>
      <p><?php echo $row['quycach'] ?></p>
    </div>
    <hr>
    <div class="list">
      <div class="detail-title">SẢN PHẨM LIÊN QUAN</div>
      <div class="row row-cols-1 row-cols-md-4">
        <?php
        
        while ($row_lienquan = mysqli_fetch_array($query_lienquan)) {
        ?>
          <div class="col mb-4">
            <div class="card" style="height: 482px;">
              <img src="../img/<?php echo $row_lienquan['hinhanh'] ?>" class="card-img-top" alt="<?php echo $row_lienquan['tenhh'] ?>">
              <div class="card-body">
                <h5 class="card-title text-success text-center" style="height: 44px;"><?php echo $row_lienquan['tenhh'] ?></h5>
                <span class="card-price"><?php echo number_format($row_lienquan['gia']) . ' VNĐ' ?></span>

                <a href="./addcard.php?mshh=<?php echo $row_lienquan['mshh'] ?>" class="btn btn-danger d-flex justify-content-center">Thêm vào Giỏ hàng</a>
                <a href="./index.php?page=detail&mshh=<?php echo $row_lienquan['mshh'] ?>" class="btn btn-primary d-flex justify-content-center mt-3">Thông tin chi tiết</a>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
        
      </div>
    </div>
  </div>
</section>