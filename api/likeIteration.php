<?php
include "config.php";

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

$data = json_decode(file_get_contents("php://input"));

$id = $_POST["id"];
console_log($_POST);
mysqli_query($con,"UPDATE iterations SET likes = likes + 1 WHERE id ='".$id."'");
echo "Update successfully";
exit;
