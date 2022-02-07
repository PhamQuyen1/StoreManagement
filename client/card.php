<?php
    
    if(isset($_GET['mshh'])){
        $xoa_mshh = $_GET['mshh'];
        unset($_SESSION['giohang'][$xoa_mshh]);
        header("location: ./index.php?page=card");
    }
?>

<section class="content container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">TRANG CHỦ</a></li>
            <li class="breadcrumb-item active" aria-current="page">GIỎ HÀNG</li>
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
            if (isset($_POST['submit']) && isset($_POST['soluong'])){
                foreach($_POST['soluong'] as $mshh=> $soluong){
                    $sql_soluong = "select * from hanghoa where mshh = '$mshh'";
                    $query_soluong = mysqli_query($conn, $sql_soluong);
                    $row_soluong = mysqli_fetch_assoc($query_soluong);
                    $db_soluong = $row_soluong['soluonghang'];
                    if($db_soluong >= $soluong)
                        $_SESSION['giohang'][$mshh] = $soluong;
                    else echo "<script type='text/javascript'>alert('Số lượng quá lơn');</script>";
                }
            }
            $mshh_array = array();
            foreach ($_SESSION['giohang'] as $mshh => $soluong) {
                $mshh_array[] = $mshh;
            }
            $mshh_giohang = implode(',', $mshh_array);
            $sql = "select * from hanghoa where mshh in ($mshh_giohang) order by mshh desc";
            $query = mysqli_query($conn, $sql);
            if(count($mshh_array) > 0){
            

        ?>
            <form action="" method="post">
                <table class="table mt-5">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Số tiền</th>
                            <th scope="col">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $tongtien = 0;
                        
                        while ($row = mysqli_fetch_array($query)) {
                            $tien = $row['gia']*$_SESSION['giohang'][$row['mshh']];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $i ?></th>
                                <td><img src="../img/<?php echo $row['hinhanh'] ?>" alt="<?php echo $row['tenhh'] ?>" width="100px"></td>
                                <td><?php echo $row['tenhh'] ?></td>
                                <td><?php echo number_format($row['gia']) . ' VNĐ' ?></td>
                                <td><input type="number" name="soluong[<?php echo $row['mshh'] ?>]" id="soluong" min="1" value="<?php echo $_SESSION['giohang'][$row['mshh']] ?>" width="50%"></td>
                                <td><?php echo number_format($tien) . ' VNĐ' ?></td>
                                <td><a class="btn btn-danger" href="./index.php?page=card&mshh=<?php echo $row['mshh'] ?>">Xóa</a></td>
                            </tr>
                        <?php
                        $i++;
                        $tongtien += $tien;
                        }
                    
                        ?>
                        
                    </tbody>
                </table>
                <div class="text-center">
                    <button class="btn btn-success" name = "submit" type="submit">CẬP NHẬP GIỎ HÀNG</button>
                </div>

            </form>

            <hr>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <a href="./index.php?page=product">>>Tiếp tục mua hàng </a>
                    </div>
                    <div class="col bg-light text-dark">
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
                            <a href="./index.php?page=checkout" type="button" class="btn btn-success">
                                <h4>THANH TOÁN</h4>
                            </a>
                        </div>

                    </div>

                </div>


            </div>
        <?php
                        }else echo '<div class = "text-center">Không có sản phẩm trong giỏ hàng</div>';
        } else echo '<div class = "text-center">Không có sản phẩm trong giỏ hàng</div>';
        ?>
</section>