<?php
  include "init.php";
  $name = $_POST['name'];
  $email = $_POST['email'];
  $number = $_POST['number'];
  
  // TODO: $hash = password__hash($password, PASSWORD_DEFAULT)

  $sql = "INSERT INTO `drivers` (`id`,`name`, `email`, `number`) VALUES (NULL,'$name','$email','$number');";
  if(mysqli_query($con,$sql) === TRUE){
    echo "One row inserted";
  }
  else{
    echo "Error in connection" . mysqli_connect_error();
  }
