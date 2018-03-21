<?php 
include_once 'connection.php';
    //inserting the form inputs as variables
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $medical = $_POST['medical'];
    $crash_report = $_POST['crash_report'];
    #this line above (line 6) is saying post the commit date variable into sql table
    #this line below (line 8) is telling the commit date variable what the format is for both the date and time.
    $sql = "INSERT INTO drivers (name, email, number, medical, crash_report) VALUES ('$name', '$email', '$number', '$medical', '$crash_report');";
    mysqli_query($conn, $sql);
    //take us back home after submission
   // header("Location: allcode.php?commit=success");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Drive</title>
      <link rel="stylesheet" href="css/main.css">
      <link rel="stylesheet" href="css/forms.css">
  </head>
  <body>
      <br>
      <form id="registerDriverForm" method="post" action="driverRegister.php">
          <h1>Register To Drive</h1>
          <p>Full Name</p>
          <input type="text" name="name">
          <p>Email</p>
          <input type="email" name="email">
          <p>Password</p>
          <input type="password" name="password">
          <p>Phone</p>
          <input type="number" name="number">
          <p>Medical</p>
          <input type="file" name="medical">
          <p>Crash Report</p>
          <input type="file" name="crash_report">
          <input class="submitBtn" type="submit" value="Submit">
      </form>

  </body>
</html>