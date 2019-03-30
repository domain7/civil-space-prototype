<?php
include "config.php";

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

$data = json_decode(file_get_contents("php://input"));

$request = $_POST["request"];


$comment = $_POST["comment"];
$ideaID = $_POST["ideaID"];


console_log($comment);
console_log($ideaID);

  mysqli_query($con,"INSERT INTO iterations (comment,idea_id,username,date_submitted) VALUES('".$comment."','".$ideaID."','anonymous', NOW())");
  echo "Update successfully";
exit;
