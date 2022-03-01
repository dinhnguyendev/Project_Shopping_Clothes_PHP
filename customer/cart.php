<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <script src='https://cdn.jsdelivr.net/gh/vietblogdao/js/districts.min.js'></script>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/base.css">

    <title>Shopping</title>
    <style>

    </style>
</head>

<body>
    <?php   
            require_once "conect.php";
            session_start();
           
            if(isset($_SESSION['customer'])){
                $customer=$_SESSION['customer'];
                // var_dump($customer);
                $address=$customer['customers_phone'];
            }else{
                header('Location:login.php');
                exit;
            }
            if(!isset($_SESSION["cart"])){
                $_SESSION["cart"]=array();
                //tao mot session
                // unset($_SESSION["cart"]);exit;
            }
            if(isset($_GET['action'])){
                switch($_GET['action']){
                    case "add":
                        
                        // Lay gia tri ve
                        $id=$_POST['id'];
                        $img=$_POST['image'];
                        $namesp=$_POST['namesp'];
                        $color=$_POST['color'];
                        $size=$_POST['size'];
                        $price=$_POST['price'];
                        $pricelast=$_POST['pricelast'];
                        $quantity=$_POST['quantity'];

                       


                        //co
                        $flag=0;
                        //kiem tra co id trung vs id sp truoc do hay khong
                        for($i=0;$i<sizeof($_SESSION["cart"]);$i++){
                            if($_SESSION["cart"][$i][0]==$id && $_SESSION["cart"][$i][3]==$color && $_SESSION["cart"][$i][4]==$size){
                                $newquantity=$quantity+$_SESSION["cart"][$i][7];
                                $_SESSION["cart"][$i][7]=$newquantity;
                                $flag=1;
                                break;
                            }
                        }
                        //neu khong co thi them do
                        if($flag==0){
                            $product=[$id,$img,$namesp,$color,$size,$price,$pricelast,$quantity];
                            $_SESSION["cart"][]=$product;
                        }
                        if(isset($_POST['submit'])){
                            header('Location:cart.php');
                        }else if(isset($_POST['addsubmit'])){
                            header("location:javascript://history.go(-1)");
                        }
                        
                    break;
                    case "delete":
                        if(isset($_GET['deleteid'])){
                            array_splice($_SESSION["cart"],$_GET['deleteid'],1);
                        
                        }
                        header('Location:cart.php');
                    break;
                    case "errors":
                        echo "<script>alert('Lỗi:Số lượng còn lại không đủ bạn yêu cầu!');</script>" ;
                        
                    break;
                    
                    
                        
                }

                  
                
            }
            if(isset($_POST['addressadd'])){
                if(isset($_POST['address-name'])){
                    $addressname=$_POST['address-name'];
                }
                if(isset($_POST['address-phone'])){
                    $addressphone=$_POST['address-phone'];
                }
                if(isset($_POST['address-city'])){
                    $addresscity=$_POST['address-city'];
                }
                if(isset($_POST['address-district'])){
                    $addressdistrict=$_POST['address-district'];
                }
                if(isset($_POST['address-district-details'])){
                    $addressdistrictdetails=$_POST['address-district-details'];
                }
                if(isset($_SESSION['customer'])){
                    $customer=$_SESSION['customer'];
                    // var_dump($customer);
                    $address=$customer['customers_phone'];
                }
                
                // var_dump($address);
                // var_dump($addressphone);
                // var_dump($addresscity);
                // var_dump($addressdistrict);
                // var_dump($addressdistrictdetails);

                $sql=mysqli_query($conn,"INSERT INTO `addresses`(`customers_phone`, `addresses_name_customer`, `addresses_phone`, `addresses_name`) 
                VALUES ('$address','$addressname','$addressphone','$addresscity , $addressdistrict , $addressdistrictdetails')");
                header('Location:cart.php');
            }
            if(isset($_SESSION['customer'])){
                $customer=$_SESSION['customer'];
                // var_dump($customer);
                $address=$customer['customers_phone'];
                $queryaddress=mysqli_query($conn,"SELECT * FROM `addresses` WHERE `customers_phone`=$address");
                $querynotication=mysqli_query($conn,"SELECT * FROM `notification` WHERE `customers_phone`=$address ORDER BY `notification_id` DESC");
                $querycustomer=mysqli_query($conn,"SELECT `customers_avatar` FROM `customers` WHERE `customers_phone`=$address");
                $showavatar=mysqli_fetch_assoc($querycustomer);
            }
            
        
                
        
            
           


     ?>
     
    
    <div class="app">
        <div class="header-cart">
            <div class="header-cart-navigation-1">
                <div class="grid-header">
                    <div class="header-navbar">
                        <ul class="header-navbar-list">
                            <li class="header-navbar-list-item">
                                <a href="index.php" class="header-navbar-list-link header-navbar-list-link-not-bold">
                                    Trang Chủ
                                </a>
                            </li>
                            <li class="header-navbar-list-item">
                                <a href="" class="header-navbar-list-link header-navbar-list-link-not-bold">
                                    Giới Thiệu
                                </a>
                            </li>
                        </ul>
                        <ul class="header-navbar-list">
                            <li class="header-navbar-list-notification">
                                <div class="header-navbar-list-notification-flex">
                                    <div class="header-navbar-list-notification-link-hover">
                                        <a href="notification.php" class="header-navbar-list-notification-link">
                                            <div class="header-navbar-list-notification-icon"><i
                                                    class="fal fa-bells"></i>
                                            </div>
                                            <div class="header-navbar-list-notification-text">Thông báo</div>
                                        </a>

                                        <ul class="header-navbar-list-notification-list">
                                            <div class="header-navbar-list-notification-list-padding">
                                                <div class="header-navbar-list-notification-heading">Thông Báo Mới Nhận
                                                </div>
                                                <?php $dem=0;
                                            while($shownoti=mysqli_fetch_assoc($querynotication)){ ?>
                                            <li class="header-navbar-list-notification-list-item">
                                                <div class="header-navbar-list-notification-list-item-image">
                                                    <img src="../uploads/<?php echo $shownoti['notification_img'] ;?>"
                                                        alt="" class="header-navbar-list-notification-list-item-img">
                                                </div>
                                                <div class="header-navbar-list-notification-list-item-text">
                                                    <div class="header-navbar-list-notification-list-item-text-heading">
                                                        <?php echo $shownoti['notification_title'] ;?>

                                                    </div>
                                                    <div
                                                        class="header-navbar-list-notification-list-item-text-container">
                                                        <?php echo $shownoti['notification_name'] ;?>
                                                    </div>
                                                    <?php echo $shownoti['notification_date_start'] ;?>
                                                </div>
                                            </li>
                                                <?php  $dem=$dem+1; 
                                                    if($dem==5){
                                                        break;
                                                    }
                                                } ?>
                                                <a href="notification.php" class="header-navbar-list-notification-link-user">
                                                    <li class="header-navbar-list-notification-link-user-item">Xem tất
                                                        cả
                                                    </li>
                                                </a>
                                            </div>

                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="header-navbar-list-help">
                                <div class="header-navbar-list-help-flex">
                                    <a href="" class="header-navbar-list-help-link">
                                        <div class="header-navbar-list-help-icon">
                                            <i class="fal fa-question-circle"></i>
                                        </div>
                                        <div class="header-navbar-list-help-text">
                                            Hỗ Trợ
                                        </div>
                                    </a>
                                </div>
                            </li>

                            <?php if(isset($customer)){ ?>
                        
                            <li class="header-navbar-list-item header-navbar-list-item-user">
                                <?php if(!empty($showavatar['customers_avatar'])){ ?>
                                    <img src="uploads/<?php echo $showavatar['customers_avatar'] ;?>" alt=""
                                        class="header-navbar-user-img">
                                <?php } else{ ?>
                                    <img src="./img/avatar.png" alt=""
                                        class="header-navbar-user-img">
                                <?php } ?>
                                <span class="header-navbar-user-name"><?php echo $customer['customers_name'];?></span>
                                <ul class="header-navbar-user-list">
                                    <a href="account.php" class="header-navbar-user-link">
                                        <li class="header-bavber-user-list-item-myuser">Tài Khoản Của Tôi</li>
                                    </a>
                                    <a href="order.php" class="header-navbar-user-link">
                                        <li class="header-bavber-user-list-item-myuser-user">Đơn Mua</li>
                                    </a>
                                    <a href="logout.php" class="header-navbar-user-link">
                                        <li class="header-bavber-user-list-item-myuser-logout">Đăng Xuất</li>
                                    </a>
                                </ul>
                            </li>

                        <?php }  ?>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="header-cart-navigation-2">
                <div class="grid-header">
                    <div class="header-with-search-cart-details-margin">
                        <div class="header-with-cart-details">
                            <a href="index.php" class="header-link-home">
                                <div class="header-with-logo-cart">
                                    <div class="header-with-logo-img-cart">
                                        <div class="header-with-logo-img-img">
                                            <img src="./img/shopping-logo-svgrepo-com.svg"
                                                class="header-with-logo-img-svg"">
                
                                    </div>
                                    <div class=" header-with-logo-img-text-cart">
                                            <b>SHOPPING</b>
                                        </div>
                                    </div>
                                    <div class="header-with-logo-cart-item">
                                        <div class="header-with-logo-cart-text">Giỏ hàng</div>
                                    </div>

                                </div>
                            </a>

                            <div class="header-with-search-cart-details">
                                <div class="header-width-search-flex">
                                    <input type="text" class="header-with-search-input"
                                        placeholder="Nhập để tìm kiếm sản phẩm">
                                    <button class="header-with-search-btn-cart">
                                        <i class="header-with-search-btn-icon fal fa-search"></i>
                                    </button>
                                    <div class="header-width-search-history">
                                        <h5 class="header-width-search-history-text">Lịch Sử Tìm Kiếm</h5>
                                        <ul class="header-width-search-history-link">
                                            <li class="header-width-search-history-link-item">
                                                <a href="">aaaaaaa</a>
                                            </li>
                                            <li class="header-width-search-history-link-item">
                                                <a href="">bbbb</a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>

        </div>



    
    <?php //kiem tra gio hang co rong hay khong
            if(sizeof($_SESSION["cart"])>0){
    ?>



        <div class="container-cart">
<form method="POST" action="pay.php?action=submitcart" id="myform" >
            <div class="grid-header">
                <div class="container-cart-big">
                    <div class="container-cart-heading">
                        <div class="container-cart-heading-item">
                            <div class="container-cart-heading-icon"><i
                                    class="fad fa-shipping-fast container-cart-heading-icon-color"></i></div>
                            <div class="container-cart-heading-text">Nhấn vào mục Mã giảm giá ở cuối trang để hưởng miễn
                                phí vận chuyển bạn nhé!
                            </div>
                        </div>
                    </div>
                    <div class="container-pay-big">
                        <div class="container-pay-address">
                            <div class="container-pay-address-space"></div>
                                <div class="container-pay-address-fex">
                                    <div class="container-pay-address-heading">
                                        <div class="container-pay-address-heading-icon">
                                            <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                                            <lord-icon src="https://cdn.lordicon.com/zzcjjxew.json" trigger="loop"
                                                colors="primary:#e83a30,secondary:#e83a30" style="width:35px;height:40px">
                                            </lord-icon>
                                        </div>
                                        <div class="container-pay-address-heading-text">
                                            Địa chỉ nhận hàng
                                        </div>
                                    </div>
                                    <div class="container-pay-address-button-add">
                                        <div  class="container-pay-address-button-add-btn">
                                            <div class="container-pay-address-button-add-icon">
                                                <i class="fal fa-plus"></i>
                                            </div>
                                            <div class="container-pay-address-button-add-text">
                                                Thêm địa chỉ mới
                                            </div>

                                        </div>
                                    </div>

                            </div>
                            <div class="container-pay-address-list">
                                <div class="container-pay-address-list-big">
                                
                                <?php while($showaddress=mysqli_fetch_assoc($queryaddress)) { ?>
                                    <div class="container-pay-address-list-item">
                                        <div class="container-pay-address-list-input">
                                            <input type="radio" name="addressorders" checked value="<?php echo $showaddress['addresses_name_customer']; ?>;<?php echo $showaddress['addresses_phone']; ?>;<?php echo $showaddress['addresses_name']; ?>"
                                                class="container-pay-address-list-input-check">
                                        </div>
                                        <div class="container-pay-address-list-name">
                                            <div class="container-pay-address-list-name-customers">
                                                <b><?php echo $showaddress['addresses_name_customer']; ?> &nbsp; <?php echo $showaddress['addresses_phone']; ?></b>
                                                
                                            </div>
                                        </div>
                                        <div class="container-pay-address-list-address">
                                            <?php echo $showaddress['addresses_name']; ?>
                                        </div>
                                    </div>
                                <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-cart-category">
                        <div class="container-cart-category-item">
                            <div class="container-cart-category-input">
                                <input type="checkbox"  class="container-cart-category-input-check">
                            </div>
                            <div class="container-cart-category-products">
                                <div class="container-cart-category-products-item">
                                    Sản phẩm
                                </div>
                            </div>
                            <div class="container-cart-price">
                                <div class="container-cart-price-item">Đơn giá</div>
                            </div>
                            <div class="container-cart-quantity">
                                <div class="container-cart-quantity-item">
                                    Số lượng
                                </div>
                            </div>
                            <div class="container-cart-money">
                                <div class="container-cart-money-item">
                                    Số tiền
                                </div>
                            </div>
                            <div class="container-cart-operation">
                                <div class="container-cart-operation-item">
                                    Thao tác
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-cart-details">
                        <div class="container-cart-details-big">
                            <div class="container-cart-details-heading">
                                <div class="container-cart-details-heading-love">Yêu thích+</div>
                                <div class="container-cart-details-heading-icon">
                                    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/gmzxduhd.json" trigger="loop"
                                        colors="primary:#e83a30,secondary:#e83a30" style="width:25px;height:25px">
                                    </lord-icon>
                                </div>
                                <div class="container-cart-details-heading-text">Shopping</div>
                                <div class="container-cart-details-heading-chat">
                                    <i class="far fa-comment-alt-lines"></i>

                                </div>
                            </div>
                       
                            <?php 
                                    if(isset($_SESSION["cart"])){
                                            for( $i=0; $i<sizeof($_SESSION["cart"]) ; $i++){
                                                //thanh tien
                                                $total=$_SESSION["cart"][$i][5]*$_SESSION["cart"][$i][7];
                                        
                                    
                            ?>
                        
                            <div class="container-cart-details-products">
                                <div class="container-cart-details-products-input">
                                    <input type="checkbox" name="checkked[]" value="<?=$_SESSION["cart"][$i][0];?>,<?=$_SESSION["cart"][$i][3];?>,<?=$_SESSION["cart"][$i][4];?>,<?=$_SESSION["cart"][$i][7];?>"  class="container-cart-details-products-input-check">
                                </div>
                                <div class="container-cart-details-products-product">
                                    <div class="container-cart-details-products-product-big">
                                        <div class="container-cart-details-products-product-item1">
                                            <a href="" class="container-cart-details-products-link1">
                                                <div class="container-cart-details-products-image">
                                                    <img src="../uploads/<?php echo $_SESSION["cart"][$i][1]; ?>"
                                                        alt="" class="container-cart-details-products-img">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="container-cart-details-products-product-item2">
                                            <a href="" class="container-cart-details-products-link2">
                                                <div class="container-cart-details-products-text">
                                                    <?php echo $_SESSION["cart"][$i][2]; ?>
                                                </div>
                                            </a>
                                            <div class="container-cart-details-products-image-sale">
                                                <img src="https://cf.shopee.vn/file/b6a5d995ed7d4875c78a012fac73bbe2"
                                                    alt="" class="container-cart-details-products-img-sale">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-cart-details-products-classity">
                                    <div class="container-cart-details-products-classity-big">
                                        <div class="container-cart-details-products-classity-heading">
                                            <div class="container-cart-details-products-classity-item">Phân loại hàng:<i
                                                    class="fal fa-sort-down container-cart-details-products-classity-button-btn"></i>

                                            </div>

                                        </div>
                                        <div class=" container-cart-details-products-classity-text">

                                            <div class="container-cart-details-products-color"><?php echo $_SESSION["cart"][$i][3];?></div>
                                            <div class="container-cart-details-products-space">,</div>
                                            <div class="container-cart-details-products-size"><?php echo $_SESSION["cart"][$i][4];?></div>
                                            <div class="container-cart-details-products-daucham">.</div>

                                        </div>
                                        <input type="hidden" class="input-submit-color" name="colorcart[]" value="<?php echo $_SESSION["cart"][$i][3] ;?>">
                                        <input type="hidden" class="input-submit-size" name="sizecart[]" value="<?php echo $_SESSION["cart"][$i][4] ;?>">
                                      
                                    </div>
                                </div>
                                <div class="container-cart-details-products-price">
                                    <div class="container-cart-details-products-price-big">
                                        <div class="container-cart-details-products-price-last">₫<?=number_format($_SESSION["cart"][$i][6],"3",".",",") ?></div>
                                        <div class="container-cart-details-products-price-now">₫<?=number_format($_SESSION["cart"][$i][5],"3",".",",") ?></div>
                                    </div>
                                </div>
                                <div class="container-cart-details-products-number">
                                    <div class="container-details-quantity-products">


                                        <div class="container-details-quantity-number-quantity">
                                            <div class="container-details-minus" >
                                                <i class="fal fa-minus container-details-minus-btn"></i>
                                            </div>
                                           
                                                        
                                            <input type="number"  
                                                class="container-details-input-text" min="1" max="300"
                                                value="<?php echo $_SESSION["cart"][$i][7] ;?>">
                                               
                                            <div class="container-details-minus-btn-btn">
                                                <i class="fal fa-plus container-details-minus-btn"></i>
                                            </div>
                                            <input type="hidden" name="quantitycart[]" value="<?php echo $_SESSION["cart"][$i][7] ;?>">
                                        </div>


                                    </div>
                                </div>
                                <div class="container-cart-details-products-money">
                                    <div class="container-cart-details-products-money-number">
                                        ₫<?=number_format($total,"3",".",",") ?>
                                    </div>
                                </div>
                                <div class="container-cart-details-products-operation">
                                    <div class="container-cart-details-products-operation-item">
                                        <a href="cart.php?action=delete&deleteid=<?=$i;?>" class="container-cart-details-products-delete">Xóa</a>
                                    </div>
                                </div>

                            </div>
                           
                      
                            <input type="hidden" name="idcart[]" value="<?php echo $_SESSION["cart"][$i][0] ;?>">
                            
                           
                            <input type="hidden" name="imagecart[]" value="<?php echo $_SESSION["cart"][$i][1] ;?>">
                            <input type="hidden" name="namecart[]" value="<?php echo $_SESSION["cart"][$i][2] ;?>">
                            <input type="hidden" name="pricecart[]" value="<?php echo $_SESSION["cart"][$i][5] ;?>">
                            <input type="hidden" name="pricelastcart[]" value="<?php echo $_SESSION["cart"][$i][6] ;?>">
                            <!-- $product=[$id,$img,$namesp,$color,$size,$price,$pricelast,$quantity]; -->
                            
                            <?php   }} ?>
                            <div class="container-cart-details-buy-button" >
                                <button class="container-cart-details-buy-btn" name="submitadd">Cập nhật</button>
                            </div>
                       
                            <div class="container-cart-details-buy">
                                <div class="container-cart-details-buy-flex">
                                    <div class="container-cart-details-buy-flex-item1">
                                        <div class="container-cart-details-buy-input">
                                            <input type="checkbox" class="container-cart-details-buy-input-check">
                                        </div>
                                        <div class="container-cart-details-buy-list">
                                            <button class="container-cart-details-buy-list-item">Chọn tất cả
                                                (183)</button>
                                        </div>
                                        <div class="container-cart-details-buy-delete">
                                            <div href="" class="container-cart-details-buy-link">Xóa</div>
                                        </div>

                                    </div>
                                    <div class="container-cart-details-buy-flex-item2">
                                        <div class="container-cart-details-buy-sum">
                                            <div class="container-cart-details-buy-sum-text">
                                                Tổng thanh toán (0 Sản phẩm):
                                            </div>
                                            <div class="container-cart-details-buy-sum-number">
                                                ₫0
                                            </div>
                                        </div>
                                        <div class="container-cart-details-buy-button">
                                            <button class="container-cart-details-buy-btn" name="submitlink">Mua hàng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }else{ ?>
        <div class="grid-image-empty">
            <div class="cart-empty-image">
                <div class="cart-empty-big">
                    <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/cart/9bdd8040b334d31946f49e36beaf32db.png" alt="" class="cart-empty-img">

                </div>
                <div class="cart-empty-text">Giỏ hàng của bạn còn trống</div>
            </div>
        </div>

    <?php } ?>




<form method="POST" action="cart.php" >
    <div class="modal-app">
        <div class="app-pay">
            <div class="app-pay-big">
                <div class="app-pay-heading">Địa chỉ mới</div>
                <div class="app-pay-information">
                    <input type="text" name="address-name" placeholder="Họ và tên" class="app-pay-information-name" required>
                    <input type="text" name="address-phone" placeholder="Số điện thoại" class="app-pay-information-phone" required>
                </div>
                <div class="app-pay-address">
                    <div class="app-pay-address-flex">
                        <select name="calc_shipping_provinces" class="app-pay-address-city" required="">
                            <option class="app-pay-address-city-value" value="">Tỉnh/ Thành phố</option>
                        </select>
                        <select name="calc_shipping_district" class="app-pay-address-district" required="">
                            <option class="app-pay-address-district-value" value="">Quận / Huyện</option>
                        </select>

                    </div>
                    <input class="billing_address_1 " name="address-city" type="hidden" value="">
                    <input class="billing_address_2" name="address-district" type="hidden" value="">
                    <script src='./javascript/lib.js'></script>
                </div>
                <div class="app-pay-address-details">
                    <input type="text"  name="address-district-details" placeholder="Địa chỉ cụ thể" required class="app-pay-address-details-check">
                </div>
                <div class="app-pay-button">
                    <div class="app-pay-btn-back">Trở Lại</div>
                    <button  name="addressadd" class="app-pay-btn-submit">Hoàn Thành</button>
                </div>

            </div>
        </div>
    </div>

</form>




        <div class="footer-brg-text">
            <div class="hr"></div>
            <div class="grid-footer">
                <footer class="footer-text">
                    <p class="footer-text-1">
                    <h3>SHOPPING - GÌ CŨNG CÓ, MUA HẾT Ở SHOPPING</h3>
                    Shopping - ứng dụng mua sắm trực tuyến thú vị, tin cậy,
                    an toàn và miễn phí! Shopping là nền tảng giao dịch trực tuyến hàng đầu ở Đông Nam Á, Việt Nam,
                    Singapore, Malaysia, Indonesia, Thái Lan, Philipin, Đài loan và Brazil. Với sự đảm bảo của
                    Shopping, bạn sẽ mua hàng trực tuyến an tâm và nhanh chóng hơn bao giờ hết!
                    </p>
                    <p class="footer-text-2">
                    <h3>MUA SẮM VÀ BÁN HÀNG ONLINE ĐƠN GIẢN, NHANH CHÓNG VÀ AN TOÀN</h3>
                    Nếu bạn đang tìm kiếm một trang web để mua và bán hàng trực tuyến thì Shopping.vn là một sự lựa
                    chọn tuyệt vời dành cho bạn.
                    Bản chất của Shopping là một social E-commerce platform - nền tảng trang web thương mại điện tử
                    tích hợp mạng xã hội. Điều này cho phép người mua và người bán hàng dễ dàng tương tác, trao đổi
                    thông tin về sản phẩm và chương trình khuyến mãi của shop. Nhờ nền tảng đó, việc mua bán trên
                    Shopping trở nên nhanh chóng và đơn giản hơn.
                    Bạn có thể trò chuyện trực tiếp với nhà bán hàng để hỏi trực tiếp về mặt hàng cần mua.
                    </p>
                    <p class="footer-text-3">
                    <h3>MUA HÀNG HIỆU CAO CẤP GIÁ TỐT TẠI SHOPPING</h3>
                    Bên cạnh Shopping Premium, Shopping còn có rất nhiều khuyến mãi khủng cho hàng hiệu giảm đến
                    50%. Cộng với mã giao hàng miễn phí, Shopping cũng có các mã giảm giá được phân phối mỗi tháng
                    từ rất nhiều gian hàng chính hãng tham gia chương trình khuyến mãi này. Bên cạnh đó,
                    Shopping còn tập hợp rất nhiều thương hiệu đình đám được các nhà bán lẻ uy tín phân phối bán
                    trên Shopping, đem đến cho bạn sự lựa chọn đa dạng, từ các hãng mỹ phẩm nổi tiếng hàng đầu
                    </p>
                    <p class="footer-text-4">
                    <h3>MUA HÀNG CHÍNH HÃNG TỪ CÁC THƯƠNG HIỆU LỚN VỚI SHOPPING</h3>
                    Mua hàng trên Shopping luôn là một trải nghiệm ấn tượng. Dù bạn đang có nhu cầu mua bất kỳ mặt
                    hàng thời trang nam, thời trang nữ
                    Là một kênh bán hàng uy tín, Shopping luôn cam kết mang lại cho khách hàng những trải nghiệm mua
                    sắm online giá rẻ, an toàn và tin cậy. Mọi thông tin về người bán và người mua đều được bảo mật
                    tuyệt đối.
                    Các hoạt động giao dịch thanh toán tại Shopping luôn được đảm bảo diễn ra nhanh chóng, an toàn.
                    Một vấn đề nữa khiến cho các khách hàng luôn quan tâm đó chính là mua hàng trên Shopping có đảm
                    bảo không. Shopping luôn cam kết mọi sản phẩm trên Shopping,
                    đặc biệt là Shopping Mall đều là những sản phẩm chính hãng, đầy đủ tem nhãn, bảo hành từ nhà bán
                    hàng. Ngoài ra, Shopping bảo vệ người mua và người bán bằng cách giữ số tiền giao dịch đến khi
                    người mua xác nhận đồng ý với đơn hàng và không có yêu cầu khiếu nại,
                    trả hàng hay hoàn tiền nào. Thanh toán sau đó sẽ được chuyển đến cho người bán. Đến với Shopping
                    ngay hôm nay để mua hàng online giá rẻ và trải nghiệm dịch vụ chăm sóc khách hàng tuyệt vời tại
                    đây. Đặc biệt khi mua sắm trên Shopping Mall, bạn sẽ được miễn phí vận chuyển, giao hàng tận nơi
                    và 7 ngày miễn phí trả hàng. Ngoài ra,
                    khách hàng có thể sử dụng Shopping Xu để đổi lấy mã giảm giá có giá trị cao và voucher dịch vụ
                    hấp dẫn.
                    </p>
                </footer>
                <div class="hr-footer"></div>



            </div>

        </div>
        <div class="footer-brg">
            <div class="grid">
                <footer class="footer">
                    <div class="grid-column">
                        <div class="grid-row-footer">
                            <div class="grid-column-footer-2">
                                <h5 class="header-color">CHĂM SÓC KHÁCH HÀNG</h5>
                                <ul class="footer-list">
                                    <li class="footer-list-item">Trung Tâm Trợ Giúp</li>
                                    <li class="footer-list-item">Shopping Blog</li>
                                    <li class="footer-list-item">Shopping Mall</li>
                                    <li class="footer-list-item">Hướng Dẫn Mua Hàng</li>
                                    <li class="footer-list-item">Hướng Dẫn Bán Hàng</li>
                                    <li class="footer-list-item">Thanh Toán</li>
                                    <li class="footer-list-item">Shopping Xu</li>
                                    <li class="footer-list-item">Vận chuyển</li>
                                    <li class="footer-list-item">Trả Hàng & Hoàn Tiền</li>
                                    <li class="footer-list-item">Chăm Sóc Khách Hàng</li>
                                    <li class="footer-list-item">Chính Sach Bảo hành</li>
                                </ul>
                            </div>
                            <div class="grid-column-2">
                                <h5 class="header-color">VỀ SHOPPING</h5>
                                <ul class="footer-list">
                                    <li class="footer-list-item">Giới Thiệu Shopping Việt Nam</li>
                                    <li class="footer-list-item">Tuyển Dụng</li>
                                    <li class="footer-list-item">Điều Khoản Shopping</li>
                                    <li class="footer-list-item">Chính Sách Bảo Mật</li>
                                    <li class="footer-list-item">Chính Hãng </li>
                                    <li class="footer-list-item">Kênh Người Bán</li>
                                    <li class="footer-list-item">Flash Sales</li>
                                    <li class="footer-list-item">Chương Trình Tiếp Thị Liên Kết Shopping</li>
                                    <li class="footer-list-item">Liên Hện Với Truyền Thông</li>
                                </ul>
                            </div>
                            <div class="grid-column-2">
                                <h5 class="header-color">THANH TOÁN</h5>
                                <ul class="footer-list footer-list-icon">
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo1.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo2-removebg-preview.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo3-removebg-preview.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo4.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo5-removebg-preview.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo6-removebg-preview.png" alt=""></li>

                                </ul>
                                <div class="footer-logistic">ĐƠN VỊ VẬN CHUYỂN</div>
                                <ul class="footer-list footer-list-icon-logistic">
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/SPX__Shopee_Express__Logo_-_Free_Vector_Download_PNG-removebg-preview.png"
                                            alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/giao-hang-tiet-kiem-removebg-preview.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo_ghn.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo-viettelpost-removebg-preview.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo-vietnampost-removebg-preview.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo_jt_E-removebg-preview.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo_GrapE-removebg-preview.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo_ninjavansvg.svg" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo_bestE-removebg-preview.png" alt=""></li>
                                </ul>

                            </div>
                            <div class="grid-column-2">
                                <h5 class="header-color">THEO DÕI CHÚNG TÔI TRÊN</h5>
                                <ul class="footer-list-list">
                                    <li class="footer-list-item"><a class=" footer-list-item-link"
                                            href="https://www.facebook.com/">
                                            <div class="footer-icon">
                                                <i class="fab fa-facebook footer-list-item-icon-link"></i>
                                            </div>
                                            <div class="text-big">
                                                Facebook
                                            </div>
                                    </li>
                                    </a>
                                    <li class="footer-list-item footer-list-item-link "><a
                                            class=" footer-list-item-link" href="https://www.instagram.com/">
                                            <div class="footer-icon">
                                                <i class="fab fa-instagram footer-list-item-icon-link"></i>
                                            </div>
                                            <div class="text-big">
                                                Instagram
                                            </div>
                                    </li>
                                    </a>
                                    <li class="footer-list-item footer-list-item-link "><a
                                            class=" footer-list-item-link" href="https://www.linkedin.com/">
                                            <div class="footer-icon">
                                                <i class="fab fa-linkedin footer-list-item-icon-link"></i>
                                            </div>
                                            <div class="text-big">
                                                Linkedln
                                            </div>
                                    </li>
                                    </a>
                                </ul>
                            </div>
                            <div class="grid-column-2">
                                <h5 class="header-color">TẢI ỨNG DỤNG NGAY THÔI</h5>
                                <div class="footer-dowload">
                                    <div class="footer-qr">
                                        <a href="" class="footer-qr-img"><img class="footer-qr-img-dowload"
                                                src="./img/qr.png" alt=""></a>
                                    </div>
                                    <div class="footer-app">
                                        <ul class="footer-list-dowload">
                                            <li class="footer-list-item-dowload"><img
                                                    class="footer-list-item-dowload-text"
                                                    src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg//assets/39f189e19764dab688d3850742f13718.png"
                                                    alt=""></li>
                                            <li class="footer-list-item-dowload-space"><img
                                                    class="footer-list-item-dowload-text"
                                                    src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg//assets/f4f5426ce757aea491dce94201560583.png"
                                                    alt=""></li>
                                            <li class="footer-list-item-dowload footer-list-item-dowload-space"><img
                                                    class="footer-list-item-dowload-text"
                                                    src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg//assets/1ae215920a31f2fc75b00d4ee9ae8551.png"
                                                    alt=""></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </footer>
                <div class="footer-hr-color"></div>
                <div class="grid-text-hr">
                    <div class="grid-text-hr-text">
                        © 2021 Shopping. Tất cả các quyền được bảo lưu.
                    </div>
                </div>
            </div>

        </div>
        <div class="footer-address">
            <div class="grid-address">
                <ul class="footer-address-list">
                    <li class="footer-address-list-text footer-address-list-text-space">CHÍNH SÁCH BẢO MẬT</li>

                    <li class="footer-address-list-text footer-address-list-text-space">QUY CHẾ HOẠT ĐỘNG</li>
                    <li class="footer-address-list-text footer-address-list-text-space">CHÍNH SÁCH VẬN CHUYỂN</li>
                    <li class="footer-address-list-text">CHÍNH SÁCH TRẢ HÀNG VA HOÀN TIỀN</li>
                </ul>
                <div class="footer-address-image">
                    <img src="./img/logo-removebg-preview.png" alt="" class="footer-address-image-item">
                    <img src="./img/logo-removebg-preview.png" alt="" class="footer-address-image-item">
                    <img src="./img/4bdefde103e8aa245cd17511adde9f89-removebg-preview.png" alt=""
                        class="footer-address-image-item-item">
                </div>
                <div class="footer-shopping">Công ty TNHH Shopping</div>
            </div>
        </div>
    </div>
    
    <script src="./javascript/cart.js"></script>
</body>

</html>