<?php
include("function.php");
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
      $(document).ready(function() {
    
          $('.fc').change(function(){
            var id = this.id;
            var split_id = id.split("-");
            var field_name = split_id[0];
            var edit_id = split_id[1];
            var value = $(this).val();
          //  alert(id);
            $.ajax({
                url: 'update.php',
                type: 'post',
                data: { field:field_name, value:value, id:edit_id },
                success:function(response){
                //    alert(response);
                }
            });

          });
      });
    </script>
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

            // Sending AJAX request
            $.ajax({
                url: 'update_category.php',
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
                    <h3>เพิ่มข้อมูลหมวดหมู่</h3>
                        
       
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
                    <form class="form form-horizontal" method="POST" action="insert/insert_category.php">
                    <div class="form-body">
                        <div class="row">
                     
                            <div class="col-md-2">
                                <label> ใส่ชื่อหมวด : </label>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="ใส่ชื่อหมวด" id="CateName" name="CateName" required="true">
                                        <div class="form-control-icon">
                                            <i data-feather="user"></i>
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
       
            <div class="main-content container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>จัดการหมวด</h3>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <table class='table table-striped' id="table1">
                                <thead>
                                    <tr>
                                   
                                        <th>รหัส</th>
                                        <th>ชื่อหมวด</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_data">
                                <?php
                                $sql = "SELECT * FROM bw_category ORDER BY `id` DESC";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                         <td><?=$row['id'] ?></td>
                                            <td>
                                            <div class="edit"><?=$row['name']?></div>
                 <input type="text" id="name-<?=$row['id']?>" value="<?=$row['name']?>" class="form-control txtedit" style="display:none">
                                            </td>
                                  
                                        <td> <a href="action.php?rmcpl=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('คุณต้องการลบ รายการนี้ใช่หรือไม่ ?');"><i data-feather="trash"></i></a></td>
                                        
                                        
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
