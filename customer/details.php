<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết hàng hóa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="./owlcarousel/assets/owl.theme.default.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./owlcarousel/owl.carousel.min.js"></script>
    

</head>

<body>
    
    <?php require_once 'conect.php';
        session_start();
        if(isset($_SESSION['customer'])){
            $customer=$_SESSION['customer'];
            $phone=$customer['customers_phone'];
            $querynotication=mysqli_query($conn,"SELECT * FROM `notification` WHERE `customers_phone`=$phone ORDER BY `notification_id` DESC");
            $querycustomer=mysqli_query($conn,"SELECT `customers_avatar` FROM `customers` WHERE `customers_phone`=$phone");
            $showavatar=mysqli_fetch_assoc($querycustomer);
        }
        if(isset($_SESSION['cart'])){
            $numbercart=sizeof($_SESSION['cart']);
            // var_dump($numbercart);exit;
        }else{
            $numbercart=0;
        }
    ?>
    <div class="app-chitiet">

        <div class="header-chitiet ">
            <div class="grid-header">
                <div class="header-navbar">
                    <ul class="header-navbar-list">
                        <li class="header-navbar-list-item">
                            <a href="" class="header-navbar-list-link header-navbar-list-link-not-bold">
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
                                        <div class="header-navbar-list-notification-icon"><i class="fal fa-bells"></i>
                                        </div>
                                        <div class="header-navbar-list-notification-text">Thông báo</div>
                                    </a>
                                    <?php  if(isset($_SESSION['customer'])){ ?>
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
                                                <li class="header-navbar-list-notification-link-user-item">Xem tất cả
                                                </li>
                                            </a>
                                        </div>

                                    </ul>
                                    <?php }else { ?>

                                    <ul class="header-navbar-list-notification-list">
                                        <div class="header-navbar-list-notification-list-padding">
                                            <div class="header-navbar-list-notification-heading">Thông Báo Mới Nhận
                                            </div>
                                            
                                            
                                            <a href="notification.php" class="header-navbar-list-notification-link-user">
                                                <li class="header-navbar-list-notification-link-user-item">Xem tất cả
                                                </li>
                                            </a>
                                        </div>

                                    </ul>

                                    <?php } ?>
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

                        <?php } else{ ?>
                        <li class="header-navbar-list-item">
                                <a href="register.php" class="header-navbar-list-link">
                                Đăng Ký   
                                </a> 
                        </li>
                        <li class="header-navbar-list-item">
                            <a href="login.php" class="header-navbar-list-link">
                                Đăng Nhập       
                            </a> 
                        </li>
                        <?php } ?>
                    </ul>

                </div>
                <div class="header-with">
                    <a href="index.php" class="header-link-home">
                        <div class="header-with-logo">
                            <div class="header-with-logo-img">
                                <div class="header-with-logo-img-img">
                                    <img src="./img/shopping-logo-svgrepo-com.svg" class="header-with-logo-img-svg"">
            
                                    </div>
                                    <div class=" header-with-logo-img-text">
                                    <b>SHOPPING</b>

                                </div>
                            </div>

                        </div>
                    </a>
                    <div class="header-with-search">
                        <div class="header-width-search-flex">
                            <input type="text" class="header-with-search-input" placeholder="Nhập để tìm kiếm sản phẩm">
                            <button class="header-with-search-btn">
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

                    <div class="header-with-cart">

                        <a href="cart.php" class="header-width-cart-hover">
                            <i class="header-with-cart-icon far fa-shopping-cart"></i>
                            <span class="header-width-cart-number"><?php echo $numbercart ;?></span>
                            <!-- header-width-cart-list-no-cart -->
                            
                        </a>

                    </div>

                </div>

            </div>

        </div>
        <script>
            $(document).ready(function () {
                $('.owl-carousel').owlCarousel({
                    loop: true,
                    margin: 10,
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 1,
                            nav: true
                        },
                        600: {
                            items: 3,
                            nav: false
                        },
                        1000: {
                            items: 5,
                            nav: true,
                            loop: false
                        }
                    }
                })
            });
        </script>
        <?php require_once "conect.php";
            if(isset($_GET['productsid'])){
                $id =$_GET['productsid'];
                $showdetails=mysqli_query($conn,"SELECT * FROM `products` WHERE products_id=$id");
                $showdetailsimg=mysqli_query($conn,"SELECT * FROM `products` INNER JOIN image ON products.products_id=image.products_id WHERE products.products_id=$id");
                $showdetailsimgmodal=mysqli_query($conn,"SELECT * FROM `products` INNER JOIN image ON products.products_id=image.products_id WHERE products.products_id=$id");
                $showsize=mysqli_query($conn,"SELECT * FROM `products_details` INNER JOIN size ON products_details.size_id=size.size_id WHERE  products_details.products_id=$id");
                $showcolor=mysqli_query($conn,"SELECT * FROM `products_details` INNER JOIN color ON products_details.color_id=color.color_id WHERE products_details.products_id=$id");
                // $a=mysqli_fetch_all($showcolor);
                // var_dump($a);exit;
                if(mysqli_num_rows($showcolor)>0){
                    while($showcolorbtn=mysqli_fetch_assoc($showcolor)) {
                        $array[]=$showcolorbtn['color_name'];
                    }
                    $arraycolor=array_unique($array);
                }
                if(mysqli_num_rows($showsize)>0){
                    while($showsizebtn=mysqli_fetch_assoc($showsize)) {
                        $arrays[]=$showsizebtn['size_name'];
                    }
                    $arraysize=array_unique($arrays);
                }
               
               
            }
            
        ?>
        <?php  
         while ($showitems= mysqli_fetch_assoc($showdetails)):  ?>
            <div class="container-details">
                <div class="grid-details">
                    <div class="container-details-big">
                        <div class="container-details-big-image">
                            <div class="container-details-image">
                                <img src="../uploads/<?php echo $showitems['products_image']; ?>" alt=""
                                    id="container-details-image-img-id" class="container-details-image-img">
                            </div>
                            <div class="container-details-imge-differenr">
                                <div class="container-lider-big">
                                    <div class="owl-carousel">
                                        <div><img src="../uploads/<?php echo $showitems['products_image']; ?>" alt=""
                                                class="container-lider-image"> </div>


                                        
                                        <?php while($detailsimage=mysqli_fetch_assoc($showdetailsimg)) {?>
                                        <div><img src="../uploads/<?php echo $detailsimage['image_link']; ?>" alt=""
                                                class="container-lider-image"> </div>
                                        <?php } ?>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="container-details-share">
                                <div class="container-details-share-text">Chia sẻ:</div>
                                <div class="container-details-share-icon">
                                    <i class="fab fa-facebook-messenger container-details-share-icon-mess"></i>
                                    <i class="fab fa-facebook container-details-share-icon-facebook"></i>
                                    <i class="fab fa-pinterest container-details-share-icon-printer"></i>
                                </div>
                            </div>
                        </div>
                        <div class="container-details-big-text">
                            <div class="container-details-header">
                                <div class="container-details-love-like">Yêu Thích+</div>
                                <span class="container-details-heading">[<?php echo $showitems['products_id']; ?>]
                                <?php echo $showitems['products_name']; ?></span>
                            </div>
                            <div class="container-details-box">
                                <div class="container-details-evaluate">
                                    <div class="container-details-start">
                                        <div class="container-details-start-number">5.0</div>
                                        <div class="container-details-start-icon">
                                            <i class="fas fa-star container-details-start-icon-star"></i>
                                            <i class="fas fa-star container-details-start-icon-star"></i>
                                            <i class="fas fa-star container-details-start-icon-star"></i>
                                            <i class="fas fa-star container-details-start-icon-star"></i>
                                            <i class="fas fa-star container-details-start-icon-star"></i>
                                        </div>
                                    </div>
                                    <div class="container-details-sold">
                                        <div class="container-details-sold-number">
                                            7,3k
                                        </div>
                                        <div class="container-details-sold-text">
                                            Đã&nbsp;Bán
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-details-price">
                                <div class="container-details-old-price">
                                    <div class="container-details-old-price-text">
                                        <sup>₫</sup>
                                    </div>
                                    <div class="container-details-old-price-number">
                                    <?=number_format($showitems['products_price_last'],"3",".",",") ?>
                                    </div>
                                </div>
                                <div class="container-details-new-price">
                                    <div class="container-details-new-price-text">
                                        <sup>₫</sup>
                                    </div>
                                    <div class="container-details-new-price-number">
                                    <?=number_format($showitems['products_price'],"3",".",",") ?>
                                    </div>
                                </div>
                                <div class="container-details-sale"><?php echo round($showitems['products_price']*100/$showitems['products_price_last']); ?>%&nbsp;GIẢM</div>
                            </div>

                            


                        
                        
                            
                            <div class="container-details-color">
                                <label class="container-details-color-text">MÀU SẮC</label>
                                <div class="container-details-color-item">
                                    
                                    <?php 
                                        if(isset($arraycolor)){
                                        foreach($arraycolor as $key => $value){ ?>
                                        <button class="container-details-button-color" onclick="onclickcolor()" checked="checked">
                                            <?php echo $value;?>
                                            <i class="fal fa-check container-details-button-focus"
                                                onclick="event.stopPropagation()"></i>
                                            <div class="container-details-button-color-backg" onclick="event.stopPropagation()">
                                            </div>
                                        </button>
                                    <?php } }?>
                                    
                                </div>
                            </div>
                          
                            <div class="container-details-size">
                                <label class="container-details-size-text">SIZE</label>
                                <div class="container-details-size-item">
                                <?php 
                                 if(isset($arraysize)){
                                foreach($arraysize as $key => $value){ ?>
                                    <button class="container-details-button-size" onclick="onclicksize()" checked="checked">
                                        <?php echo $value; ?>
                                        <i class="fal fa-check container-details-button-checked"
                                            onclick="event.stopPropagation()"></i>
                                        <div class="container-details-button-color-checked"
                                            onclick="event.stopPropagation()"></div>
                                    </button>
                                    <?php } }?>
                                    
                                   
                                </div>
                            </div>
                        <form method="POST" action="cart.php?action=add" class="form-submit" >
                            <div class="container-details-quantity">
                                <div class="container-details-quantity-products">
                                    <div class="container-details-quantity-text">Số Lượng</div>
                                    <div class="container-details-quantity-number" >
                                        <div class="container-details-quantity-number-quantity">
                                            <!-- <input type="button" class="container-details-minus" value="-">
                                                <i class="fal fa-minus container-details-minus-btn"></i>
                                            </input>
                                            <input type="number" class="container-details-input-text" min="1" max="300"
                                                value="1" name="quantity">
                                            <input type="button" class="container-details-minus-btn-btn">dasdsads</input> -->

                                            <div class="container-details-minus" >
                                                <i class="fal fa-minus container-details-minus-btn"></i>
                                            </div>
                                           
                                                        
                                            <input type="number"  
                                                class="container-details-input-text" min="1" max="300"
                                                value="1" name="quantity">
                                               
                                            <div class="container-details-minus-btn-btn">
                                                <i class="fal fa-plus container-details-minus-btn"></i>
                                            </div>  
                                            
                                        </div>
                                        <span class="container-details-quantity-number-product"><?php echo $showitems['products_quantity']; ?> sản phẩm có sẵn</span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" class="id-products" value="<?php echo $showitems['products_id']; ?>">
                            <input type="hidden" name="price" value="<?php echo $showitems['products_price']; ?>">
                            <input type="hidden" name="pricelast" value="<?php echo $showitems['products_price_last']; ?>">
                            <input type="hidden" name="namesp" value="<?php echo $showitems['products_name']; ?>">
                            <input type="hidden" name="image" value="<?php echo $showitems['products_image']; ?>">
                            <input type="text"  value="" name="color" class="container-details-input-color" required >
                            <input type="text"  value="" name="size" class="container-details-input-size" required >
                            
                            
                            
                            

                            <div class="container-details-button-add">
                                <button class="container-details-add" name="addsubmit">
                                    <div class="container-details-add-text">
                                        <i class="fal fa-cart-plus container-details-add-text-icon"></i>Thêm Vào Giỏ Hàng
                                    </div>
                                </button>
                                <div class="container-details-link">
                                    <button type="submit" name="submit" class="container-details-button-buy">Mua Ngay</button>
                                </div>
                                
                            </div>

                        </form>
                            <div class="container-details-hr"></div>
                            <div class="container-details-commit">
                                <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg//assets/67454c89080444c5997b53109072c9e0.png"
                                    alt="" class="container-details-commit-img">
                                <span class="container-details-commit-text-shopping">Shopping Đảm Bảo</span>
                                <span class="container-details-commit-text">3 Ngày Trả Hàng / Hoàn Tiền</span>
                            </div>




                        </div>
                    </div>
                </div>
                                        

                <div class="grid-details-footer">

                    <div class="container-details-footer">
                        <div class="container-details-footer-one">
                            <div class="container-details-footer-heading">
                                CHI TIẾT SẢN PHẨM
                            </div>
                            <div class="container-details-footer-text">
                                <span class="text-details">
                                    <?php echo $showitems['products_details']; ?>
                                </span>
                            </div>
                        </div>
                        <div class="container-details-footer-two">
                            <div class="container-details-footer-heading">
                                MÔ TẢ SẢN PHẨM
                            </div>
                            <div class="container-details-footer-text">
                                <span class="text-details">
                                    <?php echo $showitems['products_description']; ?>
                                </span>
                        
                            </div>
                        </div>
                    </div>
                </div>

            </div>
  
    </div>
    <div class="app-chitiet-notifi">
        <div class="app-chitiet-notifi-big">
            <div clas="app-chitiet-notifi-check">
                <div class="app-chitiet-notifi-icon">
                    <i class="far fa-check app-chitiet-notifi-icon-color"></i>
                </div>
                <div class="app-chitiet-notifi-text">Sản phẩm đã được thêm vào Giỏ hàng</div>
            </div>
        </div>
    </div>
    <div class="modal-details-img">
        <div class="details-image">
            <div class="details-image-margin">
                <div class="details-image-flex">
                    <div class="details-image-big">
                        <img src="" alt=""
                            class="details-image-big-img">
                    </div>
                    <div class="details-image-right">
                        <div class="details-image-heading">
                            <div class="details-image-heading-text">
                                <?php echo $showitems['products_name']; ?>
                            </div>
                        </div>
                        <div class="details-image-small">
                            <div class="details-image-small-item">
                                <div class="details-image-small-item-border">
                                    <img src="../uploads/<?php echo $showitems['products_image']; ?>" alt=""
                                        class="details-image-small-img">
                                    <div class="details-image-small-item-border-color">
                                    </div>
                                    <div class="details-image-small-item-hover">
                                    </div>

                                </div>

                            </div>
                            <?php while($modalimg=mysqli_fetch_assoc($showdetailsimgmodal)) {?>
                                <div class="details-image-small-item">
                                    <div class="details-image-small-item-border">
                                        <img src="../uploads/<?php echo $modalimg['image_link']; ?>" alt=""
                                            class="details-image-small-img">
                                        <div class="details-image-small-item-border-color">
                                        </div>
                                        <div class="details-image-small-item-hover">
                                        </div>
                                    </div>
                                </div>
                                       
                            <?php } ?>
                        





                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div id="aa"></div>
    <?php  endwhile; ?>
    <script src="./javascript/details.js"></script>
    <script>
                // let chosenColor = "";
                // let chosenSize = "";
                // function displayChosenSizeColor(){
                //     let $colorButtonItems = $(".container-details-button-color");
                //     let $sizeButtonItems = $(".container-details-button-size");
                //     if (chosenColor != "" ){
                //         $colorButtonItems.each((index, element)=>{
                //             if ($(element).text().trim() == chosenColor){

                //                 $(element).addClass("click click1");
                //                 $(element).find("i").addClass("click");
                //                 $(element).find("div").addClass("click");
                //             }
                //         })
                //     }
                //     if (chosenSize != ""){
                //         $sizeButtonItems.each((index, element)=>{
                //             if ($(element).text().trim() == chosenSize){
                //                 $(element).addClass("click click2");
                //                 $(element).find("i").addClass("clicksize");
                //                 $(element).find("div").addClass("clicksize");
                //             }
                //         })
                //     }
                // }

                // function addEventForColor(){
                //     var detailscheckcolor=document.querySelectorAll(".container-details-button-color");
                //     var brgcolor = document.querySelectorAll(".container-details-button-color-backg");
                //     var check = document.querySelectorAll(".container-details-button-focus");
                //     var inputcolor = document.querySelector(".container-details-input-color");
                //     for(var i=0;i<detailscheckcolor.length;i++){
                //         detailscheckcolor[i].onclick=function(e) {
                //             for (var i = 0; i < detailscheckcolor.length; i++) {
                //                 detailscheckcolor[i].classList.remove("click1");
                //             }
                //             for (var i = 0; i < brgcolor.length; i++) {
                //                 brgcolor[i].classList.remove("click");
                //             }
                //             for (var i = 0; i < check.length; i++) {
                //                 check[i].classList.remove("click");
                //             }
                //             var btncolor = e.target;

                //             console.log(e.target.innerText);
                //             var checks = e.target.children[0];
                //             var brg = e.target.children[1];
                //             btncolor.classList.add("click1");
                //             checks.classList.add("click");
                //             brg.classList.add("click");
                //             console.log(inputcolor.value = e.target.innerText);
                //             console.log(e);
                //             var idss=document.querySelector(".id-products").value;
                //             console.log(idss);
                //             var cl=e.target.innerText;
                //             chosenColor = e.target.innerText.trim();
                            
                            
                //             $.ajax({
                //                 // url :"https://jsonplaceholder.typicode.com/posts",
                //                 url :"xulycolor.php",
                //                 data: {color:cl,idpr:idss},
                //                 // dataType: 'json',
                //                 success: function(rs){
                //                     // console.log(rs);
                //                     var kqcolor="";
                //                     rs = JSON.parse(rs);
                //                     $.each(rs,function(i,item){
                //                         kqcolor += `
                //                         <button class="container-details-button-size" onclick="onclicksize()" checked="checked">
                //                             ${item.size_name}
                //                                 <i class="fal fa-check container-details-button-checked"
                //                                     onclick="event.stopPropagation()"></i>
                //                                 <div class="container-details-button-color-checked"
                //                                     onclick="event.stopPropagation()"></div>
                //                         </button>
                //                         `;
                //                     });
                //                     $(".container-details-size-item").html("");
                //                     $(".container-details-size-item").html((index, currentValue)=>{
                //                         return currentValue + kqcolor;
                                    
                //                     });
                                
                                    
                                    
                //                     // return detailschecksize;
                //                     var detailschecksize = document.querySelectorAll(".container-details-button-size");
                //                     addEventForSize();
                //                     displayChosenSizeColor();

                //                 }
                //             });
                            
                        
                //         }
                //     }
                // }
                //     addEventForColor();

            
            
        
                
                // function addEventForSize(){
                //     var detailschecksize = document.querySelectorAll(".container-details-button-size");
                //     console.log(detailschecksize);


                //     var brgsize = document.querySelectorAll(".container-details-button-color-checked");
                //     var checksize = document.querySelectorAll(".container-details-button-checked");
                //     var inputsize = document.querySelector(".container-details-input-size");
                    
                //     for (var i = 0; i < detailschecksize.length; i++) {
                //         detailschecksize[i].onclick = function (e) {
                //             for (var i = 0; i < detailschecksize.length; i++) {
                //                 detailschecksize[i].classList.remove("click2");
                //             }
                //             for (var i = 0; i < brgsize.length; i++) {
                //                 brgsize[i].classList.remove("clicksize");
                //             }
                //             for (var i = 0; i < checksize.length; i++) {
                //                 checksize[i].classList.remove("clicksize");
                //             }
                //             var btnsize = e.target;

                //             console.log(e.target);
                //             var checksizess = e.target.children[0];
                //             console.log(e.target.children[0]);
                //             var brgsizess = e.target.children[1];
                //             btnsize.classList.add("click2");
                //             checksizess.classList.add("clicksize");
                //             brgsizess.classList.add("clicksize");
                //             inputsize.value = e.target.innerText;
                //             var idproduct=document.querySelector(".id-products").value;
                //             var size=e.target.innerText;
                //             chosenSize = e.target.innerText.trim()
                          
                //             console.log(size);
                //             console.log(idproduct);
                //                 $.ajax({
                //                     // url :"https://jsonplaceholder.typicode.com/posts",
                //                     url :"xulysize.php",
                //                     data: {sizes:size,idproducts:idproduct},
                //                     // dataType: 'json',
                //                     success: function(rs){
                //                         // console.log(rs);
                //                         var kqsize="";
                //                         rs = JSON.parse(rs);
                //                         $.each(rs,function(i,item){
                //                             kqsize += `
                //                             <button class="container-details-button-color" onclick="onclickcolor()" checked="checked">
                //                                 ${item.color_name}
                //                                 <i class="fal fa-check container-details-button-focus" onclick="event.stopPropagation()"></i>
                //                                 <div class="container-details-button-color-backg" onclick="event.stopPropagation()"></div>
                //                             </button>
                //                             `;
                //                         });
                //                         $(".container-details-color-item").html("");
                //                         $(".container-details-color-item").html((index, currentValue)=>{
                //                             return currentValue + kqsize;
                //                         });
                //                         addEventForColor()
                //                         displayChosenSizeColor()
                //                     }
                //                 });

                //         }
                //     }
                // }
                // addEventForSize()
                
            
        
        
        
    </script>
</body>

</html>