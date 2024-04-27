<?php 
include_once('function.php'); 
include('Classes/PHPExcel.php');

$objPHPExcel	=	new	PHPExcel();

if($_POST['stdt'] != ""){
 
    $sql2 = "SELECT * FROM `bw_inventory` WHERE `date_input` BETWEEN '".mysql_date($_POST['stdt'])."' AND '".mysql_date($_POST['enddt'])."'  AND `status` = '".$_POST['type_a']."';";
}else{
  
    $sql2 = "SELECT * FROM `bw_inventory`;";
}

$result2 = $conn->query($sql2);
  
  $objPHPExcel->setActiveSheetIndex(0); 
  $objPHPExcel->getActiveSheet(0)->setTitle("สรุปรวม");
  $objPHPExcel->getActiveSheet(0)->SetCellValue('A1', 'ลำดับ');
  $objPHPExcel->getActiveSheet(0)->SetCellValue('B1', 'วันที่ทำรายการ');
  $objPHPExcel->getActiveSheet(0)->SetCellValue('C1', 'ชื่อสินค้า');
  $objPHPExcel->getActiveSheet(0)->SetCellValue('D1', 'รหัสสินค้า');
  $objPHPExcel->getActiveSheet(0)->SetCellValue('E1', 'จำนวนคงคลัง'); 
  $objPHPExcel->getActiveSheet(0)->SetCellValue('F1', 'ราคาเฉลี่ยต่อหน่วย'); 
  $objPHPExcel->getActiveSheet(0)->SetCellValue('G1', 'มูลค่าสินค้าคงเหลือ'); 
 


  $objPHPExcel->getActiveSheet(0)->SetCellValue('I1', "ข้อมูลตั้งแต่ ".mysql_date($_POST['stdt'])." ถึง " .mysql_date($_POST['enddt']));
  $sheet = $objPHPExcel->getActiveSheet(0);
$sheet->getColumnDimension('A')->setWidth(15);
$sheet->getColumnDimension('B')->setWidth(35);
$sheet->getColumnDimension('C')->setWidth(35);
$sheet->getColumnDimension('D')->setWidth(15);
$sheet->getColumnDimension('E')->setWidth(15);
$sheet->getColumnDimension('F')->setWidth(15);
$sheet->getColumnDimension('G')->setWidth(15);
$sheet->getColumnDimension('H')->setWidth(15);
$sheet->getColumnDimension('I')->setWidth(15);
$i = 1;

$objPHPExcel->getActiveSheet(0)->getStyle("A1:I1")->getFont()->setBold(true);
$rowCount	=	2;
while($row2	=	$result2->fetch_assoc()){

    $sql_in = "SELECT * FROM `bw_category`  WHERE id = '".$row2['category_id']."'" ;
    $resin = mysqli_query($conn , $sql_in);
    $rowin = mysqli_fetch_assoc($resin);

    $sql_in = "SELECT SUM(`qty`) AS sqty  FROM `bw_borrow`  WHERE id = '".$row2['user_id']."'" ;
    $resin = mysqli_query($conn , $sql_in);
    $rowin = mysqli_fetch_assoc($resin);

    $stock = $row2['count_stock'] - $rowin['sqty'];
    $value = $stock * $row2['price'];
    $sval = number_format($value, 2);
    $objPHPExcel->getActiveSheet(0)->SetCellValue('A'.$rowCount, mb_strtoupper($i,'UTF-8'));
	$objPHPExcel->getActiveSheet(0)->SetCellValue('B'.$rowCount, mb_strtoupper(toDateThai($row2['date_input']),'UTF-8'));
    $objPHPExcel->getActiveSheet(0)->SetCellValue('C'.$rowCount, mb_strtoupper($row2['topic'],'UTF-8'));
    $objPHPExcel->getActiveSheet(0)->SetCellValue('D'.$rowCount, mb_strtoupper($row2['in_id'],'UTF-8'));
    $objPHPExcel->getActiveSheet(0)->SetCellValue('E'.$rowCount, mb_strtoupper($stock,'UTF-8'));
    $objPHPExcel->getActiveSheet(0)->SetCellValue('F'.$rowCount, mb_strtoupper($row2['price'],'UTF-8'));
    $objPHPExcel->getActiveSheet(0)->SetCellValue('G'.$rowCount, mb_strtoupper($sval,'UTF-8'));


	$rowCount++;
    $i++;
}

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
// We'll be outputting an excel file
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="Report.xlsx"');
$objWriter->save('php://output');
?>