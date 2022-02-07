<?php
    if(isset($_POST['submit'])){

        // insert khách hàng
        $hotenkh = $_POST['hotenkh'];
        $email = $_POST['email'];
        $congty = $_POST['congty'];
        $sodienthoai = $_POST['sodienthoai'];
        $diachi = $_POST['diachi'];
        $sql_kh = "insert into khachhang(hotenkh, tencongty, sodienthoai, email) values('$hotenkh', '$congty', '$sodienthoai', '$email')";
        $query_kh = mysqli_query($conn, $sql_kh);

        //insert địa chỉ khách hàng
        $sql_mskh = "select * from khachhang order by mskh desc limit 1";
        $query_kh = mysqli_query($conn, $sql_mskh);
        $row = mysqli_fetch_assoc($query_kh);
        $mskh = $row['mskh'];
        $diachi = "insert into diachikh(diachi, mskh) values('$diachi', '$mskh')";
        $query_kh = mysqli_query($conn, $diachi);

        //insert đơn hàng
        $sql_donhang = "insert into dathang(mskh, msnv, ngaydh, ngaygh, trangthai) values ('$mskh', 2, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP(), 0)";
        $query_donhang = mysqli_query($conn, $sql_donhang);

        //insert chi tiết đặt hàng
        $sql_dh = "select * from dathang order by sodondh desc limit 1";
        $query_dh = mysqli_query($conn, $sql_dh);
        $row_dh = mysqli_fetch_assoc($query_dh);
        $sodondh = $row_dh['sodondh'];
        //sort($_SESSION['giohang']);
        //print_r($_SESSION);
        foreach ($_SESSION['giohang'] as $mshh => $soluong) {
            $quanlity = $_SESSION['giohang'][$mshh];
            $sql_hh = "select * from hanghoa where mshh = '$mshh'";
            $query_hh = mysqli_query($conn, $sql_hh);
            $row_hh = mysqli_fetch_assoc($query_hh);
            $gia = $row_hh['gia'];
            $sql_ct = "insert into chitietdathang(sodondh, mshh, soluong, giadathang, giamgia) values('$sodondh', '$mshh', '$quanlity', '$gia', 0)";
            $query_donhang = mysqli_query($conn, $sql_ct);
        }
        session_destroy();
        header("location: ./index.php?page=success");
    }
?>

<section class="content container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">TRANG CHỦ</a></li>
            <li class="breadcrumb-item active" aria-current="page">ĐẶT HÀNG</li>
        </ol>
    </nav>
    <div class="container shadow-lg p-3 mb-5 bg-white rounded" style="min-height: 400px;">
        <div class="content-header">
            <h4 class="text-success">GIỎ HÀNG CỦA BẠN</h4>
            <div><?php if (isset($_SESSION['giohang'])) echo count($_SESSION['giohang']);
                    else echo 0; ?> SẢN PHẨM</div>
        </div>
        <?php
        if (isset($_SESSION['giohang'])) {
            if (isset($_POST['submit']) && isset($_POST['soluong'])) {
                foreach ($_POST['soluong'] as $mshh => $soluong) {
                    $_SESSION['giohang'][$mshh] = $soluong;
                }
            }
            $mshh_array = array();
            foreach ($_SESSION['giohang'] as $mshh => $soluong) {
                $mshh_array[] = $mshh;
            }
            $mshh_giohang = implode(',', $mshh_array);
            $sql = "select * from hanghoa where mshh in ($mshh_giohang) order by mshh desc";
            $query = mysqli_query($conn, $sql);
            if (count($mshh_array) > 0) {


        ?>
                <table class="table mt-5">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Số tiền</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $tongtien = 0;

                        while ($row = mysqli_fetch_array($query)) {
                            $tien = $row['gia'] * $_SESSION['giohang'][$row['mshh']];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $i ?></th>
                                <td><img src="../img/<?php echo $row['hinhanh'] ?>" alt="<?php echo $row['tenhh'] ?>" width="100px"></td>
                                <td><?php echo $row['tenhh'] ?></td>
                                <td><?php echo number_format($row['gia']) . ' VNĐ' ?></td>
                                <td class="text-center"><?php echo $_SESSION['giohang'][$row['mshh']] ?></td>
                                <td><?php echo number_format($tien) . ' VNĐ' ?></td>

                            </tr>
                        <?php
                            $i++;
                            $tongtien += $tien;
                        }

                        ?>

                    </tbody>
                </table>
                <hr>
                <form action="" method="post">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h5>THÔNG TIN CỦA BẠN</h5>

                                <div class="form-group">
                                    <label for="name">Họ tên:</label>
                                    <input type="text" class="form-control" id="name" name="hotenkh" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail4">Email:</label>
                                    <input type="email" class="form-control" id="inputEmail4" name="email" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="company">Tên công ty:</label>
                                        <input type="text" class="form-control" id="company" name="congty" required>
                                    </div>
                                    <div class="form-group col">
                                        <label for="phone">Số điện thoại:</label>
                                        <input type="text" class="form-control" id="phone" name="sodienthoai" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Địa chỉ:</label>
                                    <input type="text" class="form-control" id="inputAddress" name="diachi" required>
                                </div>
                            </div>
                            <div class="col bg-light text-dark mt-4">
                                <div class="tongtien">
                                    <h5>TỔNG TIỀN</h5>
                                    <div><?php echo number_format($tongtien) . ' VNĐ' ?></div>
                                </div>
                                <div class="tongtien">
                                    <h5>Chi phí vận chuyển</h5>
                                    <div>50,000 VNĐ</div>
                                </div>
                                <hr>
                                <div class="tongtien mb-4">
                                    <h5>THÀNH TIỀN</h5>
                                    <div><?php echo number_format($tongtien + 50000) . ' VNĐ' ?></div>
                                </div>
                                <div class="text-right">

                                    <button type="submit" name="submit" class="btn btn-success">
                                        <h4>ĐẶT HÀNG</h4>
                                    </button>
                                </div>

                            </div>

                        </div>


                    </div>
                </form>
        <?php
            } else echo '<div class = "text-center">Không có sản phẩm trong giỏ hàng</div>';
        } else echo '<div class = "text-center">Không có sản phẩm trong giỏ hàng</div>';
        ?>
</section>