<?php
$token = "drcjxDhEujLVx1SGYa9WAxQBBVY1ZAABJAa6cKLNHtL"; //ทำ Token 

$mes = "TEST API LINE"; //ข้อความ
$res = notify_message($mes , $token);
function notify_message($message)
{
    $token = "drcjxDhEujLVx1SGYa9WAxQBBVY1ZAABJAa6cKLNHtL"; //ทำ Token 

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
    }
    curl_close($ch);
}

?>