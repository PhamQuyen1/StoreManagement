<?php
if (isset($_POST['submit'])) {
  $sodondh = $_POST['sodondh'];

  $tinhtrang = $_POST['tinhtrang'];
  $sql_ct = "update dathang set trangthai = '$tinhtrang', ngaygh = ADDDATE(CURRENT_TIMESTAMP(), INTERVAL 7 DAY) where sodondh = '$sodondh'";
  $query_ct = mysqli_query($conn, $sql_ct);
}
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">TRANG CHỦ</a></li>
    <li class="breadcrumb-item active" aria-current="page">QUẢN LÝ ĐƠN HÀNG</li>
  </ol>
</nav>
<div class="container">
  <h4 class="text-success text-center">Danh sách đơn hàng</h4>
  <table class="table table-hover table-light ">
    <thead>
      <tr>

        <th class="text-center" scope="col">Mã ĐH</th>
        <th scope="col">Tên Khách hàng</th>
        <th scope="col">Sản phẩm</th>
        <th class="text-center" scope="col">Số lượng</th>
        <th class="text-center" scope="col">Ngày đặt hàng</th>
        <th class="text-center" scope="col">Tổng tiền</th>
        <th class="text-center" scope="col">Xử lý</th>
        <th class="text-center" scope="col">Cập nhập</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "select kh.hotenkh, dh.sodondh, hh.mshh, hh.tenhh, ct.soluong, dh.ngaydh, 
      ct.soluong * ct.giadathang - ct.soluong * ct.giadathang * COALESCE(ct.giamgia, 0) as tongtien, 
      dh.trangthai from khachhang kh join dathang dh on kh.mskh = dh.mskh 
      join chitietdathang ct on dh.sodondh = ct.sodondh join hanghoa hh on ct.mshh = hh.mshh 
      order by dh.sodondh desc";
      $query = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_array($query)) {
      ?>
        <tr>
          <form action="" method="post">

            <td class="text-center" scope="row" value="<?php echo $row['sodondh'] ?>"><?php echo $row['sodondh'] ?></td>
            <td><?php echo $row['hotenkh'] ?></td>
            <td><?php echo $row['tenhh'] ?></td>
            <td class="text-center" scope="col"><?php echo $row['soluong'] ?></td>
            <td class="text-center" scope="col"><?php echo $row['ngaydh'] ?></td>
            <td class="text-center"><?php echo number_format($row['tongtien']) . ' VNĐ' ?></td>
            <td class="text-center">
              <select id="action" class="custom-select" name="tinhtrang">
                <option value="0" <?php if ($row['trangthai'] == 0) echo 'selected = "selected"' ?>>Chưa duyệt</option>
                <option value="1" <?php if ($row['trangthai'] == 1) echo 'selected = "selected"' ?>>Đã duyệt</option>
                <option value="2" <?php if ($row['trangthai'] == 2) echo 'selected = "selected"' ?>>Xóa</option>
              </select>
            </td>
            <input type="hidden" name="mshh" value="<?php echo $row['mshh'] ?>">
            <input type="hidden" name="sodondh" value="<?php echo $row['sodondh'] ?>">
            <td class="text-center"><input class="btn btn-success" type="submit" name="submit" value="Cập nhập"></td>
          </form>
        </tr>
      <?php
      }
      ?>

    </tbody>
  </table>
</div>