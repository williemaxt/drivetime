<?php
ob_start();
error_reporting(0);
  $host = "localhost";
  $user = "id5401155_root";
  $password = "ogbytheoz";
  $db = "id5401155_drive_time";
  $connection = mysqli_connect($host,$user,$password,$db);

//Getting data from the url
  $id = $_GET["id"];
  $client_email = $_GET["client_email"];
  $client_name = $_GET["client_name"];
  $business = $_GET["business"];
  $details = $_GET["details"];
  $amount_offered = $_GET["amount_offered"];
  $driver_email = $_GET["driver_email"];

  echo $client_email;
  echo $business;
  echo $driver_email;
  echo $amount_offered;

  //// TODO: Insert into final transactions
   $connection->query("INSERT INTO final_transactions (client_email, client_name, business, details, amount_offered, driver_email) VALUES ('$client_email', '$client_name', '$business', '$details', '$amount_offered', '$driver_email');");
   $connection->query("DELETE FROM transactions where id = '$id';");
 ?>
