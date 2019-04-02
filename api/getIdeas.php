<?php
include "config.php";


$userData = mysqli_query($con,"select a.id, a.title, a.description, a.username, a.email, a.likes, a.dislikes, (SELECT COUNT(*) FROM iterations WHERE idea_id = a.id) AS iterationCount from ideas as a ORDER BY a.likes DESC");

$response = array();

while($row = mysqli_fetch_assoc($userData)){

   $response[] = $row;
}

echo json_encode($response);
exit;