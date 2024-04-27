<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("function.php");
$sqls = "SELECT id FROM `bw_inventory` ORDER BY id DESC";
$res = mysqli_query($conn , $sqls);
$max = mysqli_fetch_assoc($res);

$id_new = $max['id'] +1;
//echo $id_new;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Stock || Store Management </title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <script src="assets/js/feather-icons/feather.min.js"></script>

  <link rel="stylesheet" href="chosen/chosen.css">
  <script src="chosen/docsupport/jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="chosen/chosen.jquery.js" type="text/javascript"></script>
 <style>

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 30px;
}
.switch input {display:none;}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}
.slider:before {
  position: absolute;
  content: "";
  height: 24px;
  width: 24px;
  left: 4px;
  bottom: 3px;
  background-color: white;
  -webkit-transition: .2s;
  transition: .2s;
}
input:checked + .slider {
  background-color: green;
}
input:focus + .slider {
  box-shadow: 0 0 1px green;
}
input:checked + .slider:before {
  -webkit-transform: translateX(28px);
  -ms-transform: translateX(28px);
  transform: translateX(28px);
}
/* Rounded sliders */
.slider.round {
  border-radius: 28px;
}
.slider.round:before {
  border-radius: 50%;
}
.box {
  margin: 25px;
  border: 1px solid #ccc;
  width: 300px;
  padding: 0px 30px 30px 30px;
  background-color: white;
}

     </style>
</head>

<body>

    <div id="app">
        <?php
        include("menu.php");
        ?>
        <div id="main">
        <?php
        include("navbar.php");
        ?>

  
    
            <div class="main-content container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>การทำรายการ</h3>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <table class='table table-striped' id="table1">
                                <thead>
                                    <tr>
                                 
                                        <th>ชื่อสินค้า</th>
                                        <th>จำนวน</th>
                                        <th>หมายเหตุ</th>
                                        <th>ชื่อผู้ทำรายการ</th>
                                        <th>วันที่เข้าคลัง</th>
                                        <th>สถานะ</th>
                                    
                                    </tr>
                                </thead>
                                <tbody id="table_data">

                                
                                <?php
                                $sql = "SELECT * FROM `bw_borrow`  order by id desc ";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)) {

                                  if(isset($row['date_return'])){

                                 

                                    $sql_cat = "SELECT * FROM bw_inventory WHERE id ='".$row["inven_id"]."'";
                                    $resulcat = mysqli_query($conn , $sql_cat);
                                    $rowc = mysqli_fetch_assoc($resulcat);

                                    $sql_cas = "SELECT * FROM bw_user WHERE id ='".$row["user_id"]."'";
                                    $resulcats = mysqli_query($conn , $sql_cas);
                                    $rows = mysqli_fetch_assoc($resulcats);

                                
                                
                                    ?>
                                    <tr>
                                   
                                        <td><?=$rowc["topic"];?></td>
                                        <td><?=$row["qty"];?></td>
                                        <td><?=$row["pos"];?></td>
                                        <td><?=$rows['fname']?> <?=$rows['lname']?></td>
                                        <td><?=toDateThai($row["date_return"]);?></td>
                                     
                                        <td><span class="badge bg-success">ปกติ</span></td>
                                  
                                    </tr>
                                  
                               
                                    <?php
                                }
                              }

                                $sql = "SELECT `id` , `category_id` , `topic` , `qr` , `date_input` , `in_id` , `price` , `status` ,count_stock FROM bw_inventory  ORDER BY id;";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)) {
                                    $sql_cat = "SELECT * FROM bw_category WHERE id ='".$row["category_id"]."'";
                                    $resulcat = mysqli_query($conn , $sql_cat);
                                    $rowc = mysqli_fetch_assoc($resulcat);

                                    $sql_n = "SELECT SUM(`qty`) AS sqty FROM bw_borrow WHERE inven_id ='".$row['id']."' AND status = 0 AND qty IS NOT NULL;";
                                    $resulsn = mysqli_query($conn , $sql_n);
                                    $rown = mysqli_fetch_assoc($resulsn);
                               
                                    $stock = $row['count_stock'] - $rown['sqty'];
                                    if($row['status'] == 0){
                                        $chk = "checked";
                                        $span = '<span class="badge bg-danger">มีปัญหา</span>';
                                    }else{
                                        $chk = "";
                                        $span = '<span class="badge bg-success">ปกติ</span>';
                                    }
                                    ?>
                                    <tr>
                                        <td><?=$row['topic']?></td>
                                        <td><?=$row["count_stock"];?> </td>
                                        <td>เข้าจากคลัง</td>
                                        <td>Admin</td>
                                        <td><?=toDateThai($row["date_input"]);?></td>     
                                        <td><span class="badge bg-success">ปกติ</span></td>
                                        
                                    </tr>
                                 
                                    <?php
                                }
                                ?>

                          
                               
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>

  
        <?php
        include("footer.php")
        ?>

        </div>
    </div>
    <script>
        feather.replace()
        </script>

   
  <script src="chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script src="chosen/docsupport/init.js" type="text/javascript" charset="utf-8"></script>
  
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="assets/js/vendors.js"></script>

    <script src="assets/js/main.js"></script>


</body>

</html>
