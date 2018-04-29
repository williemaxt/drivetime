<?php


if(isset($_POST['submit'])) {
    $con = new mysqli('localhost','root','root','drive_time');

   // $name = $con->real_escape_string($_POST['name']);
   // $email = $con->real_escape_string($_POST['email']);
   // $number = $con->real_escape_string($_POST['number']);
   // $password = $con->real_escape_string($_POST['password']);
    //$cPassword = $con->real_escape_string($_POST['cPassword']);


    if ($password != $cPassword)
        $msg = "Passwords do not match.";
    else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        //Prepared statement below. Stops injections.
        $stmt = $con->prepare("INSERT INTO clients (name, email, number, bname, baddr, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name,  $email, $number, $bname, $baddr, $hash );
        //$con->query("INSERT INTO clients (name, email, number, password) VALUES ('$name', '$email', '$number', '$hash')");
        $msg = "You have been registered!";


        $name = $con->real_escape_string($_POST['name']);
        $email = $con->real_escape_string($_POST['email']);
        $number = $con->real_escape_string($_POST['number']);
        $password = $con->real_escape_string($_POST['password']);
        $cPassword = $con->real_escape_string($_POST['cPassword']);
        $bname = $con->real_escape_string($_POST['bname']);
        $baddr = $con->real_escape_string($_POST['baddr']);
        $stmt->execute();

    }


    //$sql = "INSERT INTO clients (name, email, number, password) VALUES ('$name', '$email', '$number', '$password');";
    //mysqli_query($conn, $sql);
    //take us back home after submission
    // header("Location: allcode.php?commit=success");

}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Register</title>
      <link rel="stylesheet" href="css/main.css">
      <link rel="stylesheet" href="css/forms.css">
  </head>
  <body>

      <br>
      <form id="registerClientForm" method="post" action="clientRegister.php">
          <h1>Register To Use</h1>
          <p>Full Name</p>
          <input type="text" minlength="3" autocomplete="off" name="name">
          <p>Email</p>
          <input type="email" autocomplete="off" name="email">
          <p>Phone</p>
          <input type="number" autocomplete="off" name="number">
          <p>Business Name</p>
          <input type="text" autocomplete="off" name="bname">
          <p>Business Address</p>
          <input type="text" autocomplete="off" name="baddr">
          <p>Password</p>
          <input type="password" minlength="8" autocomplete="off" name="password">
          <p>Confirm Password</p>
          <input type="password" minlength="8" autocomplete="off" name="cPassword">
          <input class="submitBtn" type="submit" name="submit" value="Submit">
      </form>

  </body>
</html>
