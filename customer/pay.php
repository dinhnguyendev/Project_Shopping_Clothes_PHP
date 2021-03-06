<?php  session_start();?>
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
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/base.css">

    <title>Shopping</title>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <script src='https://cdn.jsdelivr.net/gh/vietblogdao/js/districts.min.js'></script>
</head>

<body>
    <?php require_once 'conect.php';
       
        
       if(isset($_POST['addressorders'])){
            $address=$_POST['addressorders'];
            $stringaddress=explode(";",$address);
            // var_dump($stringaddress);
            // exit;
        }else{
            header('Location:cart.php');
        }
        
        if(isset($_GET['action'])){
            switch($_GET['action']){
                case "submitcart":
                       
                    if(isset($_POST['submitadd']) || isset($_POST['confirm']) ){
                        $cartid=$_POST['idcart'];
                        $cartimg=$_POST['imagecart'];
                        $cartname=$_POST['namecart'];
                        $cartcolor=$_POST['colorcart'];
                        $cartsize=$_POST['sizecart'];
                        $cartprice=$_POST['pricecart'];
                        $cartpricecart=$_POST['pricelastcart'];
                        $cartquantity=$_POST['quantitycart'];
                        $products = [];
                       

                        for ($i =0; $i< sizeof($cartid);$i++){
                            $product = [$_POST['idcart'][$i],
                            $_POST['imagecart'][$i],
                            $_POST['namecart'][$i],
                            $_POST['colorcart'][$i],
                            $_POST['sizecart'][$i],
                            $_POST['pricecart'][$i],
                            $_POST['pricelastcart'][$i],
                            $_POST['quantitycart'][$i]];
                            array_push($products, $product);
                        }
                        
                        
                
                        // var_dump( $products);exit;
                        $_SESSION["cart"] = $products;
                        header('Location:cart.php');
                        
                        
                    }elseif(isset($_POST['submitlink'])){
                            if(!empty($_POST['checkked'])){
                                $arraycheckked=$_POST['checkked'];
                                // var_dump( $arraycheckked);
                                

                            }else{
                                header('Location:cart.php');
                            }
                    }
                break;
                case 'buy':
                    if(isset($_POST['orderss'])){
                        $nameaddress=$_POST['name-address'];
                        $phoneaddress=$_POST['phone-address'];
                        $addressaddress=$_POST['address-address'];
                        // var_dump($addressaddress);exit;
                        $orderproducts=$_POST['order-product'];
                        for($i=0;$i<sizeof($orderproducts);$i++){
                            $arrays=$orderproducts[$i];
                            $strs=explode(",",$arrays);
                            $idexit=$strs[0];
                            $colorexit=$strs[1];
                            $sizeexit=$strs[2];
                            $quantityexit=$strs[3];
                            $exitsql=mysqli_query($conn,"SELECT * FROM `products_details`
                            WHERE `products_id`=$idexit AND `color_id`=$colorexit AND`size_id`=$sizeexit AND products_details_quantity>$quantityexit");

                            // var_dump($exitsql);
                            if(mysqli_num_rows($exitsql)==0){
                                header('Location:cart.php?action=errors');
                                
                                exit;
                            }

                        }
                        // exit;
                        // var_dump($orderproducts);
                        
                        $total=$_POST['total'];
                        $date = date('d-m-Y');
                        $newdate = strtotime ( '+5 day' , strtotime ( $date ) ) ;
                        $newdates = date ( 'd-m-Y' , $newdate );
                        if(isset($_SESSION['customer'])){
                            $customer=$_SESSION['customer'];
                            // var_dump($customer);
                            $phone=$customer['customers_phone'];
                            
                        }
                        if(isset($_POST['order-product'])){
                            $productdetails=$_POST['order-product'];
                            // var_dump($productdetails);
                            // exit;
                        }
                        $status=1;
                        $orderinsert=mysqli_query($conn,"INSERT INTO `orders`( `customers_phone`, `customers_name`, `orders_phone`,`orders_address`, `orders_total`, `orders_date_placed`, `orders_stattus`)
                         VALUES ('$phone','$nameaddress','$phoneaddress','$addressaddress','$total','$date','$status')");
                        // $orderquery=mysqli_query($conn,"SELECT `orders_id` FROM `orders` ORDER BY `orders_id` DESC LIMIT 1");
                        // $orderid=mysqli_fetch_assoc($orderquery);
                        // $orderids=$orderid['orders_id'];
                        $last_id = $conn->insert_id;
                        // var_dump($last_id);
                        for($i=0;$i<sizeof($productdetails);$i++){
                            $arrayproduct=$productdetails[$i];
                            $stringproduct=explode(",",$arrayproduct);
                            $proid=$stringproduct[0];
                            $procolor=$stringproduct[1];
                            $prosize=$stringproduct[2];
                            $proquantity=$stringproduct[3];
                            $proprice=$stringproduct[4];
                            // var_dump($proid);
                            // var_dump($procolor);
                            // var_dump($prosize);
                            // var_dump($proquantity);
                            // var_dump($proprice);
                            // exit;
                            $insertproductsdetails=mysqli_query($conn,"INSERT INTO `orders_details`(`products_id`, `orders_id`, `color_id`, `size_id`, `orders_details_quantity`, `orders_details_price`) 
                            VALUES ('$proid','$last_id','$procolor','$prosize','$proquantity','$proprice')");

                        }
                        $images=$_POST['images'];
                        $title="????n h??ng ???? ???????c t???o.";
                        $names="B???n v???a ?????t ?????t m???t ????n h??ng th??nh c??ng.Ch?? ?? th???i gian ????? nh???n h??ng b???n nh?? :)))";
                        date_default_timezone_set('Asia/Ho_Chi_Minh');
                        $datetime = date('H:i:s d-m-Y');
                        $querynoti=mysqli_query($conn,"INSERT INTO `notification`( `customers_phone`, `notification_img`, `notification_title`, `notification_name`, `notification_date_start`)
                         VALUES ('$phone','$images','$title','$names','$datetime')");
                        header('Location:success.php');
                        
                       
                    }
                break;
                



                
            }
        }
       
        
        if(isset($_SESSION['customer'])){
            $customer=$_SESSION['customer'];
            // var_dump($customer);
            $address=$customer['customers_phone'];
            $queryaddress=mysqli_query($conn,"SELECT * FROM `addresses` WHERE `customers_phone`=$address");
            $querynotication=mysqli_query($conn,"SELECT * FROM `notification` WHERE `customers_phone`=$address ORDER BY `notification_id` DESC");
            $querycustomer=mysqli_query($conn,"SELECT `customers_avatar` FROM `customers` WHERE `customers_phone`=$address");
            $showavatar=mysqli_fetch_assoc($querycustomer);
        }else{
            header('Location:login.php');
        }
      
        
        

       
        
    ?>
    <div class="app">
<form method="POST" action="pay.php?action=buy"  >
        <div class="header-cart">
            <div class="header-cart-navigation-1">
                <div class="grid-header">
                    <div class="header-navbar">
                        <ul class="header-navbar-list">
                            <li class="header-navbar-list-item">
                                <a href="" class="header-navbar-list-link header-navbar-list-link-not-bold">
                                    Trang Ch???
                                </a>
                            </li>
                            <li class="header-navbar-list-item">
                                <a href="" class="header-navbar-list-link header-navbar-list-link-not-bold">
                                    Gi???i Thi???u
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
                                            <div class="header-navbar-list-notification-text">Th??ng b??o</div>
                                        </a>

                                        <ul class="header-navbar-list-notification-list">
                                            <div class="header-navbar-list-notification-list-padding">
                                                <div class="header-navbar-list-notification-heading">Th??ng B??o M???i Nh???n
                                            <?php $dem=0;    while($shownoti=mysqli_fetch_assoc($querynotication)){ ?>
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
                                                    <li class="header-navbar-list-notification-link-user-item">Xem t???t
                                                        c???
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
                                            H??? Tr???
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
                                        <li class="header-bavber-user-list-item-myuser">T??i Kho???n C???a T??i</li>
                                    </a>
                                    <a href="order.php" class="header-navbar-user-link">
                                        <li class="header-bavber-user-list-item-myuser-user">????n Mua</li>
                                    </a>
                                    <a href="logout.php" class="header-navbar-user-link">
                                        <li class="header-bavber-user-list-item-myuser-logout">????ng Xu???t</li>
                                    </a>
                                </ul>
                            </li>
                            <?php } ?>

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
                                    <div class="header-with-logo-img-pay">
                                        <div class="header-with-logo-img-img">
                                            <img src="./img/shopping-logo-svgrepo-com.svg"
                                                class="header-with-logo-img-svg"">
                
                                    </div>
                                    <div class=" header-with-logo-img-text-cart">
                                            <b>SHOPPING</b>
                                        </div>
                                    </div>
                                    <div class="header-with-logo-cart-item">
                                        <div class="header-with-logo-cart-text">Thanh to??n</div>
                                    </div>

                                </div>
                            </a>




                        </div>
                    </div>
                </div>
            </div>

        </div>
    
        <div class="container-pay">
            <div class="grid-pay">
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
                                    ?????a ch??? nh???n h??ng
                                </div>
                            </div>
                            

                        </div>
                        <div class="container-pay-address-list">
                            <div class="container-pay-address-list-big">
                                <div class="container-pay-address-list-item">
                                    <div class="container-pay-address-list-input">
                                        <input type="radio" checked
                                            class="container-pay-address-list-input-check">
                                    </div>
                                    <div class="container-pay-address-list-name">
                                        <div class="container-pay-address-list-name-customers">
                                            <b><?php echo $stringaddress[0]; ?> &nbsp; <?php echo $stringaddress[1]; ?></b>
                                            
                                        </div>
                                    </div>
                                    <div class="container-pay-address-list-address">
                                    <?php echo $stringaddress[2]; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="name-address" value="<?php echo $stringaddress[0]; ?>">
                        <input type="hidden" name="phone-address" value="<?php echo $stringaddress[1]; ?>">
                        <input type="hidden" name="address-address" value="<?php echo $stringaddress[2]; ?>">
                    </div>
                </div>
                <div class="container-pay-products">
                    <div class="container-pay-products-big">
                        <div class="container-pay-products-category">
                            <div class="container-pay-products-category-products">
                                S???n ph???m
                            </div>
                            <div class="container-pay-products-category-space">

                            </div>
                            <div class="container-pay-products-category-price">
                                ????n gi??
                            </div>
                            <div class="container-pay-products-category-number">
                                S??? l?????ng
                            </div>
                            <div class="container-pay-products-category-money">
                                Th??nh ti???n
                            </div>
                        </div>
                        <div class="container-pay-products-handle">
                            <img src="https://cf.shopee.vn/file/bcb4e84dd6d7003f5cfa154abc2fb34f" alt=""
                                class="container-pay-products-handle-icon">
                            <div class="container-pay-products-handle-text">X??? l?? ????n h??ng b???i Shopee</div>
                        </div>
                   
                      
                        <div class="container-pay-products-margin">
                        <?php 
                            $total=0;
                             if(!empty($_POST['payproducts'])){
                                $arraycheckked=$_POST['payproducts'];
                                var_dump( $arraycheckked);
                                

                            }
                            if(isset($arraycheckked)){
                                for($i=0;$i<sizeof($arraycheckked);$i++){
                                    $araystring=$arraycheckked[$i];
                                    $strings=explode(",",$araystring);
                                    $cl=$strings[1];
                                    $sz=$strings[2];
                                    $quan=$strings[3];

                                    $queryid=mysqli_query($conn,"SELECT * FROM `products` WHERE `products_id`=$strings[0]");
                                    $querycolorid=mysqli_query($conn,"SELECT * FROM `color` WHERE `color_name`='$cl'");
                                    $querysizeid=mysqli_query($conn,"SELECT * FROM `size` WHERE `size_name`='$sz'");
                                    $colorid=mysqli_fetch_assoc($querycolorid);
                                    $sizeid=mysqli_fetch_assoc($querysizeid);
                                    $productid=mysqli_fetch_assoc($queryid);
                                    
                                    // var_dump($strings);
                                    // var_dump($productid);
                                    // exit;
                        ?>
                            <input type="hidden" name="order-product[]" 
                            value="<?=$strings[0]?>,<?=$colorid['color_id']?>,<?=$sizeid['size_id']?>,<?=$quan?>,<?php echo $productid['products_price']; ?>">


                            <div class="container-pay-products-details">
                                <div class="container-pay-products-details-products">
                                    <div class="container-pay-products-details-products-flex">
                                        <img src="../uploads/<?php echo $productid['products_image']; ?>" alt=""
                                            class="container-pay-products-details-image">
                                        <div class="container-pay-products-details-text">
                                            <?php echo $productid['products_name']; ?>
                                        </div>

                                    </div>
                                </div>
                                <div class="container-pay-products-details-type">
                                    Lo???i:  <?php echo $strings[1]; ?>,Size <?php echo $strings[2]; ?>
                                </div>
                                <div class="container-pay-products-details-price">
                                    ???<?=number_format($productid['products_price'],"3",".",",") ?>
                                </div>
                                <div class="container-pay-products-details-number">
                                    <?php echo $strings[3]; ?>
                                </div>
                                <div class="container-pay-products-details-money">
                                    ???<?=number_format($productid['products_price']*$strings[3],"3",".",",") ?>
                                </div>
                            </div>
                            
                        <?php 
                            $total=$total+$productid['products_price']*$strings[3];

                            } }
                        ?>

                        </div>
                    </div>
                    <div class="container-pay-footer">
                        <div class="container-pay-footer-numer">
                            <div class="container-pay-footer-numer-flex">
                                <div class="container-pay-footer-numer-text">T???ng thanh to??n:</div>
                                <div class="container-pay-footer-numer-money">???<?=number_format($total,"3",".",",") ?></div>
                            </div>
                        </div>
                        <input type="hidden" name="total" value="<?php echo $total; ?>">
                        <input type="hidden" name="images" value="<?php echo $productid['products_image']; ?>">
                        <div class="container-pay-footer-button">
                            <div class="container-pay-footer-button-text">Nh???n "?????t h??ng" ?????ng ngh??a v???i vi???c b???n
                                ?????ng ?? tu??n theo ??i???u kho???n Shopping</div>
                            <button name="orderss" class="container-pay-footer-btn">?????t H??ng</button>
                        </div>
                    </div>
              
                </div>
            </div>
        </div>
</form>

        <div class="hr-footer-space"></div>
        <div class="footer-brg">
            <div class="grid">
                <footer class="footer">
                    <div class="grid-column">
                        <div class="grid-row-footer">
                            <div class="grid-column-footer-2">
                                <h5 class="header-color">CH??M S??C KH??CH H??NG</h5>
                                <ul class="footer-list">
                                    <li class="footer-list-item">Trung T??m Tr??? Gi??p</li>
                                    <li class="footer-list-item">Shopping Blog</li>
                                    <li class="footer-list-item">Shopping Mall</li>
                                    <li class="footer-list-item">H?????ng D???n Mua H??ng</li>
                                    <li class="footer-list-item">H?????ng D???n B??n H??ng</li>
                                    <li class="footer-list-item">Thanh To??n</li>
                                    <li class="footer-list-item">Shopping Xu</li>
                                    <li class="footer-list-item">V???n chuy???n</li>
                                    <li class="footer-list-item">Tr??? H??ng & Ho??n Ti???n</li>
                                    <li class="footer-list-item">Ch??m S??c Kh??ch H??ng</li>
                                    <li class="footer-list-item">Ch??nh Sach B???o h??nh</li>
                                </ul>
                            </div>
                            <div class="grid-column-2">
                                <h5 class="header-color">V??? SHOPPING</h5>
                                <ul class="footer-list">
                                    <li class="footer-list-item">Gi???i Thi???u Shopping Vi???t Nam</li>
                                    <li class="footer-list-item">Tuy???n D???ng</li>
                                    <li class="footer-list-item">??i???u Kho???n Shopping</li>
                                    <li class="footer-list-item">Ch??nh S??ch B???o M???t</li>
                                    <li class="footer-list-item">Ch??nh H??ng </li>
                                    <li class="footer-list-item">K??nh Ng?????i B??n</li>
                                    <li class="footer-list-item">Flash Sales</li>
                                    <li class="footer-list-item">Ch????ng Tr??nh Ti???p Th??? Li??n K???t Shopping</li>
                                    <li class="footer-list-item">Li??n H???n V???i Truy???n Th??ng</li>
                                </ul>
                            </div>
                            <div class="grid-column-2">
                                <h5 class="header-color">THANH TO??N</h5>
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
                                <div class="footer-logistic">????N V??? V???N CHUY???N</div>
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
                                <h5 class="header-color">THEO D??I CH??NG T??I TR??N</h5>
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
                                <h5 class="header-color">T???I ???NG D???NG NGAY TH??I</h5>
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
                        ?? 2021 Shopping. T???t c??? c??c quy???n ???????c b???o l??u.
                    </div>
                </div>
            </div>

        </div>
        <div class="footer-address">
            <div class="grid-address">
                <ul class="footer-address-list">
                    <li class="footer-address-list-text footer-address-list-text-space">CH??NH S??CH B???O M???T</li>

                    <li class="footer-address-list-text footer-address-list-text-space">QUY CH??? HO???T ?????NG</li>
                    <li class="footer-address-list-text footer-address-list-text-space">CH??NH S??CH V???N CHUY???N</li>
                    <li class="footer-address-list-text">CH??NH S??CH TR??? H??NG VA HO??N TI???N</li>
                </ul>
                <div class="footer-address-image">
                    <img src="./img/logo-removebg-preview.png" alt="" class="footer-address-image-item">
                    <img src="./img/logo-removebg-preview.png" alt="" class="footer-address-image-item">
                    <img src="./img/4bdefde103e8aa245cd17511adde9f89-removebg-preview.png" alt=""
                        class="footer-address-image-item-item">
                </div>
                <div class="footer-shopping">C??ng ty TNHH Shopping</div>
            </div>
        </div>
    </div>


    
</body>
<script src='./javascript/main.js'></script>

</html>