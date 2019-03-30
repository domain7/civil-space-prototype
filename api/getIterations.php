<?php
include "config.php";

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

$condition = "";
if(isset($_GET['ideaID'])){
   $condition = $_GET['ideaID'];
}

// console_log($condition);

$iterationData = mysqli_query($con,"select * from iterations WHERE idea_id = ".$condition);

$response = array();

while($row = mysqli_fetch_assoc($iterationData)){
   $response[] = $row;
}
// console_log(sizeof($response));
echo json_encode($response);
exit;