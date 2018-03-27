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
    <form id="registerDriverForm" method="post" action="driverRegister.php" encytpe="multipart/form-data">
          <h1>Register To Drive</h1>
          <p>Full Name</p>
          <input type="text" name="name">
          <p>Email</p>
          <input type="email" name="email">
          <p>Password</p>
          <input type="password" name="password">
          <p>Confirm Password</p>
          <input type="password" minlength="8" name="cPassword">
          <p>Phone</p>
          <input type="number" name="number">
          <p>CDL #</p>
          <input type="text" name="cdl">
          <p>Current City</p>
          <input type="text" name="city">
          <p>Years of Experience</p>
          <input type="number" name="experience">
          <p>Current State</p>
          <select name="state" id="state">
        <option value="" selected="selected">Select a State</option>
        <option value="AL">Alabama</option>
        <option value="AK">Alaska</option>
        <option value="AZ">Arizona</option>
        <option value="AR">Arkansas</option>
        <option value="CA">California</option>
        <option value="CO">Colorado</option>
        <option value="CT">Connecticut</option>
        <option value="DE">Delaware</option>
        <option value="DC">District Of Columbia</option>
        <option value="FL">Florida</option>
        <option value="GA">Georgia</option>
        <option value="HI">Hawaii</option>
        <option value="ID">Idaho</option>
        <option value="IL">Illinois</option>
        <option value="IN">Indiana</option>
        <option value="IA">Iowa</option>
        <option value="KS">Kansas</option>
        <option value="KY">Kentucky</option>
        <option value="LA">Louisiana</option>
        <option value="ME">Maine</option>
        <option value="MD">Maryland</option>
        <option value="MA">Massachusetts</option>
        <option value="MI">Michigan</option>
        <option value="MN">Minnesota</option>
        <option value="MS">Mississippi</option>
        <option value="MO">Missouri</option>
        <option value="MT">Montana</option>
        <option value="NE">Nebraska</option>
        <option value="NV">Nevada</option>
        <option value="NH">New Hampshire</option>
        <option value="NJ">New Jersey</option>
        <option value="NM">New Mexico</option>
        <option value="NY">New York</option>
        <option value="NC">North Carolina</option>
        <option value="ND">North Dakota</option>
        <option value="OH">Ohio</option>
        <option value="OK">Oklahoma</option>
        <option value="OR">Oregon</option>
        <option value="PA">Pennsylvania</option>
        <option value="RI">Rhode Island</option>
        <option value="SC">South Carolina</option>
        <option value="SD">South Dakota</option>
        <option value="TN">Tennessee</option>
        <option value="TX">Texas</option>
        <option value="UT">Utah</option>
        <option value="VT">Vermont</option>
        <option value="VA">Virginia</option>
        <option value="WA">Washington</option>
        <option value="WV">West Virginia</option>
        <option value="WI">Wisconsin</option>
        <option value="WY">Wyoming</option>
</select>
          <p>Medical</p>
          <input type="file" name="medical">
          <p>Crash Report</p>
          <input type="file" name="crash_report">
          <input class="submitBtn" type="submit" value="Submit">
      </form>

  </body>
</html>
