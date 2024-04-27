<?php
include("function.php");
$sqlsu = "SELECT COUNT('id') AS cid FROM `bw_inventory`";
$resu = mysqli_query($conn , $sqlsu);
$rowsu = mysqli_fetch_assoc($resu);

$sqls = "SELECT COUNT('id') AS cid FROM `bw_user`";
$res = mysqli_query($conn , $sqls);
$rows = mysqli_fetch_assoc($res);

$sqlsss = "SELECT COUNT('id') AS cid  FROM `bw_borrow`";
$resss = mysqli_query($conn , $sqlsss);
$rowss = mysqli_fetch_assoc($resss);


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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <style>
    
@import url(https://unpkg.com/@webpixels/css@1.1.5/dist/index.css);

/* Bootstrap Icons */
@import url("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.0/font/bootstrap-icons.min.css");
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
                    <h3>Dashboard</h3>
                        <p class="text-subtitle text-muted"></p>
                </div>
                <section class="section">
                        <!-- Card stats -->
                <div class="row g-6 mb-6">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">จำนวนอุปกรณ์</span>
                                        <span class="h3 font-bold mb-0"><?=$rowsu['cid']?> รายการ</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white text-lg rounded-circle">
                                            <i class="bi bi-minecart-loaded"></i>
                                        </div>
                                    </div>
                                </div>
                           
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">จำนวนผู้ใช้งาน</span>
                                        <span class="h3 font-bold mb-0"><?=$rows['cid']?> user</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                                            <i class="bi bi-people"></i>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">จำนวนการทำรายงาน</span>
                                        <span class="h3 font-bold mb-0"><?=$rowss['cid']?> รายการ</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white text-lg rounded-circle">
                                            <i class="bi bi-clock-history"></i>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">สินค้ามีปัญหา</span>
                                        <span class="h3 font-bold mb-0">- รายการ</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white text-lg rounded-circle">
                                            <i class="bi bi-arrow-bar-down"></i>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                 
                
                </section>


               
            </div>
        <?php
        include("footer.php")
        ?>
         
        </div>
    </div>
 
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/vendors/chartjs/Chart.min.js"></script>
    <script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>