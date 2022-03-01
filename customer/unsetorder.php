<?php 
    require_once 'conect.php';
    session_start();
    if(isset($_SESSION['customer'])){
        $customer=$_SESSION['customer'];
        $phone=$customer['customers_phone'];
        $query=mysqli_query($conn,"SELECT * FROM `customers` WHERE `customers_phone`=$phone");
        $queryorder=mysqli_query($conn,"SELECT * FROM `orders` WHERE `customers_phone`=$phone ORDER BY `orders_id` ASC");
       
        $user=mysqli_fetch_assoc($query);
       
        
    }else{
        header('Location:login.php');
    }
    if(isset($_GET['ids'])){
        $orderid=$_GET['ids'];

        $queryinsert=mysqli_query($conn,"SELECT * FROM `orders_details` 
        INNER JOIN products ON orders_details.products_id=products.products_id
        WHERE orders_details.orders_id=$orderid");
        $assoc=mysqli_fetch_assoc($queryinsert);
        $img=$assoc['products_image'];
        $imgname=$assoc['products_name'];
        // var_dump($img);
        // exit;
        $title="Bạn vừa hủy một đơn hàng !!! ";
        $name="Đơn hàng sản phẩm  Đã hủy thành công ";
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('H:i:s d-m-Y');
        // var_dump($phone);
        // var_dump($img);
        // var_dump($title);
        // var_dump($name);
        // var_dump($date);
        
        // exit;
       
        $querynoti=mysqli_query($conn,"INSERT INTO `notification`( `customers_phone`, `notification_img`, `notification_title`, `notification_name`, `notification_date_start`)
         VALUES ('$phone','$img','$title','$name','$date')");
        
        $querydetails=mysqli_query($conn,"DELETE FROM `orders_details` WHERE `orders_id`=$orderid");
        $queryorder=mysqli_query($conn,"DELETE FROM `orders` WHERE `orders_id`=$orderid");
        
        if($querynoti && $querydetails && $queryorder){
            header('Location:order.php');
        }else{
            echo "<script>alert('Lỗi xóa');</script>" ;
        }

    }else{
        header('Location:account.php.php');
    }

?>