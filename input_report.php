<?php
include("function.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Technic Gravure Store System</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link href="css/datepicker.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="chosen/docsupport/jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="chosen/chosen.jquery.js" type="text/javascript"></script>
  <link rel="stylesheet" href="chosen/chosen.css">
  
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
                    <h3>รายงานคลังสินค้า</h3>
                        
          
                
                    <section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" align="center">หากต้องการดูทั้งหมด กรุณากด Submit</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-horizontal" method="POST" action="excel_stock_product.php">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="type_a">เลือกสถานะ:</label>
                                        <select class="form-control" id="type_a" name="type_a" required="true">
                                            <option value="0">มีปัญหา</option>
                                            <option value="1">ปกติ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="stdt">ตั้งแต่วันที่:</label>
                                        <input class="form-control" placeholder="ระบุวันที่เริ่มต้น" type="text" name="stdt" data-provide="datepicker" data-date-language="th-th">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="enddt">ถึงวันที่:</label>
                                        <input class="form-control" placeholder="ระบุวันที่สิ้นสุด" type="text" name="enddt" data-provide="datepicker" data-date-language="th-th">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </form>
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
    <script>
        feather.replace()
        </script>
   <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/bootstrap-datepicker-thai.js"></script>
    <script src="js/locales/bootstrap-datepicker.th.js"></script>

    <script id="example_script"  type="text/javascript">
      function demo() {
        $('.datepicker').datepicker();
      }
    </script>

    <script type="text/javascript">
      $(function(){
        $('pre[data-source]').each(function(){
          var $this = $(this),
            $source = $($this.data('source'));

          var text = [];
          $source.each(function(){
            var $s = $(this);
            if ($s.attr('type') == 'text/javascript'){
              text.push($s.html().replace(/(\n)*/, ''));
            } else {
              text.push($s.clone().wrap('<div>').parent().html()
                .replace(/(\"(?=[[{]))/g,'\'')
                .replace(/\]\"/g,']\'').replace(/\}\"/g,'\'') // javascript not support lookbehind
                .replace(/\&quot\;/g,'"'));
            }
          });
          
          $this.text(text.join('\n\n').replace(/\t/g, '    '));
        });

        prettyPrint();
        demo();
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
