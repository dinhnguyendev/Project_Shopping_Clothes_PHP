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
        if(isset($_POST['fix'])){
            if(!empty($_FILES["fileimg"]["name"])){
                $target_dirs = "../uploads/";
                $imagepaths=$_FILES["fileimg"]["name"];
                // var_dump($imagepaths);exit;
                
                foreach($imagepaths as $key => $value){
                    move_uploaded_file($_FILES["fileimg"]["tmp_name"][$key], $target_dirs . $value);
                    

                }
                $deleteslider=mysqli_query($conn,"DELETE FROM `slider`");
                foreach($imagepaths as $key => $value){
                    $num=$key+1;
                    
                    $sqls=mysqli_query($conn,"INSERT INTO `slider`(`slider_id`,`slider_link`) VALUES ('$num','$value')");

                }
            }
        }
        $sqlslider=mysqli_query($conn,"SELECT * FROM `slider`");

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
                            <lord-icon src="https://cdn.lordicon.com/vlupvdhl.json" trigger="loop"
                                colors="primary:#ffffff,secondary:#e83a30" style="width:50px;height:50px">
                            </lord-icon>
                            SLIDERS
                        </div>
                        <div class="container-heading-right">
                            <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="loop"
                                colors="primary:#e86830,secondary:#ffffff" style="width:50px;height:50px">
                            </lord-icon>
                            <div class="container-heading-name">Trang Của ADMIN</div>

                        </div>

                    </div>
                </div>
                <form method="POST" action="" id="myform" enctype="multipart/form-data">
                <div class="advertisement">
                    <div class="advertisement-flex">
                        <div class="advertisement-big">
                            <input type="file" name="fileimg[]" required multiple="multiple" class="advertisement-input-file">
                            <span class="notes">Lưu ý: Đảm bảo kích thước hình ảnh(từ 1000px trở lên) </span>
                        </div>
                        <div class="advertisement-button">
                            <button name="fix" class="adds-button">
                                <span></span><span></span><span></span><span></span>
                                Sửa SLIDER
                            </button>
                        </div>
                    </div>
                    <?php while($showslider=mysqli_fetch_assoc($sqlslider)){ ?>
                    <div class="advertisement-image">
                        <div class="advertisement-number"><?php echo $showslider['slider_id'];?></div>
                        <img src="../uploads/<?php echo $showslider['slider_link'];?>"
                            alt="" class="advertisement-img">
                        
                    </div>
                    <?php } ?>


                </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>