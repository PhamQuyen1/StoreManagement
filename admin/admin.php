<?php
    $sql_order = "select * from dathang";
    $select_order = mysqli_query($conn, $sql_order);
    $count_order = mysqli_num_rows($select_order);
    $sql_sales = "select sum(giadathang*soluong) as sum from chitietdathang";
    $select_sales = mysqli_query($conn, $sql_sales);
    $row_sales = mysqli_fetch_assoc($select_sales);
    $sum_sales = $row_sales['sum'];
    $sql_customer = "select * from khachhang";
    $select_customer = mysqli_query($conn, $sql_customer);
    $count_customer = mysqli_num_rows($select_customer);
    $sql_employee = "select * from nhanvien";
    $select_employee = mysqli_query($conn, $sql_employee);
    $count_employee = mysqli_num_rows($select_employee);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="row pt-md-3 mb-2">
                <div class="col-xl-3 col-sm-6 p-2 ">
                    <div class="card card-common bg-light">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fas fa-shopping-cart fa-3x text-info"></i>
                                <div class="text-right text-dark">
                                    <h5>Đơn hàng</h5>
                                    <h3><?php echo $count_order?></h3>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-xl-3 col-sm-6 p-2">
                    <div class="card card-common bg-light">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fas fa-money-bill-alt fa-3x text-success"></i>
                                <div class="text-right text-dark">
                                    <h5>Doanh thu</h5>
                                    <h3><?php echo number_format($sum_sales).' vnđ'?> </h3>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-xl-3 col-sm-6 p-2">
                    <div class="card card-common bg-light">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fas fa-users fa-3x text-warning"></i>
                                <div class="text-right text-dark">
                                    <h5>Khách hàng</h5>
                                    <h3><?php echo $count_customer ?></h3>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-xl-3 col-sm-6 p-2">
                    <div class="card card-common bg-light">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fas fa-users fa-3x text-success"></i>
                                <div class="text-right text-dark">
                                    <h5>Nhân viên</h5>
                                    <h3><?php echo $count_employee ?></h3>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row p-2">
    <div class="col ">
        <h4 class="text-success text-center">Sản phẩm bán chạy</h4>
        <table class="table table-hover table-dark ">
            <thead>
                <tr>
                    <th class="text-center" scope="col">STT</th>
                    <th scope="col">Tên Sản phẩm</th>
                    <th class="text-center" scope="col">Số lượng bán</th>
                    <th class="text-center" scope="col">Tổng tiền(VNĐ)</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql = "select ct.mshh, sum(soluong) as soluong, hh.tenhh, sum(soluong) * ct.giadathang as tongtien 
                from chitietdathang ct join hanghoa hh on hh.mshh = ct.mshh group by ct.mshh ORDER BY tongtien DESC limit 10";
                $query = mysqli_query($conn, $sql);
                
                $i = 1;
                while($row = mysqli_fetch_array($query)){
            ?>
                <tr>
                    <th class="text-center" scope="row"><?php echo $i ?></th>
                    <td><?php echo $row['tenhh'] ?></td>
                    <td class="text-center"><?php echo $row['soluong'] ?></td>
                    <td class="text-center"><?php echo number_format($row['tongtien']).' VNĐ' ?></td>
                </tr>
            <?php
                $i++;
                }
            ?>
               
            </tbody>
        </table>
    </div>
    <div class="col">
        <h4 class="text-success text-center">Top Khách hàng</h4>
        <table class="table table-hover table-white">
            <thead>
                <tr>
                    <th class="text-center" scope="col">STT</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col">SĐT</th>
                    <th scope="col">Tổng tiền đã mua(VNĐ)</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql_topkhachhang = "select kh.hotenkh, kh.sodienthoai, sum(ct.soluong * ct.giadathang) as tongtien 
            from khachhang kh join dathang dh on kh.mskh = dh.mskh join chitietdathang ct on ct.sodondh =dh.sodondh 
            group by kh.mskh, kh.hotenkh ORDER BY tongtien DESC limit 10";
                $query_topkhachhang = mysqli_query($conn, $sql_topkhachhang);
                
                $i = 1;
                while($row_topkhachhang = mysqli_fetch_array($query_topkhachhang)){
            ?>
                <tr>
                    <th class="text-center" scope="row"><?php echo $i ?></th>
                    <td><?php echo $row_topkhachhang['hotenkh'] ?></td>
                    <td><?php echo $row_topkhachhang['sodienthoai'] ?></td>
                    <td><?php echo number_format($row_topkhachhang['tongtien']).' VNĐ' ?></td>
                </tr>
            <?php
            $i++;
                }
            ?>    
            </tbody>
        </table>
    </div>
</div>