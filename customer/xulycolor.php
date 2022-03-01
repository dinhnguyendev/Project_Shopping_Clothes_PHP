<?php 
    require_once 'conect.php';
  
    if(isset($_GET['color'])){
        $cl=$_GET['color'];
       
        // echo $cl;
       
        // $sql=mysqli_query($conn,"")

    }
    if( isset($_GET['idpr'])){
      
        $idpr=$_GET['idpr'];
       
        
        // $sql=mysqli_query($conn,"")

    }
    $sql=mysqli_query($conn,"SELECT * FROM `products_details` INNER JOIN color ON products_details.color_id=color.color_id
    WHERE color.color_name='$cl' AND products_details.products_id=$idpr");
    
    if($sql){
        $showsizess=array();
       while( $showcl=mysqli_fetch_assoc($sql)){
        //    var_dump($showcl['size_id']);
           $a[]=$showcl['size_id'];
        //    var_dump($a);
           foreach($a as $key =>$vlaue){
               $sqlss=mysqli_query($conn,"SELECT * FROM `size` WHERE `size_id`=$vlaue");
           }
           
           while($showsize=mysqli_fetch_assoc($sqlss)){
                // $showsizess=$showsize;
               array_push($showsizess, $showsize);
            }
            
            // var_dump($showsizess);
            // var_dump("###########################");
            // echo json_encode($showsizess);
          


       }
       echo json_encode($showsizess);

    }
?>