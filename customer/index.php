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


    <title>Shopping</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/base.css">
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
        $sqlslider=mysqli_query($conn,"SELECT * FROM `slider`");
    ?>
    <div class="app">
        <div class="header ">
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
                                <img src="./uploads/<?php echo $showavatar['customers_avatar'] ;?>" alt=""
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
                    
                    <form style="flex:1;" method="POST" action="" >
                    <div class="header-with-search">
                        <div class="header-width-search-flex">
                            <input type="text" name="searchtext" class="header-with-search-input" autocomplete="off" placeholder="Nhập để tìm kiếm sản phẩm">
                            <button name="search" class="header-with-search-btn">
                                <i class="header-with-search-btn-icon fal fa-search"></i>
                            </button>
                            <!-- <div class="header-width-search-history">
                                <h5 class="header-width-search-history-text">Lịch Sử Tìm Kiếm</h5>
                                <ul class="header-width-search-history-link">
                                    <li class="header-width-search-history-link-item">
                                        <a href="">aaaaaaa</a>
                                    </li>
                                    <li class="header-width-search-history-link-item">
                                        <a href="">bbbb</a>
                                    </li>
                                </ul>
                            </div> -->

                        </div>
                    </div>
                    </form>
                    
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
        <div class="container">
            <div class="container-margin-top">
                <div class="grid">
                    <div class="advertisement">
                        <div class="slider">
                            <?php while($showslider=mysqli_fetch_assoc($sqlslider)){ ?>
                            <div> <img src="../uploads/<?php echo $showslider['slider_link'];?>" class="slider-image-img" alt=""></div>
                            <?php } ?>

                        </div>
                        <script>
                            $(document).ready(function () {
                                $('.slider').bxSlider({
                                    auto: true, pause: 5000
                                });
                            });
                        </script>
                        <div class="slider-img">
                            <div class="slider-img-one">
                                <img src="./img/11.png" class="slider-img-one-one" alt="">
                            </div>
                            <div class="slider-img-two">
                                <img src="./img/12.png" class="slider-img-two-two" alt="">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <?php 
               
                $numberproducts=24;
                 if(isset($_GET['page'])){
                    $page=$_GET['page'];
                    settype($page,"int");
                    
                }else{
                    $page= 1;
                }
                $from=($page-1)*$numberproducts;
                $result=mysqli_query($conn,"SELECT * FROM `products`  LIMIT $from,$numberproducts");
              
                if(isset($_POST['search'])){
                    if(!empty($_POST['searchtext'])){
                        $searchtext=$_POST['searchtext'];
                        $result=mysqli_query($conn,"SELECT * FROM `products` WHERE `products_name` LIKE '%$searchtext%' ");
                        
                    }else{
                        $result=mysqli_query($conn,"SELECT * FROM `products`  ");

                    }
                    
                }
                
               
            ?>
            <div class="grid-product">
                <div class="grid-row">
                    <div class="grid-column">
                        <div class="grid-row">
                            
                            <?php while($show = mysqli_fetch_assoc($result)):  ?>
                                <div class="grid-column-2">
                                    <a class="home-product-item" href="details.php?productsid=<?php echo $show['products_id']; ?>">
                                        <div class="home-product-main"> 
                                            <div class="home-product-item-img"
                                                style="background-image: url('../uploads/<?php echo $show['products_image'];  ?>'); ">
                                            </div>
                                            <h5 class="home-product-item-name"><?php echo $show['products_name']; ?></h5>
                                            <div class="home-product-item-price">
                                                <span class="home-product-item-price-old"><?=number_format($show['products_price_last'],"3",".",",") ?></span>
                                                <span class="home-product-item-price-current"><?=number_format($show['products_price'],"3",".",",") ?></span>
                                            </div>
                                            <div class="home-product-item-action">

                                                <span class="home-product-item-like home-product-item-like-liked">
                                                    <i class="home-product-item-like-icon-empty far fa-heart"></i>
                                                    <i class="home-product-item-like-icon-fill fas fa-heart"></i>
                                                </span>
                                                <div class="home-product-item-rating">
                                                    <i class="home-product-item-star-gold fas fa-star"></i>
                                                    <i class="home-product-item-star-gold fas fa-star"></i>
                                                    <i class="home-product-item-star-gold fas fa-star"></i>
                                                    <i class="home-product-item-star-gold fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <span class="home-product-item-sold">Còn lại:<?php echo $show['products_quantity'];  ?></span>
                                            </div>
                                            <div class="home-product-item-faviurite">
                                                <i class="fas fa-check"></i>
                                                Yêu thích
                                            </div>
                                            <div class="home-product-item-sale-of">
                                                <span class="home-product-item-sale-of-percent"><?php echo 100- (round($show['products_price']*100/$show['products_price_last'])); ?>%</span>
                                                <span class="home-product-item-sale-of-label">GIẢM</span>
                                            </div>

                                        </div>
                                        <div class="home-product-hover-footer">Tìm sản phẩm tương tự</div>

                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php
               
              

                $sqlresult=mysqli_query($conn,"SELECT * FROM `products` ");
                $totalpage=mysqli_num_rows($sqlresult);
                $numberpage=ceil($totalpage / $numberproducts);
            ?>
            <div class="grid-page">
                <div class="pag">
                    <ul class="paging">
                        <?php if($page > 1) {
                            $back=$page-1;
                            ?>

                            <li class="paging-item"> <a href="index.php?page=<?=$back ?>"><i class="fas fa-chevron-left"></i></a></li>
                            <?php } ?>
                        <?php for($i=1 ; $i <= $numberpage ;$i++) {?>
                            <?php if($page != $i) {
                                if($i > $page - 3 && $i< $page+3){
                                ?>  
                                <li class="paging-item"> <a href="index.php?page=<?=$i?>"><?php echo $i ?></a></li>
                            <?php }}else { ?>
                                <li class="paging-item"> <a style="background-color: #EE4D2D"><?php echo $i ?></a></li>
                        <?php }} ?>


                        <?php if($page < $numberpage -1){ $next=$page +1; ?>
                            
                            <li class="paging-item"> <a href="index.php?page=<?=$next ?>"><i class="fas fa-chevron-right"></i></a></li>

                        <?php } ?>
                    </ul>
                </div>

            </div>



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
                                <div class="grid-column-2">
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
    </div>
</body>

</html>