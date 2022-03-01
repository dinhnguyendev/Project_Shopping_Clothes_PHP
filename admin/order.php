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

        $sql=mysqli_query($conn,"SELECT * FROM `orders` ");

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
                            ĐƠN HÀNG
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
                <div class="order-container">
                    <div class="order-big">
                        <div class="order-heading-1">Mã Đơn</div>
                        <div class="order-heading-1">Tài khoản</div>
                        <div class="order-heading-1">Tên Nhận Hàng</div>
                        <div class="order-heading-1">SĐT nhận hàng</div>
                        <div class="order-heading-1">Tổng tiền hàng</div>
                        <div class="order-heading-1">Ngày Đặt hàng</div>
                        <div class="order-heading-1">Trạng Thái</div>
                        <div class="order-heading-1">Thao tác</div>
                    </div>
                    <div class="order-container-products">
                        <?php while($showorder=mysqli_fetch_assoc($sql)){ ?>
                        <div class="order-conatiner-prodycts-items">
                            <div class="order-container-item">
                                <div class="order-heading-2"><?php echo $showorder['orders_id']; ?></div>

                            </div>
                            <div class="order-container-item">
                                <div class="order-heading-2"><?php echo $showorder['customers_phone']; ?></div>
                            </div>
                            <div class="order-container-item">
                                <div class="order-heading-2"><?php echo $showorder['customers_name']; ?></div>
                            </div>
                            <div class="order-container-item">
                                <div class="order-heading-2"><?php echo $showorder['orders_phone']; ?></div>
                            </div>
                            <div class="order-container-item">
                                <div class="order-heading-2"><b><?=number_format($showorder['orders_total'],"3",".",",") ?></b>đ</div>
                            </div>
                            <div class="order-container-item">
                                <div class="order-heading-2"><?php echo $showorder['orders_date_placed']; ?></div>
                            </div>
                            <div class="order-container-item">
                                <div class="order-heading-2">
                                    <?php 
                                        
                                        if($showorder['orders_stattus']=="1"){
                                            echo "Chờ Xác Nhận";
                                        }elseif($showorder['orders_stattus']=="2"){
                                            echo "<i>Đã Xác Nhận</i>";
                                        }elseif($showorder['orders_stattus']=="3"){
                                            echo "<b>Đang Giao Hàng</b>";
                                        }
                                
                                    ?>
                                </div>
                            </div>
                            <div class="order-container-item">
                                <a href="orderdetails.php?id=<?php echo  $showorder['orders_id']; ?>" class="order-heading-2 order-heading-link"><i class="far fa-eye"></i></a>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>