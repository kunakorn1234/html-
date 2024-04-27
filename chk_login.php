<?php 
session_start();
 include('connect.php');
        if(isset($_POST['username'])){
                  $username = $_POST['username'];
                  $password = $_POST['password'];
                  $sql = "SELECT *  FROM bw_user WHERE user_id='".$username."' 
                  AND  pass='".$password."' ";
                  $result = $conn->query($sql);
                  
                  if ($result->num_rows > 0) {
                    // output data of each row
                    $row = $result->fetch_assoc();
                    $_SESSION["ID"] = $row["id"];
                    $_SESSION["name"] = $row["fname"];
                    $_SESSION["level"] = $row["role"];
                    if($_SESSION["level"] == 0){
                      Header("Location: index.php");
                    }else{
                      Header("Location: index2.php");
                    }
                    
                    
                  }else{
                    echo "<script>";
                        echo "alert(\" user หรือ  password ไม่ถูกต้อง\");"; 
                        echo "window.history.back()";
                    echo "</script>";
 
                  }
        }else{

             Header("Location: ../index.php"); //user & password incorrect back to login again
 
        }
?>