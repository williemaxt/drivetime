<?php


    if(isset($_POST['submit'])) {
        $con = new mysqli('localhost','root','password','drive_time');

        $name = $con->real_escape_string($_POST['name']);
        $email = $con->real_escape_string($_POST['email']);
        $number = $con->real_escape_string($_POST['number']);
        $password = $con->real_escape_string($_POST['password']);
        $cPassword = $con->real_escape_string($_POST['cPassword']);
        $medical = $con->real_escape_string($_POST['medical']);
        $crash_report = $con->real_escape_string($_POST['crash_report']);

        if ($password != $cPassword)
        $msg = "Passwords do not match.";
        else {
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $con->query("INSERT INTO drivers (name, email, number, password, medical, crash_report) VALUES ('$name', '$email', '$number', '$hash', '$medical', '$crash_report')");
            $msg = "You have been registered!";

            //ADD DASHBOARD REDIRECT HERE...
    }


    //$sql = "INSERT INTO drivers (name, email, number, password, medical, crash_report) VALUES ('$name', '$email', '$number', '$password', '$medical', '$crash_report');";
    //mysqli_query($conn, $sql);
    //take us back home after submission
    // header("Location: allcode.php?commit=success");

}
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
      <?php if ($msg != "")echo $msg . "<br><br>" ?>
      <form id="registerDriverForm" method="post" action="driverRegister.php">
          <h1>Register To Drive</h1>
          <p>Full Name</p>
          <input type="text" minlength="3" name="name">
          <p>Email</p>
          <input type="email" name="email">
          <p>Password</p>
          <input type="password" minlength="8" name="password">
          <p>Confirm Password</p>
          <input type="password" minlength="8" name="cPassword">
          <p>Phone</p>
          <input type="number" name="number">
          <p>Medical</p>
          <input type="file" name="medical">
          <p>Crash Report</p>
          <input type="file" name="crash_report">
          <input class="submitBtn" type="submit" name="submit" value="Submit">
      </form>

  </body>
</html>
