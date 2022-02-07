<div class="container-fluid bg-light">
    <div class="row">
        <div class="col p-0">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../img/slide1.jpg" class="d-block w-100 img-fluid slidebar" alt="slide1">
                    </div>
                    <div class="carousel-item">
                        <img src="../img/slide2.jpg" class="d-block w-100 img-fluid slidebar" alt="slide2">
                    </div>
                    <div class="carousel-item">
                        <img src="../img/slide3.jpg" class="d-block w-100 img-fluid slidebar" alt="slide3">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
<section class="product">
    <div class="title-product">
        SẢN PHẨM MỚI
    </div>
    <div class="container shadow-lg p-3 mb-5 bg-white rounded">

        <div class="row row-cols-1 row-cols-md-4">
            <?php
            $sql = "select * from hanghoa ORDER BY mshh DESC limit 8";
            $query = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($query)){
            ?>
            <div class="col mb-4">
                <div class="card" style="height: 482px;">
                    <img src="../img/<?php echo $row['hinhanh'] ?>" class="card-img-top" alt="<?php echo $row['tenhh'] ?>">
                    <div class="card-body">
                        <h5 class="card-title text-success text-center" style="height: 44px;"><?php echo $row['tenhh'] ?></h5>
                        <span class="card-price"><?php echo number_format($row['gia']).' VNĐ'?></span>

                        <a href="./addcard.php?mshh=<?php echo $row['mshh'] ?>" class="btn btn-danger d-flex justify-content-center">Thêm vào Giỏ hàng</a>
                        <a href="./index.php?page=detail&mshh=<?php echo $row['mshh'] ?>" class="btn btn-primary d-flex justify-content-center mt-3">Thông tin chi tiết</a>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
            
        </div>
    </div>
</section>