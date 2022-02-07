<?php
session_start();

include_once '../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../assets/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
  <link rel="stylesheet" href="../assets/styles.css">
  <title>Bella Casa Furniture</title>
</head>

<body>

  <div class="container-fluid bg-dark topbar">
    <div class="container">
      <span class="text-white p-3"><i class="fas fa-phone"></i> 0966021941 |</span>
      <span class="text-white"><i class="fas fa-envelope"></i> quyenb1809505@student.ctu.edu.vn</span>
    </div>
  </div>
  <div class="container-fluid d-flex justify-content-center logo bg-white">
    <a href="./index.php"><img src="../img/logo2.png" alt="logo"></a>
  </div>
  <div class="container-fluid sticky-top bg-light menu">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light ">
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="./index.php">TRANG CHỦ <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./index.php?page=product">TẤT CẢ SẢN PHẨM</a>
            </li>
            <?php
            $sql_dm = "select * from loaihanghoa";
            $query_dm = mysqli_query($conn, $sql_dm);

            while ($row_dm = mysqli_fetch_array($query_dm)) {
            ?>
              <li class="nav-item">
                <a class="nav-link text-uppercase" href="./index.php?page=product&dm=<?php echo $row_dm['maloaihang'] ?>"><?php echo $row_dm['tenloaihang'] ?></a>
              </li>
            <?php
            }
            ?>

          </ul>
          <span class="navbar-text">
            <a href="./index.php?page=card" class="text-success giohang">
              <i class="fas fa-cart-plus" style="font-size: 25px; margin-right: 10px;">
              </i>GIỎ HÀNG<span class="badge badge-pill badge-success ml-1">
                <?php if (isset($_SESSION['giohang'])) echo count($_SESSION['giohang']);
                else echo 0; ?>
              </span></a>
          </span>
        </div>
      </nav>
    </div>
  </div>
  <?php
  if (isset($_GET['page']))
    switch ($_GET['page']) {
      case 'product':
        include_once './product.php';
        break;
      case 'card':
        include_once './card.php';
        break;
      case 'detail':
        include_once './detail.php';
        break;
      case 'checkout':
        include_once './checkout.php';
        break;
      case 'success':
        include_once './success.php';
        break;
    }
  else
    include_once './tranchu.php';
  ?>


  <div class="container-fluid bg-dark">
    <div class="container text-center">
      <div class="text-white p-3">&copy;Copyright: Phạm Huỳnh Uy Quyền</div>
      <div class="text-white">Bài tập lớn môn Lập Trình Web</div>
    </div>
  </div>
  <script type="text/javascript" src="../assets/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="../assets/bootstrap.js"></script>
  <script type="text/javascript" src="../assets/popper.min.js"></script>
</body>

</html>