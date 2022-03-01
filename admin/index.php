<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">

</head>

<body>
 <?php require_once 'conect.php';

        $sql=mysqli_query($conn,"SELECT * FROM `products` ORDER BY `products_id` DESC");

 ?>
    <div class="app">
        <div class="app-flex">
            <div class="navbar">
                <div class="navbar-heading">
                    <img src="./img/shopping-logo-svgrepo-com.svg" class="navbar-heading-logo"></img>
                    <div class="navbar-heading-text">
                        <b>SHOPPING</b> ADMIN
                    </div>
                </div>
                <div class="navbar-container">
                    <div class="navbar-container-item">
                        <a href="index.php" class="navbar-container-link">
                            <div class="navbar-container-link-icon"><i class="fal fa-search"></i></div>
                            <div class="navbar-container-link-text">Xem Sản Phẩm</div>
                        </a>
                    </div>
                    <div class="navbar-container-item">
                        <a href="add.php" class="navbar-container-link">
                            <div class="navbar-container-link-icon"><i class="fal fa-plus"></i></div>
                            <div class="navbar-container-link-text">Thêm Sản Phẩm</div>
                        </a>
                    </div>
                    <div class="navbar-container-item">
                        <a href="products.php" class="navbar-container-link">
                            <div class="navbar-container-link-icon"><i class="fal fa-wrench"></i></div>
                            <div class="navbar-container-link-text">Sửa Sản Phẩm</div>
                        </a>
                    </div>
                    <div class="navbar-container-item">
                        <a href="products.php" class="navbar-container-link">
                            <div class="navbar-container-link-icon"><i class="fal fa-trash"></i></div>
                            <div class="navbar-container-link-text">Xóa Sản Phẩm</div>
                        </a>
                    </div>
                    <div class="navbar-container-item">
                        <a href="index.php" class="navbar-container-link">
                            <div class="navbar-container-link-icon"><i class="fal fa-plus"></i></div>
                            <div class="navbar-container-link-text">Thêm Màu & Size</div>
                        </a>
                    </div>
                    <div class="navbar-container-item">
                        <a href="order.php" class="navbar-container-link">
                            <div class="navbar-container-link-icon"><i class="far fa-eye"></i></div>
                            <div class="navbar-container-link-text">Xem Đơn Hàng</div>
                        </a>
                    </div>
                    <div class="navbar-container-item">
                        <a href="advertisement.php" class="navbar-container-link">
                            <div class="navbar-container-link-icon"><i class="fal fa-plus"></i></div>
                            <div class="navbar-container-link-text">Thêm Quảng Cáo</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="container-heading">
                    <div class="container-heading-flex">
                        <div class="container-heading-text">
                            <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                            <lord-icon
                                src="https://cdn.lordicon.com/vlupvdhl.json"
                                trigger="loop"
                                colors="primary:#ffffff,secondary:#e83a30"
                                style="width:50px;height:50px">
                            </lord-icon>
                            SẢN PHẨM
                        </div>
                        <div class="container-heading-right">
                        <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                        <lord-icon
                            src="https://cdn.lordicon.com/dxjqoygy.json"
                            trigger="loop"
                            colors="primary:#e86830,secondary:#ffffff"
                            style="width:50px;height:50px">
                        </lord-icon>
                            <div class="container-heading-name">Trang Của ADMIN</div>

                        </div>

                    </div>
                </div>
                <div class="container-big">
                    <div class="container-conatiner">
                        <div class="container-see">
                            <div class="container-see-big">
                                <div class="container-see-heading-id">id </div>
                                <div class="container-see-heading-name">tên </div>
                                <div class="container-see-heading-img">hình </div>
                                <div class="container-see-heading-price-last">giá Cũ</div>
                                <div class="container-see-heading-price">giá mới</div>
                                <div class="container-see-heading-quantity">số lượng </div>
                                <div class="container-see-heading-details">chi tiết</div>
                            </div>
                            <div class="container-see-products">
                                <?php while($showproduct=mysqli_fetch_assoc($sql)){ ?>
                                <div class="container-see-data">
                                    <div class="container-see-data-id"><?php echo $showproduct['products_id'];?>
                                    </div>
                                    <div class="container-see-data-name"><?php echo $showproduct['products_name'];?>
                                    </div>
                                    <div class="container-see-data-img">
                                        <img src="../uploads/<?php echo $showproduct['products_image'];?>" alt=""
                                            class="container-see-data-image">
                                    </div>
                                    <div class="container-see-data-price-last"><?php echo $showproduct['products_price_last'];?></div>
                                    <div class="container-see-data-price"><?php echo $showproduct['products_price'];?></div>
                                    <div class="container-see-data-quantity"><?php echo $showproduct['products_quantity'];?></div>
                                    <a href="addcolorsize.php?id=<?=$showproduct['products_id']?>" class="container-see-data-details"><i class="fal fa-plus"></i></a>
                                </div>
                                <?php } ?>
                        

                            </div>
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>
</body>

</html>