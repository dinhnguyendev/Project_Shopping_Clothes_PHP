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
         if(isset($_GET['id'])){
             $id=$_GET['id'];
         
         }else{
            header('Location:index.php');
         }
        if(isset($_POST['add'])){
            $color=$_POST['color'];
            $size=$_POST['size'];
            $number=$_POST['number'];
            $sqlinsert=mysqli_query($conn,"INSERT INTO `products_details`(`products_id`, `color_id`, `size_id`, `products_details_quantity`) 
            VALUES ('$id','$color','$size','$number')");
            if($sqlinsert){
                $sqlupdate=mysqli_query($conn,"SELECT * FROM `products_details` WHERE `products_id`=$id");
                $updatenumber=0;
                while($update=mysqli_fetch_assoc($sqlupdate)){
                    $updatenumber += $update['products_details_quantity'];
                }
                // var_dump($updatenumber);
                $sqlupdateproduct=mysqli_query($conn,"UPDATE `products` SET `products_quantity`='$updatenumber' WHERE `products_id`=$id");
                echo "<script>alert('Thêm color và size thành công.');</script>" ;
               
            }else{
                $sqlnumber=mysqli_query($conn,"SELECT * FROM `products_details` WHERE `products_id`=$id");
                $updatenumer=mysqli_fetch_all($sqlnumber);
                
                for($i=0;$i<sizeof($updatenumer);$i++){
                        $sqlupdateaddnumber=mysqli_query($conn,"UPDATE `products_details` SET
                         `products_details_quantity`='$number' WHERE products_id='$id' AND color_id='$color' AND size_id='$size' ");
                }
                $sqlupdate=mysqli_query($conn,"SELECT * FROM `products_details` WHERE `products_id`=$id");
                $updatenumber=0;
                while($update=mysqli_fetch_assoc($sqlupdate)){
                    $updatenumber += $update['products_details_quantity'];
                }
                // var_dump($updatenumber);
                $sqlupdateproduct=mysqli_query($conn,"UPDATE `products` SET `products_quantity`='$updatenumber' WHERE `products_id`=$id");
                echo "<script>alert('Sửa Sản Phẩm Thành Công.');</script>" ;
                // var_dump($updatenumer);
                // exit;
                    
                

                
            }
            
        }elseif(isset($_POST['deletecolorsize'])){
           
                $delete=$_POST['deletes'];
                // var_dump($delete);
                // exit;
                $str=explode(",",$delete);
                $ids=$str[0];
                $colors=$str[1];
                $sizes=$str[2];
                // var_dump($ids);
                // var_dump($sizes);
                
                $sqlsize=mysqli_query($conn,"SELECT * FROM `size` WHERE `size_name`='$sizes'");
                $sqlcolor=mysqli_query($conn,"SELECT * FROM `color` WHERE `color_name`='$colors'");
                $sizevalue=mysqli_fetch_assoc($sqlsize);
                $colorvalue=mysqli_fetch_assoc($sqlcolor);
                $idsize=$sizevalue['size_id'];
                $idcolor=$colorvalue['color_id'];
                // var_dump($idsize);
                // var_dump($idcolor);
                $sqldelete=mysqli_query($conn,"DELETE FROM `products_details` WHERE `products_id`=$ids
                AND `color_id`=$idcolor AND `size_id`=$idsize");
                if($sqldelete){
                    echo"<script>alert('Xóa Thành Công.');</script>";
                    
                }else{
                    echo "<script>alert('Lỗi:Sản Phẩm Đang được Mua.');</script>" ;
                }
               
               
                
        
        
            
        }
        $sql=mysqli_query($conn,"SELECT * FROM `color`");
        $sqlsize=mysqli_query($conn,"SELECT * FROM `size`");
        $sqldetails=mysqli_query($conn,"SELECT * FROM `products_details`
        INNER JOIN color ON products_details.color_id=color.color_id
        INNER JOIN size ON products_details.size_id=size.size_id WHERE products_details.products_id=$id");
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
                            CHI TIẾT SẢN PHẨM
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
                <form method="POST" action="" id="myform" enctype="multipart/form-data">
                    <div class="container-big">
                        <div class="container-conatiner">
                            <div class="container-add">
                                <div class="container-add-products-margin">

                                    <div class="container-size-color">
                                        <div class="container-color">
                                            <div class="container-name-text container-name-padding">Thêm màu sắc:
                                            </div>
                                            <div class="container-select">
                                                <select name="color" required id="" class="container-select-check">
                                                    <?php while($showcolor=mysqli_fetch_assoc($sql)){ ?>
                                                    <option class="option" value="<?php echo $showcolor['color_id'];?>">
                                                        <?php echo $showcolor['color_name'];?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="container-size">
                                            <div class="container-name-text container-name-padding">Thêm size:</div>
                                            <div class="container-select">
                                                <select name="size" required id="" class="container-select-check">

                                                    <?php while($showsize=mysqli_fetch_assoc($sqlsize)){ ?>
                                                    <option class="option" value="<?php echo $showsize['size_id'];?>">
                                                        <?php echo $showsize['size_name'];?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="container-quantity">
                                            <div class="container-name-text container-name-padding">Nhập Số lượng:</div>
                                            <div class="container-text">
                                                <input type="number" required name="number" min="1" max="99999999"
                                                    class="container-input" placeholder="số lượng">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="addcolorsize-button">
                                        <button name="add" class="adds-button">
                                            <span></span><span></span><span></span><span></span>
                                            Thêm sản phẩm
                                        </button>

                                    </div>
                                </div>
                                </form>
                                <div class="addcolorsize-big">
                                    <form method="POST" action=""  enctype="multipart/form-data">

                                    <div class="addcolorsize">
                                        <div class="addcolorsize-id">ID</div>
                                        <div class="addcolorsize-color">Màu Sắc</div>
                                        <div class="addcolorsize-size">Size</div>
                                        <div class="addcolorsize-quantity">Số Lượng</div>
                                        <div class="addcolorsize-activity">Thao Tác</div>
                                    </div>
                                    <div class="addcolorsize-flex">
                                    <?php while($showproducrsdetails=mysqli_fetch_assoc($sqldetails)){ ?>
                                        <div class="addcolorsize-container">
                                            <div class="addcolorsize-id"><?php echo $showproducrsdetails['products_id'];?></div>
                                            <div class="addcolorsize-color"><?php echo $showproducrsdetails['color_name'];?></div>
                                            <div class="addcolorsize-size"><?php echo $showproducrsdetails['size_name'];?></div>
                                            <div class="addcolorsize-quantity"><?php echo $showproducrsdetails['products_details_quantity'];?></div>
                                            <div class="addcolorsize-activity">
                                                <button name="deletecolorsize" class="addcolorsize-activity-btn">Xóa</button>
                                            </div>
                                            <input type="hidden" name="deletes" value="<?php echo $showproducrsdetails['products_id'];?>,<?php echo $showproducrsdetails['color_name'];?>,<?php echo $showproducrsdetails['size_name'];?>" class="input-hidden">
                                        </div>
                                    <?php } ?>
                                    </div>

                                </form>
                                </div>
                            </div>
                        </div>




                    </div>

                
            </div>
        </div>
    </div>
    <script src="./js/addcolorsize.js"></script>
</body>


</html>