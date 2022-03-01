<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/base.css" >

</head>
<body>
    <?php require_once 'conect.php';
            session_start();
            if(isset($_SESSION['customer'])){
                $customer=$_SESSION['customer'];
                $phone=$customer['customers_phone'];
                $query=mysqli_query($conn,"SELECT * FROM `customers` WHERE `customers_phone`=$phone");
                $user=mysqli_fetch_assoc($query);
                $querynotication=mysqli_query($conn,"SELECT * FROM `notification` WHERE `customers_phone`=$phone ORDER BY `notification_id` DESC");
                // var_dump($user['customers_password']);
                $querycustomer=mysqli_query($conn,"SELECT `customers_avatar` FROM `customers` WHERE `customers_phone`=$phone");
                $showavatar=mysqli_fetch_assoc($querycustomer);
            }else{
                header('Location:login.php');
            }
            $error=[];
            if(isset($_POST['change'])){
                $pwnow=$_POST['password-now'];
                $pwnew=$_POST['password-new'];
                $pwrepeat=$_POST['password-repeat'];
                $passwordverify=password_verify($pwnow,$user['customers_password']);
                if($pwnew !=$pwrepeat){
                    $error['1']="Nhập lại mật khẩu chưa đúng";
                }
                if(!$passwordverify){
                    $error['2']="Mật khẩu hiện tại sai.";
                    
                }
                if(empty($error)){
                    $hashpw=password_hash($pwnew, PASSWORD_DEFAULT);
                    $inser=mysqli_query($conn,"UPDATE `customers` SET `customers_password`='$hashpw'
                     WHERE `customers_phone`=$phone");
                    if($inser){
                        echo "<script>alert('Thay Đổi Mật Khẩu Thành Công');</script>" ;
                    }
                }
            }
            if(isset($_SESSION['cart'])){
                $numbercart=sizeof($_SESSION['cart']);
                // var_dump($numbercart);exit;
            }else{
                $numbercart=0;
            }
    ?>
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
                                                    <img src="<?php echo $shownoti['notification_img'] ;?>"
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
<form method="POST" action="" id="myform" enctype="multipart/form-data">
    <div class="app-account">
        <div class="app-account-notifi"></div>
        <div class="grid-account">
            <div class="app-account-space">
                <div class="grid-column-number-2">
                    <div class="account-navbar">
                        <div class="account-navbar-heading">
                            <?php if(!empty($user['customers_avatar'])) { ?>
                                <img src="uploads/<?php echo $user['customers_avatar'] ;?>"
                                    alt="" class="account-navbar-heading-img">
                            <?php } else{ ?>
                                <img src="./img/avatar.png"
                                    alt="" class="account-navbar-heading-img">
                            <?php } ?>
                            <div class="account-navbar-heading-text">
                                <div class="account-navbar-heading-name">
                                    beaxbox
                                </div>
                                <a href="" class="account-navbar-heading-link">
                                    <i class="fas fa-pencil-alt"></i>
                                    Sửa hồ sơ
                                </a>
                            </div>
                        </div>
                        <div class="account-navbar-container">
                            <div class="account-navbar-container-list">
                                <div class="account-navbar-container-flex">
                                    <a href="account.php" class="account-navbar-container-heading">
                                        <img src="https://cf.shopee.vn/file/ba61750a46794d8847c3f463c5e71cc4" alt=""
                                            class="account-navbar-container-image">
                                        <div class="account-navbar-container-heading-text">
                                            Tài khoản của tôi
                                        </div>
                                    </a>

                                </div>
                                <div class="account-navbar-container-item">
                                    <div class="account-navbar-container-item-list">
                                        <a href="account.php" class="account-navbar-container-link">Hồ sơ</a>
                                    </div>
                                    <div class="account-navbar-container-item-list">
                                        <a href="password.php" class="account-navbar-container-link">Đổi mật khẩu</a>
                                    </div>
                                </div>
                            </div>
                            <div class="account-navbar-container-orther">
                                <a href="order.php" class="account-navbar-container-orther-link">
                                    <img src="https://cf.shopee.vn/file/f0049e9df4e536bc3e7f140d071e9078" class="account-navbar-container-image">
                                    <div class="account-navbar-container-orther-text">Đơn Mua</div>
                                </a>
        
                            </div>
                            <div class="account-navbar-container-notifition">
                                <a href="notification.php" class="account-navbar-container-notifition-link">
                                    <img src="https://cf.shopee.vn/file/e10a43b53ec8605f4829da5618e0717c"
                                        class="account-navbar-container-notify-img">
                                    <div class="account-navbar-container-notifition-text">Thông Báo</div>
                                </a>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="grid-column-number-10">
                    <div class="account-password">
                        <div class="account-password-heading">
                            <div class="account-password-heading-heading">Đổi mật khẩu</div>
                            <div class="account-password-text">
                                Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác
                            </div>
                        </div>
                        
                        <div class="account-password-container">
                            <div class="account-password-container-now">
                                <div class="account-password-container-nows">
                                    <div class="account-password-container-nows-text">
                                        <label for="" class="account-password-container-label">Mật khẩu hiện tại</label>
                                    </div>
                                    <div class="account-password-container-nows-input">
                                        <input type="text" name="password-now" required class="account-password-container-nows-input-passwordnow">
                                    </div>
                                </div>
                                <div class="error-notificatio"><?php echo isset($error['2'])?$error['2']:"" ;?></div>
                                <div class="account-password-container-nows">
                                    <div class="account-password-container-nows-text">
                                        <label for=""  class="account-password-container-label">Mật khẩu mới</label>
                                    </div>
                                    <div class="account-password-container-nows-input">
                                        <input type="text" name="password-new" required  class="account-password-container-nows-input-passwordnow">
                                    </div>
                                </div>
                                <div class="error-notificatio"><?php echo isset($error['1'])?$error['1']:"" ;?></div>
                                <div class="account-password-container-nows">
                                    <div class="account-password-container-nows-text">
                                        <label for="" class="account-password-container-label">Xác nhận mật khẩu</label>
                                    </div>
                                    <div class="account-password-container-nows-input">
                                        <input type="text" name="password-repeat" required class="account-password-container-nows-input-passwordnow">
                                    </div>
                                </div>
                                
                                <div class="account-password-container-submit">
                                    <div class="account-password-container-submit-space"></div>
                                    <div class="account-password-container-button">
                                        <button name="change" class="account-password-container-btn account-password-container-btn-not">Xác nhận</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="footer-brg-text">
        <div class="hr"></div>
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
</form>
    <script src="./javascript/password.js">
</body>
</html>