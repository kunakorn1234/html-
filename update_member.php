<?php
include("connect.php");
 
if(isset($_POST['field']) || $_POST['value'] != NULL){
    $field = mysqli_real_escape_string($conn,$_POST['field']);
    $value = mysqli_real_escape_string($conn,$_POST['value']);
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $query = "UPDATE `bw_user` SET  `".$field."` = '".$value."' WHERE `id`='".$id."'";
    mysqli_query($conn,$query);
    
    echo $query;
}else{
    echo 0;
}
    
    

?>