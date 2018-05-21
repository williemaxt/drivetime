<?php
$host = "localhost";
$user = "id5401155_root";
$password = "ogbytheoz";
$db = "id5401155_drive_time";

$con = mysqli_connect($host,$user,$password,$db);

if(!$con){
  die("Error in connection" . mysqli_connect_error());
}

else{
  //echo "Connection Success";
}
 ?>
