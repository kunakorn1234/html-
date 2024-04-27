<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("function.php");
$sqls = "SELECT id FROM `bw_inventory` ORDER BY id DESC";
$res = mysqli_query($conn , $sqls);
$max = mysqli_fetch_assoc($res);


$sql = "SELECT * FROM `bw_inventory` WHERE in_id = '".$_GET['id']."'";
$result = mysqli_query($conn , $sql);
$row = mysqli_fetch_assoc($result);

$id_new = $max['id'] +1;
//echo $id_new;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Stock || Store Management</title>

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
<script>
    // jQuery ".Class" SELECTOR.
    $(document).ready(function() {
          // Show Input element
    $('.edit').click(function(){
     $('.txtedit').hide();
     $(this).next('.txtedit').show().focus();
     $(this).hide();
 });

// Save data
$(".txtedit").on('focusout',function(){
     
     var id = this.id;
     var split_id = id.split("-");
     var field_name = split_id[0];
     var edit_id = split_id[1];
     var value = $(this).val();

     $(this).hide();

     // Hide and Change Text of the container with input elmeent
     $(this).prev('.edit').show();
     $(this).prev('.edit').text(value);

            $.ajax({
                url: 'update_product.php',
                type: 'post',
                data: { field:field_name, value:value, id:edit_id },
                success:function(response){
                    //alert(response);
                }
            });
 
        });    
    });
   
    
  
</script>


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
                    <h3>เพิ่มข้อมูลคลังสินค้า</h3>
                        
       
                        <p class="text-subtitle text-muted">กรุณากรอกข้อมูลให้ถูกต้อง</p>
                </div>
            <section id="multiple-column-form">
        <div class="row match-height">
      
            <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                <h4 class="card-title" align="center">ข้อมูลทั่วไป</h4>
                </div>
                <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal" method="POST" action="insert/insert_product.php">
                    <div class="form-body">
                        <div class="row">


                                <div class="col-md-2">
                                <label>วันที่ลงข้อมูล : </label>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                    <input class="form-control" placeholder="ระบุวันที่เริ่มต้น" type="text" name="dt" data-provide="datepicker" data-date-language="th-th">
                                        <div class="form-control-icon">
                                            <i data-feather="target"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>        
                        <div class="col-md-2">
                                <label>รหัสสินค้า : </label>
                            </div>
                            <input type="hidden" class="form-control" value="<?=$id_new?>" name="id" >
                            <div class="col-md-10">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" value="<?=$row['in_id']?>" placeholder="รหัสสินค้า" id="id_si" name="id_si" required="true" readonly>
                                        <div class="form-control-icon">
                                            <i data-feather="target"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label>ชื่อสินค้า : </label>
                            </div>
                     
                            <div class="col-md-10">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="ชื่อสินค้า" value="<?=$row['topic']?>" id="name" name="name" required="true" readonly>
                                        <div class="form-control-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                    <label>ประเภท :</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <select class="form-control" id="type" name="type" required="true" readonly>
                                                <?php
                                                $sqltype = "SELECT * FROM bw_category WHERE id='".$row['category_id']."'";
                                                $resultr = mysqli_query($conn , $sqltype);
                                                while($rowr = mysqli_fetch_assoc($resultr)){
                                                    ?>
                                                            <option value="<?=$rowr['id']?>"><?=$rowr['name']?></option>
                                                    <?php
                                                }
                                                ?>
                                          
                                            </select>
                                            <div class="form-control-icon">
                                                <i data-feather="map-pin"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label>ราคา :</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                        <input type="text" class="form-control" value="<?=$row['price']?>" placeholder="ราคา" id="price" name="price" required="true" readonly>
                                            <div class="form-control-icon">
                                                <i data-feather="dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <label>จำนวน :</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                        <input type="number" class="form-control"  placeholder="จำนวน" id="num" name="num" required="true">
                                            <div class="form-control-icon">
                                                <i data-feather="box"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                           
                        
                          
                          

                        <div class="col-12 d-flex justify-content-end ">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                        </div>
                        
                    </form>
                </div>
                </div>
        </div>
    </section>
    

  
        <?php
        include("footer.php")
        ?>

        </div>
    </div>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/bootstrap-datepicker-thai.js"></script>
    <script src="js/locales/bootstrap-datepicker.th.js"></script>

    <script id="example_script"  type="text/javascript">
      function demo() {
        $('.datepicker').datepicker();
      }
    </script>
<script>

$(document).ready(function(){
    $('#table1').on("change", 'input[type="checkbox"]', function (event) {
        
       var home = $(this).is(':checked') ? 0 : 1;

        var id = $(this).val();
       // alert(home);
       // alert(id);
        $.ajax({
             url:"do_switch2.php",
             method:"POST",
             data:{home:home,id:id,},
             success: function(data){
                window.location = "product_list.php";
                
            },
       });

   });
});

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
