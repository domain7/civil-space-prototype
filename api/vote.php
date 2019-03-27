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

// add idea
if($request == 1){
  $title = $_POST["title"];
  $description = $_POST["description"];
  $username = $_POST["username"];
  $email = $_POST["email"];
  mysqli_query($con,"INSERT INTO ideas(title,description,username,email) VALUES('".$title."','".$description."','".$username."','".$email."')");
  
  exit;
} elseif ($request == 2) {
  $id = $_POST["id"];
  mysqli_query($con,"UPDATE ideas SET likes = likes + 1 WHERE id ='".$id."');
  exit;

} elseif ($request == 3) {
  $id = $_POST["id"];
  mysqli_query($con,"UPDATE ideas SET likes = likes - 1 WHERE id ='".$id."');
  exit;

}