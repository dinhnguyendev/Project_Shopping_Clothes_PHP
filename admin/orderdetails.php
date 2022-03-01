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
         if(isset($_POST['confirm-order'])){
            if(isset($_GET['id'])){
                $id=$_GET['id'];
            }
            $idupdate=$_POST['idupdate'];
            $colorupdate=$_POST['colorupdate'];
            $sizeupdate=$_POST['sizeupdate'];
            $quantityupdate=$_POST['quantityupdate'];
            // var_dump($idupdate);
            // var_dump($colorupdate);
            // var_dump($sizeupdate);
            // var_dump($quantityupdate);
            $updates = [];
            for ($i =0; $i< sizeof($idupdate);$i++){
                $update = [$idupdate[$i],
                $colorupdate[$i],
                $sizeupdate[$i],
                $quantityupdate[$i]];
                array_push($updates, $update);
            }
            var_dump(json_encode($updates));
            for($i=0;$i<sizeof($updates);$i++){
                $updateid=$updates[$i][0];
                $updatecolor=$updates[$i][1];
                $updatesize=$updates[$i][2];
                $updatequantity=$updates[$i][3];
                // var_dump($updateid);
                // var_dump($updatecolor);
                // var_dump($updatesize);
                // var_dump($updatequantity);
                $sqlproductsdetails=mysqli_query($conn,"SELECT * FROM `products_details` WHERE `products_id`=$updateid AND 
                `color_id`=$updatecolor AND `size_id`=$updatesize");
                while($productsdetails=mysqli_fetch_assoc($sqlproductsdetails)){
                    $numprdetails=$productsdetails['products_details_quantity'];
                }
                $numberupdate=$numprdetails-$updatequantity;
                var_dump($numberupdate);
                $sqlupdatesproductsdetails=mysqli_query($conn,"UPDATE `products_details` SET `products_details_quantity`='$numberupdate'
                WHERE `products_id`=$updateid AND `color_id`=$updatecolor AND `size_id`=$updatesize");
                //lay so luong ben bang products
                $sqlproducts=mysqli_query($conn,"SELECT * FROM `products` WHERE `products_id`=$updateid");
                while($numberpro=mysqli_fetch_assoc($sqlproducts)){
                    $numberproducts=$numberpro['products_quantity'];
                }
                $quantityproducts=$numberproducts-$updatequantity;
                $sqlupdatenumber=mysqli_query($conn,"UPDATE `products` SET `products_quantity`='$quantityproducts' WHERE `products_id`=$updateid");

            }
           
            
            $status=2;
            $sqlupdate=mysqli_query($conn,"UPDATE `orders` SET `orders_stattus`='$status' WHERE `orders_id`=$id");
            if($sqlupdate){
                $sqlnotifi=mysqli_query($conn,"SELECT * FROM `orders` INNER JOIN orders_details ON orders.orders_id=orders_details.orders_id 
                INNER JOIN products ON products.products_id=orders_details.products_id WHERE orders.orders_id=$id");
                while($shownoti=mysqli_fetch_assoc($sqlnotifi)){
                    
                    $notiphone=$shownoti['customers_phone'];
                    $notiimage=$shownoti['products_image'];
                }
                // var_dump($notiphone);
                // var_dump($notiimage);
                $title="Đơn hàng đã được xác nhận";
                $names="Bạn vừa có một đơn hàng xác nhận thành công .Chú ý thời gian giao hàng bạn nhé :)))";
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $datetime = date('H:i:s d-m-Y');
                $insertnoti=mysqli_query($conn,"INSERT INTO `notification`(`customers_phone`, `notification_img`, `notification_title`, `notification_name`, `notification_date_start`) 
                VALUES ('$notiphone','$notiimage','$title','$names','$datetime')");
                header('Location:order.php');
            }
        }elseif(isset($_POST['confirm-logistics'])){
            if(isset($_GET['id'])){
                $id=$_GET['id'];
            }
            $statuslogistics=3;
            $sqlupdate=mysqli_query($conn,"UPDATE `orders` SET `orders_stattus`='$statuslogistics' WHERE `orders_id`=$id");
            if($sqlupdate){
                $sqlnotifi=mysqli_query($conn,"SELECT * FROM `orders` INNER JOIN orders_details ON orders.orders_id=orders_details.orders_id 
                INNER JOIN products ON products.products_id=orders_details.products_id WHERE orders.orders_id=$id");
                while($shownoti=mysqli_fetch_assoc($sqlnotifi)){
                    
                    $notiphone=$shownoti['customers_phone'];
                    $notiimage=$shownoti['products_image'];
                }
                // var_dump($notiphone);
                // var_dump($notiimage);
                $title="Đơn hàng đang được giao";
                $names="Bạn vừa có một đơn hàng Đang giao .Chú ý thời gian nhận hàng bạn nhé :)))";
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $datetime = date('H:i:s d-m-Y');
                $insertnoti=mysqli_query($conn,"INSERT INTO `notification`(`customers_phone`, `notification_img`, `notification_title`, `notification_name`, `notification_date_start`) 
                VALUES ('$notiphone','$notiimage','$title','$names','$datetime')");
                header('Location:order.php');
            }
        }
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $sql=mysqli_query($conn,"SELECT * FROM `orders` WHERE `orders_id`=$id");
            $sqldetails=mysqli_query($conn,"SELECT * FROM `orders_details` INNER JOIN products ON orders_details.products_id=products.products_id
            INNER JOIN size ON orders_details.size_id=size.size_id
            INNER JOIN color ON orders_details.color_id=color.color_id
            INNER JOIN orders ON orders_details.orders_id=orders.orders_id WHERE orders_details.orders_id=$id");
        }
        
       
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
                            CHI TIẾT ĐƠN HÀNG
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
                    <div class="order-details">
                        <div class="order-heading-1">Mã Đơn</div>
                        <div class="order-heading-1">Tài khoản</div>
                        <div class="order-heading-1">Tên Nhận Hàng</div>
                        <div class="order-heading-1">SĐT nhận hàng</div>
                        <div class="order-heading-1">Tổng tiền hàng</div>
                        <div class="order-heading-1">Ngày Đặt hàng</div>
                        <div class="order-heading-1">Trạng thái</div>
                        <div class="order-heading-1">Thao tác</div>
                    </div>
                    <div class="order-details-container-products">
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
                                <div class="order-heading-2"><b><?=number_format($showorder['orders_total'],"3",".",",") ?>đ</b></div>
                            </div>
                            <div class="order-container-item">
                                <div class="order-heading-2"><?php echo $showorder['orders_date_placed']; ?></div>
                            </div>
                            <div class="order-container-item">
                                <div class="order-heading-2"><b>
                                    <?php 
                                        if($showorder['orders_stattus']=="1"){
                                            echo "Chờ Xác Nhận";
                                        }elseif($showorder['orders_stattus']=="2"){
                                            echo "Đã Xác Nhận";
                                        }elseif($showorder['orders_stattus']=="3"){
                                            echo "Đang Giao Hàng";
                                        }
                                    ?>
                                </b></div>
                            </div>
                            <div class="order-container-item">
                                <a href="order.php" class="order-heading-2 order-heading-link"><i class="fal fa-backward"></i></a>
                            </div>
                        </div>
                        <?php $logisticss=$showorder['orders_stattus'];
                                
                        } ?>
                        
                        <form method="POST" action=""  >
                            <div class="order-details-button-order">
                                <?php if($logisticss=="1") { ?>
                                    <button name="confirm-order" class="order-details-button-order-btn-confirm">
                                        Xác nhận đơn hàng
                                    </button>
                                <?php }else { ?>
                                    <div  class="order-details-button-order-btn-confirm--error">
                                        Xác nhận đơn hàng
                                    </div>
                                <?php }?>

                                <?php if($logisticss=="2") { ?>
                                    <button name="confirm-logistics" class="order-details-button-order-btn-confirm">
                                         Xác nhận Giao hàng
                                    </button>
                                <?php }else{ ?>
                                    <div class="order-details-button-order-btn-confirm--error">
                                        Xác nhận Giao hàng
                                    </div>
                                <?php } ?>
                            </div>
                       
                        <div class="order-conatiner-content">
                            <div class="order-conatiner-content-item">

                            </div>
                        </div>
                        <div class="order-details-show">
                            <div class="order-details-show-item">
                                <div class="order-details-show-item-1">Mã hàng</div>
                                <div class="order-details-show-item-2">tên hàng</div>
                                <div class="order-details-show-item-1">màu sắc</div>
                                <div class="order-details-show-item-1">size</div>
                                <div class="order-details-show-item-1">số lượng</div>
                                <div class="order-details-show-item-1">đơn giá</div>
                                <div class="order-details-show-item-1">Thành tiền</div>
                            </div>
                            <?php while($showorderdetails=mysqli_fetch_assoc($sqldetails)){ ?>
                            <div class="order-details-show-item-data">
                                <div class="order-details-show-item-3"><?php echo $showorderdetails['products_id']; ?></div>
                                <div class="order-details-show-item-4"><?php echo $showorderdetails['products_name']; ?></div>
                                <div class="order-details-show-item-3"><?php echo $showorderdetails['color_name']; ?></div>
                                <div class="order-details-show-item-3"><?php echo $showorderdetails['size_name']; ?></div>
                                <div class="order-details-show-item-3"><?php echo $showorderdetails['orders_details_quantity']; ?></div>
                                <div class="order-details-show-item-3"><?=number_format($showorderdetails['orders_details_price'],"3",".",",") ?>đ</div>
                                <div class="order-details-show-item-3"><?=number_format($showorderdetails['orders_details_quantity']*$showorderdetails['orders_details_price'],"3",".",",") ?>đ</div>
                            </div>
                            <input type="hidden" value="<?php echo $showorderdetails['products_id']; ?>" name="idupdate[]" >
                            <input type="hidden" value="<?php echo $showorderdetails['color_id']; ?>" name="colorupdate[]">
                            <input type="hidden" value="<?php echo $showorderdetails['size_id']; ?>" name="sizeupdate[]">
                            <input type="hidden" value="<?php echo $showorderdetails['orders_details_quantity']; ?>" name="quantityupdate[]">
                            
                            <?php  
                            
                                $address= $showorderdetails['orders_address']; ?>
                            <?php } ?>
                            <div class="order-address">
                                <div class="order-address-item">
                                    <div class="order-address-heading">Địa chỉ nhận Hàng:</div>
                                    <div class="order-address-text"><?php echo $address; ?></div>
                                </div>

                            </div>
                            
                            
                        </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>