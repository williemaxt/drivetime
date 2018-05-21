<?php
ob_start();
require "init.php";
//this will remove error reporting
error_reporting(0);
//this section of the code has been written with "isset" to prevent "Undefined index" error
$user_name = isset($_POST["login_name"]) ? $_POST["login_name"]: '';
$user_pass = isset($_POST["login_pass"]) ? $_POST["login_pass"]: '';
//this will hash our password string so that the query can compare it

$sql_query = "select * from drivers where email like '$user_name' and password like '$user_pass';";

$result = mysqli_query($con,$sql_query);

if(mysqli_num_rows($result) >0 )
{

  //Get the id of the data
  	$id = $_GET["id"];

    while ($row = mysqli_fetch_assoc($result)) {
      //naming the array
  		$array[] = $row;
  	}

    ob_end_flush();
    error_reporting( error_reporting() & ~E_NOTICE );
    echo json_encode($array);

}
else
{
echo "Login Failed.......Try Again..";
}
?>
