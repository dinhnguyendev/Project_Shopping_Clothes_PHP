<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>success</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

    <link rel="stylesheet" href="./css/success.css">

</head>

<body>
    <?php 
        session_start();
            if(isset($_SESSION['customer'])){
                $customer=$_SESSION['customer'];
                // var_dump($customer);
                $address=$customer['customers_phone'];
               
                
            }else{
                header('Location:login.php');
            }
    
    ?>
    <div class="success">
        <div class="success-flex">
            <div class="success-flex-incon">
                <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop"
                    colors="primary:#000000,secondary:#ffffff" style="width:250px;height:250px">
                </lord-icon>
            </div>
            <div class="success-flex-text">
                Đặt hàng thành công
            </div>
        </div>
        <div class="success-text">
            Cùng Shopping bảo vệ quyền lợi của bạn - chỉ nhận hàng &<br /> thanh toán khi đơn hàng ở trạng thái "Đang
            giao
            hàng".
        </div>
        <div class="success-button">
            <div class="success-btn-home">
                <a href="index.php" class="success-btn-home-link">Trang chủ</a>
            </div>
            <div class="success-btn-order">
                <a href="order.php" class="success-btn-order-link">Đơn mua</a>
            </div>

        </div>

    </div>
</body>

</html>