<?php
  ob_start();
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
  <link rel="stylesheet" href="../assets/styleadmin.css">
  <title>Bella Casa Furniture</title>
</head>

<body>
  <div class="container-fluid text-dard">
    <div class="row">
      <!---Sidebar-->
      <div class="col-2 sidebar bg-success sticky-top">
        <a href="./index.php" class="navbar-brand text-white d-block
                mx-auto text-center py-3 mb-4 text-xl-center"><img src="../img/logo3.png" width="100" class="rounded-circle mr-3"></a>
        <hr>
        <ul class="navbar-nav flex-column mt-4 " style="min-height: 460px">
          <li class="nav-item"><a href="./index.php" class="nav-link text-white p-3 mb-2
                    current"><i class="fas fa-home text-light fa-lg mr-3"></i>
              Trang chủ</a></li>
          <li class="nav-item"><a href="./index.php?page=order" class="nav-link text-white p-3 mb-2
                    sidebar-link"><i class="fas fa-hand-point-right text-light fa-lg mr-3"></i>
              Quản lý đơn hàng</a></li>
          <li class="nav-item"><a href="./index.php?page=employee" class="nav-link text-white p-3 mb-2
                    sidebar-link"><i class="fas fa-hand-point-right text-light fa-lg mr-3"></i>
              Quản lý nhân viên</a></li>
          <li class="nav-item"><a href="./index.php?page=product" class="nav-link text-white p-3 mb-2
                    sidebar-link"><i class="fas fa-hand-point-right text-light fa-lg mr-3"></i>Quản lý sản phẩm</a>
          </li>

          <li class="nav-item"><a href="./index.php?page=category" class="nav-link text-white p-3 mb-2
                    sidebar-link"><i class="fas fa-hand-point-right text-light fa-lg mr-3"></i>
              Quản lý danh mục</a></li>

        </ul>

      </div>
      <div class="col-10 p-0">
        <div class="topbar bg-dark p-3"></div>
        <?php
        if (isset($_GET['page'])) 
          switch ($_GET['page']) {
            case 'order':
              include_once './order.php';
            break;
            case 'add-category':
              include_once './add-category.php';
            break;
            case 'add-employee':
              include_once './add-employee.php';
            break;
            case 'add-product':
              include_once './add-product.php';
            break;
            case 'category':
              include_once './category.php';
            break;
            case 'employee':
              include_once './employee.php';
            break;
            case 'product':
              include_once './product.php';
            break;
        }
        else
          include_once './admin.php';
        ?>
      </div>

    </div>

  </div>

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