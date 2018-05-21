
<?php
ob_start();
error_reporting(0);
  $host = "localhost";
  $user = "id5401155_root";
  $password = "ogbytheoz";
  $db = "id5401155_drive_time";
  $connection = mysqli_connect($host,$user,$password,$db);
//Get the id of the data
	$id = $_GET["id"];
  $username = $_GET["username"];
  $id1 = $id+1;
  $id4 = $id+100;
  //this query will select from all transactions
	//$query = "SELECT * FROM transactions WHERE id BETWEEN ($id+1) AND ($id+4)";
  //// TODO: select all rows where data equals our email
  $query = "SELECT * FROM transactions WHERE (id BETWEEN $id1 AND $id4) AND driver_email LIKE '$username'";
	$result = mysqli_query($connection,$query);
	while ($row = mysqli_fetch_assoc($result)) {
    //naming the array
		$array[] = $row;
	}
	//header('Content-Type:Application/json');
  ob_end_flush();
	echo json_encode($array);
 ?>
