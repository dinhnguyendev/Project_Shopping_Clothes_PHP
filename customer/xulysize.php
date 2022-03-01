<?php 
    require_once 'conect.php';
  
    if(isset($_GET['sizes'])){
        $sizes=$_GET['sizes'];
       
        // echo $cl;
       
        // $sql=mysqli_query($conn,"")

    }
    if( isset($_GET['idproducts'])){
      
        $idproducts=$_GET['idproducts'];
       
        
        // $sql=mysqli_query($conn,"")

    }
    $sql=mysqli_query($conn,"SELECT * FROM `products_details` INNER JOIN size ON products_details.`size_id`=size.size_id
     WHERE size.size_name='$sizes' AND products_details.products_id=$idproducts");
    
    if($sql){
        $showcolorss=array();
        while($showsize=mysqli_fetch_assoc($sql)){
        //    var_dump($showcl['size_id']);
            $a[]=$showsize['color_id'];
        //    var_dump($a);
           foreach($a as $key =>$vlaue){
               $sqlss=mysqli_query($conn,"SELECT * FROM `color` WHERE `color_id`=$vlaue");
           }
           
           while($showcolor=mysqli_fetch_assoc($sqlss)){
                // $showsizess=$showsize;
               array_push($showcolorss, $showcolor);
            }
            
            
          


       }
       echo json_encode($showcolorss);

    }
?>