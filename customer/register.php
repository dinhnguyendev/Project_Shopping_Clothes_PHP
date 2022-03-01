<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./css/main.css">
<link rel="stylesheet" href="./css/base.css" >
</head>
<body>
    <?php
        require_once 'conect.php';
        $error=[];
        if(isset($_POST['register'])){
            $names=$_POST['names'];
            $phone=$_POST['phone'];
            $password=$_POST['password'];
            $retypepassword=$_POST['retypepassword'];
            $querys=mysqli_query($conn,"SELECT * FROM `customers` WHERE `customers_phone`='$phone'");
            $account=mysqli_fetch_assoc($querys);
            if(mysqli_num_rows($querys)>0){
                $error['phonesss']="Số Điện Thoại Này Đã Được Đăng Kí.";
            }
            if(empty($names)){
                $error['names']="Bạn Chưa Nhập Tên Đăng Nhập.";
            }
            if(empty($phone)){
                $error['ephone']="Bạn Chưa Nhập Số Điện Thoại.";
            }
            if(empty($password)){
                $error['epassword']="Bạn Chưa Nhập Password.";
            }
            if(empty($retypepassword)){
                $error['eretypepassword']="Bạn Chưa Nhập lại Password.";
            }
            if($password !=$retypepassword){
                $error['errors']="Password nhập lại chưa đúng.";
            }
            if(empty($error)){
                $hasspassword=password_hash($password, PASSWORD_DEFAULT);
            //    var_dump( $hasspassword);
            //    exit;
                $querys=mysqli_query($conn,"INSERT INTO `customers`(`customers_name`,`customers_phone`,`customers_password`) VALUES ('$names','$phone','$hasspassword')");
                if($querys){
                    header('Location:login.php');
                }
            }

        }


    ?>

    <div class="header-register">
        
            <div class="grid-register">
                    <div class="header-register-header">
                        <a href="index.php" class="header-register-header-link">
                            <img src="./img/shopping-logo-svgrepo-com.svg" alt="" class="header-register-image">
                            <div class="header-register-text-logo">SHOPPING</div>

                        </a>
                        <div class="header-register-text">Đăng Ký</div>
                    </div>
                   
                
            </div>

       

    </div>

