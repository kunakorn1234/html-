<?php
	ob_start();
	require 'function.php';	
?>
<script src="chosen/docsupport/jquery-3.2.1.min.js" type="text/javascript"></script>
	 <script type="text/javascript">
  $(document).ready(function() {

    $(".addItemBtn").click(function(e) {
      e.preventDefault();
      var $form = $(this).closest(".form-submit");
      var pid = $form.find(".pid").val();
      var pname = $form.find(".pname").val();
      var pprice = $form.find(".pprice").val();
      $(".p-"+pid).css({"background-color": "#d5f4e6"});
      $.ajax({
        url: 'action.php',
        method: 'post',
        data: {
          pid: pid,
          pname: pname,
          pprice: pprice,
     
        },
        success: function(response) {
          $("#message").html(response);
          window.scrollTo(0, 0);
          load_cart_item_number();
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'action.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  
  </script>
<?php

	if (isset($_GET['pid'])) {
		$parade  = $_GET['pid'];
		$sql = "SELECT * FROM `st_item` WHERE item_job = '".$parade."' AND item_status = '1'";
		$result = $conn->query($sql);
		$row_cnt = $result->num_rows;
		if ($row_cnt > 0) {
		while($row = $result->fetch_assoc()) {
			$sql_in = "INSERT INTO cart (id_item, id_job, id_parade , status)
			VALUES ('".$row['id']."', '".$row['item_job']."', '".$row['item_parade']."' , 2)";
			 $conn->query($sql_in) === TRUE;
			} //End While
			?>
			<script type="text/javascript">
				alert("บันทึกข้อมูลของท่านเรียบร้อยแล้ว!");
				window.location = "cart.php";
			</script>
			<?php
		}else{
			//echo $sql;
			//echo $row_cnt; 
			?>
			<script type="text/javascript">
				alert("ขออภัยไม่สามารถบันทึกข้อมูลของท่านได้");
				window.location = "cart.php";
			</script>
			<?php
		}
	}
	// Add products into the cart table
	if (isset($_POST['pid'])) {
	  
		$pid = $_POST['pid'];
		$pname = $_POST['pname'];
		$pprice = $_POST['pprice'];
  
		$stmt = $conn->prepare("SELECT id_item FROM cart WHERE id_item='".$pid."'");
		$res = $conn->query($stmt);
		$r = $res->fetch_assoc();
		if ($res->num_rows > 0) {
			$query = $conn->prepare('INSERT INTO cart (id_item,id_job,id_parade) VALUES (?,?,?)');
			$query->bind_param('sss',$pid,$pprice,$pname);
			$query->execute();
	
			echo '<div class="alert alert-success alert-dismissible mt-2">
							  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  <strong>รายการนี้ถูกเพิ่มเรียบร้อยแล้ว</strong>
							</div>';
		  } else {
			echo '<div class="alert alert-danger alert-dismissible mt-2">
							  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  <strong>ขออภัย คุณไม่สามารถ เพิ่มรายการนี้ได้ เนื่องจากถูกเพิ่มไปเรียบร้อยแล้ว </strong>
							</div>';
		  }
	  
	 
	 
	}

	// Get no.of items available in the cart table
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	  $stmt = $conn->prepare('SELECT * FROM cart WHERE status =2 AND list = 0');
	  $stmt->execute();
	  $stmt->store_result();
	  $rows = $stmt->num_rows;
	  echo $rows;
	}

	if (isset($_GET['remove'])) {
	  $id = $_GET['remove'];

	  $stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
	  $stmt->bind_param('i',$id);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'รายการนี้ถูกลบเรียบร้อยแล้ว !';
	  header('location:cart.php');
	}

	
	if (isset($_GET['rmcpl'])) {
		$id = $_GET['rmcpl'];
  
		$stmt = $conn->prepare('DELETE FROM bw_category WHERE id=?');
		$stmt->bind_param('i',$id);
		$stmt->execute();
  
		?>
		<script type="text/javascript">
		alert("รายการนี้ถูกลบเรียบร้อยแล้ว");
		window.location = "category_list.php";
		</script>
		<?php
	  }

	  if (isset($_GET['rmli'])) {
		$id = $_GET['rmli'];
		$sql = "DELETE FROM bw_borrow WHERE id = '".$id."'";

		if ($conn->query($sql) === TRUE) {
		?>
			<script type="text/javascript">
			alert("รายการนี้ถูกลบเรียบร้อยแล้ว");
			window.location = "list.php";
			</script>
		<?php
		} else {
			?>
			<script type="text/javascript">
			alert("เกิดข้อผิดพลาดในการลบข้อมูล");
			window.location = "list.php";
			</script>
		<?php
		}
	  }

	  if (isset($_GET['up'])) {
		$id = $_GET['up'];
		$sql = "UPDATE bw_borrow
		SET status = 1,
		date_return = current_timestamp()
		WHERE id = '".$id."';";

		if ($conn->query($sql) === TRUE) {
		?>
			<script type="text/javascript">
			alert("รายการนี้ถูกคืนเรียบร้อยแล้ว");
			window.location = "list.php";
			</script>
		<?php
		} else {
			?>
			<script type="text/javascript">
			alert("เกิดข้อผิดพลาดในการคืนข้อมูล");
			window.location = "list.php";
			</script>
		<?php
		}
	  }

	  if (isset($_GET['ys'])) {
		$id = $_GET['ys'];
		$sql = "UPDATE bw_borrow
		SET status = 0,
		date_return = current_timestamp()
		WHERE id = '".$id."';";

		if ($conn->query($sql) === TRUE) {
		?>
			<script type="text/javascript">
			alert("รายการนี้ถูกอนุมติเรียบร้อยแล้ว");
			window.location = "list.php";
			</script>
		<?php
		} else {
			?>
			<script type="text/javascript">
			alert("เกิดข้อผิดพลาดในการอนุมติข้อมูล");
			window.location = "list.php";
			</script>
		<?php
		}
	  }
	

	  if (isset($_GET['remem'])) {
		$id = $_GET['remem'];
		$sql = "DELETE FROM bw_user WHERE id = '".$id."'";

		if ($conn->query($sql) === TRUE) {
		?>
			<script type="text/javascript">
			alert("รายการนี้ถูกลบเรียบร้อยแล้ว");
			window.location = "member_list.php";
			</script>
		<?php
		} else {
			?>
			<script type="text/javascript">
			alert("เกิดข้อผิดพลาดในการลบข้อมูล");
			window.location = "member_list.php";
			</script>
		<?php
		}
	  }

	  if (isset($_GET['rmpd'])) {
		$id = $_GET['rmpd'];
		$sql = "DELETE FROM bw_inventory WHERE id = '".$id."'";

		if ($conn->query($sql) === TRUE) {
		?>
			<script type="text/javascript">
			alert("รายการนี้ถูกลบเรียบร้อยแล้ว");
			window.location = "product_list.php";
			</script>
		<?php
		} else {
			?>
			<script type="text/javascript">
			alert("เกิดข้อผิดพลาดในการลบข้อมูล");
			window.location = "product_list.php";
			</script>
		<?php
		}
	  }

	  if (isset($_GET['rmf'])) {
		$id = $_GET['rmf'];
  
		$stmt = $conn->prepare('DELETE FROM st_item WHERE id=?');
		$stmt->bind_param('i',$id);
		$stmt->execute();
  
		?>
		<script type="text/javascript">
		alert("รายการนี้ถูกลบเรียบร้อยแล้ว");
		window.location = "flim.php";
		</script>
		<?php
	  }
	  if (isset($_GET['rmff'])) {
		$id = $_GET['rmff'];
  
		$stmt = $conn->prepare('DELETE FROM st_item WHERE id=?');
		$stmt->bind_param('i',$id);
		$stmt->execute();
  
		?>
		<script type="text/javascript">
		//alert("รายการนี้ถูกลบเรียบร้อยแล้ว");
		history.go(-1);
		</script>
		<?php
	  }



	if (isset($_GET['removegb'])) {
		$id = $_GET['removegb'];
	  
		$stmt = $conn->prepare('DELETE FROM st_getback WHERE id=?');
		$stmt->bind_param('i',$id);
		$stmt->execute();
	  
		$_SESSION['showAlert'] = 'block';
		$_SESSION['message'] = 'รายการนี้ถูกลบเรียบร้อยแล้ว !';
		header('location:chk_gb.php');
	 }

	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		$sql = "SELECT * FROM  `cart` WHERE doc='".$id."'";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)) {
			$sql_up = "UPDATE `st_item`                    
					SET  `item_status`='1'
	 				WHERE `id`='".$row['id_item']."';";
			 $conn->query($sql_up) === TRUE; //Update Status
		}
	
		$stmt = $conn->prepare('DELETE FROM cart WHERE list=?');
		$stmt->bind_param('i',$id);
		$stmt->execute();
  
		$_SESSION['showAlert'] = 'block';
		$_SESSION['message'] = 'เอกสารนี้ถูกลบเรียบร้อยแล้ว !';
		header('location:withdraw.php');
	  }

	  if (isset($_GET['delinput'])) {
		$id = $_GET['delinput'];
		$stmt = $conn->prepare('DELETE FROM `st_item` WHERE id_doc_item=?');
		$stmt->bind_param('i',$id);
		$stmt->execute();
  
		$_SESSION['showAlert'] = 'block';
		$_SESSION['message'] = 'เอกสารนี้ถูกลบเรียบร้อยแล้ว !';
		header('location:check_list_product.php');
	  }

	  if (isset($_GET['delgb'])) {
		$id = $_GET['delgb'];
		$sql = "SELECT * FROM  `st_getback` WHERE list='".$id."'";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)) {
			$sql_up = "UPDATE `st_item`                    
					SET  `item_status`='0'
	 				WHERE `id`='".$row['id_item']."';";
			 $conn->query($sql_up) === TRUE; //Update Status
		}
	
		$stmt = $conn->prepare('DELETE FROM st_getback WHERE list=?');
		$stmt->bind_param('i',$id);
		$stmt->execute();
  
		$_SESSION['showAlert'] = 'block';
		$_SESSION['message'] = 'เอกสารนี้ถูกลบเรียบร้อยแล้ว !';
		header('location: getback.php');
	  }
	// Remove all items at once from cart
	if (isset($_GET['clear'])) {
	  $stmt = $conn->prepare('DELETE FROM cart WHERE status = 2');
	  $stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'ลบรายการทั้งหมดเรียบร้อยแล้ว';
	  header('location:cart.php');
	}

	// Remove all items at once from cart
	if (isset($_GET['select'])) {
		
		$stmt = $conn->prepare('UPDATE  cart SET  check_item=1 WHERE status = 2');
		$stmt->execute();
		$_SESSION['showAlert'] = 'block';
		$_SESSION['message'] = 'ลบรายการทั้งหมดเรียบร้อยแล้ว';
		header('location:cart.php');
	  }

    if(isset($_GET['doc'])){
        $json = file_get_contents($url);
        $json = json_decode($json);
        echo $json;
    }

?>