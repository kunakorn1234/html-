<?php
 $servername = "localhost";
 $database = "stockiyn_all";
 $username = "stockiyn_all"; 
 $password = "EpFDlH6FJ";

$conn = new mysqli($servername, $username, $password, $database);

// Change character set to utf8
$conn -> set_charset("utf8");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


?>
