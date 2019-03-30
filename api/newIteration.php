<?php
include "config.php";

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

$data = json_decode(file_get_contents("php://input"));

$request = $_POST["request"];

console_log($_POST);


$comment = $_POST["comment"];
$ideaID = $_POST["ideaID"];
$username = $_POST["username"];
$email = $_POST["email"];
mysqli_query($con,"INSERT INTO iterations(comment,ideaID,username) VALUES('".$comment."','".$ideaID."','anonymous')");
  
exit;
