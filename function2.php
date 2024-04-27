<?php 
@session_start();
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
error_reporting(E_ALL ^ E_NOTICE); 
include("connect.php");
function check_login () {
    if(isset($_SESSION['ID'])) {
       return true;
    } else {
       false;
    }
}

function toDateThai($d){
    $return = "";
    $yy = date("Y",strtotime($d));
    $yy = $yy + 543;
    $return = date("d/m/",strtotime($d)).$yy;
    return $return;
}

function mysql_date($date){
    if($date!=""){
        $exp=explode("/",$date);
        $year = $exp[2] - 543;
        return $year."-".$exp[1]."-".$exp[0];		
    }else{
        return "";
    }
}

function export_data_to_csv($data, $filename = 'export', $delimiter = ';', $enclosure = '"') {
    header("Content-disposition: attachment; filename=$filename.csv");
    header("Content-Type: text/csv");

    // I open PHP memory as a file
    $fp = fopen("php://output", 'w');
    fputs($fp, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
    fputcsv($fp, array_keys($data[0]), $delimiter, $enclosure);
    foreach ($data as $fields) {
        fputcsv($fp, $fields, $delimiter, $enclosure);
    }
    fclose($fp);
    die();
}

function active($currect_page){
    $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
    $url = end($url_array);  
    if($currect_page == $url){
    echo 'active'; //class name in css 
   } 
}

function replace($match){
    $key = trim($match[1]);
    $val = trim($match[2]);

    if($val[0] == '"')
        $val = '"'.addslashes(substr($val, 1, -1)).'"';
    else if($val[0] == "'")
        $val = "'".addslashes(substr($val, 1, -1))."'";

    return $key.": ".$val;
}


function sendLineNotify($message)
{
    $token = "cDvUHGPqplUHmg4By27y3Sr1IudrKTGWB6uJmuen4op"; 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "message=" . $message);
    $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $token . '',);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);

    if (curl_error($ch)) {
        echo 'error:' . curl_error($ch);
    } else {
        $res = json_decode($result, true);
        echo "status : " . $res['status'];
        echo "message : " . $res['message'];
    }
    curl_close($ch);
}

function chkrole($num){
    if($num == 1){
        $str = "พิมพ์";
    }elseif($num == 2){
        $str = "ดราย";
    }elseif($num == 3){
        $str = "ตัด";
    }
    elseif($num == 4){
        $str = "สลิต";
    }else{
        $str = "พิมพ์";
    }


    return $str;
}
if(check_login()) {
    
  } else {
      header('Location: ../index.php');
      exit;
  }

?>