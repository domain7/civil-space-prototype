<?php
// $host = "localhost:8889"; 
$host = "d7civilspaceMSQL.db.8674772.0a2.hostedresource.net"; 
$user = "d7civilspaceMSQL"; 
$password = "M2!ivt#aXuAKybA"; 
$dbname = "d7civilspaceMSQL"; 
$id = '';

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}