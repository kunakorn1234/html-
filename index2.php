<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("function2.php");
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
    <title>E-Office || Borrow && Office Tools </title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <script src="assets/js/feather-icons/feather.min.js"></script>

  <link rel="stylesheet" href="chosen/chosen.css">
  <script src="chosen/docsupport/jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="chosen/chosen.jquery.js" type="text/javascript"></script>

    <div id="app">
        <?php
        include("menu2.php");
        ?>
        <div id="main">
        <?php
        include("navbar.php");
        ?>

        
            <div class="main-content container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>ทะเบียนสินค้า</h3>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <table class='table table-striped' id="table1">
                                <thead>
                                    <tr>
                                 
                                        <th>รหัสสินค้า</th>
                                        <th>ชื่อสินค้า</th>
                                        <th>ชื่อหมวด</th>
                                        <th>จำนวนที่มี</th>
                                        <th>จำนวนยอดคงเหลือ</th>
                                 
                       
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_data">
                                <?php
                                $stock = 0;
                                $sql = "SELECT * FROM bw_inventory ";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)) {
                                    $sql_cat = "SELECT * FROM bw_category WHERE id ='".$row["category_id"]."'";
                                    $resulcat = mysqli_query($conn , $sql_cat);
                                    $rowc = mysqli_fetch_assoc($resulcat);

                                    $sql_n = "SELECT SUM(`qty`) AS sqty FROM bw_borrow WHERE inven_id ='".$row['id']."' AND status = 0 AND qty IS NOT NULL;";
                                    $resulsn = mysqli_query($conn , $sql_n);
                                    $rown = mysqli_fetch_assoc($resulsn);
                               
                                    $stock = $row['count_stock'] - $rown['sqty'];
                                    ?>
                                    <tr>
                                   
                                        <td><?=$row["in_id"];?></td>
                                        <td><?=$row['topic']?></td>
                                        <td><?=$rowc["name"];?></td>
                                        <td><?=$row['count_stock']?></td>
                                 <td>
                                        <?=$stock?>
                                </td> 

                                
                                        <td>
                                            <?php
                                            if($stock == 0){
                                                ?>
                                            สินค้าหมด
                                               <?php
                                            }else{
                                                ?>
                                                 <a href="borrow2.php?pid=<?=$row["id"];?>" type="button" class="btn btn-success" >
                                            ยืม 
                                </a> 
                                                <?php
                                            }
                                            ?>
                                   
                                  </td>
                                        
                                        
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
