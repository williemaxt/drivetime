<?php
    require "init.php";
    error_reporting(0);
    $user_name = isset($_POST["login_name"]) ? $_POST["login_name"]: '';
    $user_pass = isset($_POST["login_pass"]) ? $_POST["login_pass"]: '';
  $sql = "select * from drivers where email = '".$user_name."'";
  $rs = mysqli_query($con,$sql);
  $numRows = mysqli_num_rows($rs);
  if($numRows  == 1){
      $row = mysqli_fetch_assoc($rs);
      if(password_verify($user_pass,$row['password'])){
        //IF THE PASSWORD IS CORRECT
        //SELECT ALL FROM USER WITH SPECIFIED EMAIL
        $sql_query = "SELECT * FROM drivers WHERE email LIKE '$user_name';";
        //THIS VARIABLE IS EQUAL TO THE RESULT OF THE QUERY
        $result = mysqli_query($con,$sql_query);
        if(mysqli_num_rows($result) >0)
        {
          //Get the id of the data
          	$id = $_GET["id"];

            while ($row = mysqli_fetch_assoc($result)) {
              //naming the array
          		$array[] = $row;
          	}
            //echoing the json array to the device
            echo json_encode($array);
        }
      }
      else{
          echo "Either your email or password are incorrect. Please try again.";
      }
  }
?>
