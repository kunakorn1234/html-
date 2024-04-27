<?php 
include("function.php");
$id = mysqli_real_escape_string($conn, $_POST['id']);
$mode = mysqli_real_escape_string($conn, $_POST['home']);
      if(isset($_POST["id"])) {
        $sql = "update bw_inventory SET `status`='$mode' where id='$id'";
        if($conn->query($sql) === TRUE){
          echo "Success";
          } else {
            echo "error" . $sql . "<br>".$conn->error;
          }
        }
      
?>