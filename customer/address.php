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
    <?php 
        require_once 'conect.php';
        session_start();
        if(isset($_SESSION['customer'])){
            $customer=$_SESSION['customer'];
            // var_dump($customer);
            $address=$customer['customers_phone'];
            
            
        }else{
            header('Location:login.php');
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
            
           
            // var_dump($addressphone);
            // var_dump($addresscity);
            // var_dump($addressdistrict);
            // var_dump($addressdistrictdetails);

            $sql=mysqli_query($conn,"INSERT INTO `addresses`(`customers_phone`, `addresses_name_customer`, `addresses_phone`, `addresses_name`) 
            VALUES ('$address','$addressname','$addressphone','$addresscity , $addressdistrict , $addressdistrictdetails')");
            if($sql){
                header('Location:pay.php');
            }

            
            
                
            
            
            
           
        }
        


     ?>
<form method="POST" action="" id="myformorder" >
 
    <div class="modal-app">
        <div class="app-pay">
            <div class="app-pay-big">
                <div class="app-pay-heading">Địa chỉ mới</div>
                <div class="app-pay-information">
                    <input type="text" name="address-name" placeholder="Họ và tên" class="app-pay-information-name"
                        required>
                    <input type="text" name="address-phone" placeholder="Số điện thoại"
                        class="app-pay-information-phone" required>
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
                    <input type="text" name="address-district-details" placeholder="Địa chỉ cụ thể" required
                        class="app-pay-address-details-check">
                </div>
                <div class="app-pay-button">
                    <a href="pay.php" class="app-pay-btn-back">Trở Lại</a>
                    <button name="addressadd" class="app-pay-btn-submit">Hoàn thành</button>
                </div>

            </div>
        </div>
    </div>
</form>
</body>

</html>