<form method="POST" action="" id="myformregister" >

    <div class="container-register">
        <div class="grid-register">
            <div class="container-register-brg">
                <div class="container-register-form">
                    <div class="container-form">
                        <div class="form-register">
                            <div class="form-register-text">
                                Đăng Ký
                            </div>
                            <div class="form-register-notification">
                                <div class="form-register-form-input">
                                    <input type="text" name="names" class="form-register-input" placeholder="Tên Đăng Nhập">
                                </div>
                                <div class="register-notityfication"><?php echo isset($error['names'])?$error['names']:"" ;?></div>
                            </div>
                            <div class="form-register-notification">
                                <div class="form-register-form-input">
                                    <input type="text" name="phone" class="form-register-input form-register-input-js" placeholder="Số điện thoại">
                                </div>
                                <div class="register-notityfication"><?php echo isset($error['ephone'])?$error['ephone']:"" ;?></div>
                                <div class="register-notityfication"><?php echo isset($error['phonesss'])?$error['phonesss']:"" ;?></div>
                            </div>
                            <div class="form-register-notification">
                                <div class="form-register-form-input">
                                    <input type="text" name="password" class="form-register-input" placeholder="Tạo mật khẩu">
                                </div>
                                <div class="register-notityfication"><?php echo isset($error['epassword'])?$error['epassword']:"" ;?></div>
                            </div>
                            <div class="form-register-notification">
                                <div class="form-register-form-input">
                                    <input type="text" name="retypepassword" class="form-register-input form-register-input-js" placeholder="Nhập lại mật khẩu">
                                </div>
                                <div class="register-notityfication"><?php echo isset($error['eretypepassword'])?$error['eretypepassword']:"" ;?></div>
                                <div class="register-notityfication"><?php echo isset($error['errors'])?$error['errors']:"" ;?></div>
                            </div>
                        
                        </div>
                        <div class="form-register-container-button">
                            <button name="register" class="form-register-button-submit">ĐĂNG KÝ</button>

                        </div>
                        <div class="form-register-or">
                            <div class="form-register-space">
                                <div class="form-register-space-1"></div>
                                <div class="form-register-space-text">HOẶC</div>
                                <div class="form-register-space-1"></div>
                            </div>
                            <div class="form-register-conect">
                                <div class="form-register-button">
                                    <i class="fab fa-facebook form-register-button-logo"></i>
                                    <div class="form-register-button-text">Facebook</div>
                                </div>
                                <div class="form-register-button">
                                    <i class="fab fa-google form-register-button-logo"></i>
                                    <div class="form-register-button-text">Google</div>
                                </div>
                                <div class="form-register-button-button">
                                    <i class="fab fa-apple form-register-button-logo-logo"></i>
                                    <div class="form-register-button-text-text">Apple</div>
                                </div>
                            </div>
                            <div class="form-register-submit-text">
                                    <div class="form-register-submit-text-item">
                                        Bằng việc đăng kí, bạn đã đồng ý với Shopping về<br>
                                    <a href="https://shopee.vn/legaldoc/termsOfService/?__classic__=1" class="form-register-submit-text-item-link">Điều khoản dịch vụ</a>
                                        &
                                    <a href="https://shopee.vn/legaldoc/privacy/?__classic__=1" class="form-register-submit-text-item-link">Chính sách bảo mật</a>
                                </div>
                            </div>


                        </div>
                        <div class="form-register-login">
                            <div class="form-register-submit-text-item-text">Bạn đã có tài khoản?</div>
                            <a href="login.php" class="form-register-login-link">Đăng nhập</a>
                        </div>    

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</form>
    <div class="footer-brg">
        <div class="grid">
            <footer class="footer">
                <div class="grid-column">
                    <div class="grid-row-footer">
                        <div class="grid-column-footer-2">
                            <h5>CHĂM SÓC KHÁCH HÀNG</h5>
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
                            <h5>VỀ SHOPPING</h5>
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
                            <h5>THANH TOÁN</h5>
                            <ul class="footer-list footer-list-icon">
                                <li class="footer-list-item "><img class="foter-list-imtem-img" src="./img/logo1.png" alt=""></li>
                                <li class="footer-list-item "><img class="foter-list-imtem-img" src="./img/logo2-removebg-preview.png" alt=""></li>
                                <li class="footer-list-item "><img class="foter-list-imtem-img" src="./img/logo3-removebg-preview.png" alt=""></li>
                                <li class="footer-list-item "><img class="foter-list-imtem-img" src="./img/logo4.png" alt=""></li>
                                <li class="footer-list-item "><img class="foter-list-imtem-img" src="./img/logo5-removebg-preview.png" alt=""></li>
                                <li class="footer-list-item "><img class="foter-list-imtem-img" src="./img/logo6-removebg-preview.png" alt=""></li>
               
                            </ul>
                            <div class="footer-logistic">ĐƠN VỊ VẬN CHUYỂN</div>
                            <ul class="footer-list footer-list-icon-logistic">
                                <li class="footer-list-item "><img class="foter-list-imtem-img" src="./img/SPX__Shopee_Express__Logo_-_Free_Vector_Download_PNG-removebg-preview.png" alt=""></li>
                                <li class="footer-list-item "><img class="foter-list-imtem-img" src="./img/giao-hang-tiet-kiem-removebg-preview.png" alt=""></li>
                                <li class="footer-list-item "><img class="foter-list-imtem-img" src="./img/logo_ghn.png" alt=""></li>
                                <li class="footer-list-item "><img class="foter-list-imtem-img" src="./img/logo-viettelpost-removebg-preview.png" alt=""></li>
                                <li class="footer-list-item "><img class="foter-list-imtem-img" src="./img/logo-vietnampost-removebg-preview.png" alt=""></li>
                                <li class="footer-list-item "><img class="foter-list-imtem-img" src="./img/logo_jt_E-removebg-preview.png" alt=""></li>
                                <li class="footer-list-item "><img class="foter-list-imtem-img" src="./img/logo_GrapE-removebg-preview.png" alt=""></li>
                                <li class="footer-list-item "><img class="foter-list-imtem-img" src="./img/logo_ninjavansvg.svg" alt=""></li>
                                <li class="footer-list-item "><img class="foter-list-imtem-img" src="./img/logo_bestE-removebg-preview.png" alt=""></li>
                            </ul>

                        </div>
                        <div class="grid-column-2">
                            <h5>THEO DÕI CHÚNG TÔI TRÊN</h5>
                            <ul class="footer-list-list">
                                <li class="footer-list-item"><a class=" footer-list-item-link" href="https://www.facebook.com/">
                                        <div class="footer-icon">
                                            <i class="fab fa-facebook footer-list-item-icon-link"></i>
                                        </div>
                                        <div class="text-big">
                                            Facebook
                                        </div>
                                    </li>
                                </a>
                                <li class="footer-list-item footer-list-item-link "><a class=" footer-list-item-link" href="https://www.instagram.com/">
                                    <div class="footer-icon">
                                        <i class="fab fa-instagram footer-list-item-icon-link"></i>
                                    </div>
                                    <div class="text-big">
                                        Instagram
                                    </div>
                                </li>
                                </a>
                                <li class="footer-list-item footer-list-item-link "><a class=" footer-list-item-link" href="https://www.linkedin.com/"> 
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
                            <h5>TẢI ỨNG DỤNG NGAY THÔI</h5>
                            <div class="footer-dowload">
                                <div class="footer-qr">
                                    <a href="" class="footer-qr-img"><img class="footer-qr-img-dowload" src="./img/qr.png" alt=""></a>
                                </div>
                                <div class="footer-app">
                                    <ul class="footer-list-dowload">
                                        <li class="footer-list-item-dowload"><img class="footer-list-item-dowload-text" src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg//assets/39f189e19764dab688d3850742f13718.png" alt=""></li>
                                        <li class="footer-list-item-dowload-space"><img class="footer-list-item-dowload-text"src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg//assets/f4f5426ce757aea491dce94201560583.png" alt=""></li>
                                        <li class="footer-list-item-dowload footer-list-item-dowload-space"><img class="footer-list-item-dowload-text"src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg//assets/1ae215920a31f2fc75b00d4ee9ae8551.png" alt=""></li>
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
                <img src="./img/4bdefde103e8aa245cd17511adde9f89-removebg-preview.png" alt="" class="footer-address-image-item-item">
            </div>
            <div class="footer-shopping">Công ty TNHH Shopping</div>
        </div>
    </div>
    <script src="./javascript/resgister.js"></script>
</body>
</html>