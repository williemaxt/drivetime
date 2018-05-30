<?php

include_once 'connection.php';

if(isset($_POST['submit'])) {
    
    
$name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($_POST['email']);
$number = $conn->real_escape_string($_POST['number']);
$city = $conn->real_escape_string($_POST['city']);
$experience = $conn->real_escape_string($_POST['experience']);
$state = $conn->real_escape_string($_POST['state']);
$password = $conn->real_escape_string($_POST['password']);
$cPassword = $conn->real_escape_string($_POST['cPassword']);

if ($password != $cPassword)
    $msg = "Passwords do not match.";
else {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $conn->query("INSERT INTO drivers (name, email, number, password,  city, experience, state) VALUES ('$name', '$email', '$number', '$hash', '$city', '$experience', '$state');");
        header('Location: login1.php');
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Drive</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/forms.css">
</head>
<body>
<br>


<form id="registerDriverForm" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
    <h1>Register To Drive</h1>
    <p>Full Name</p>
    <input type="text" minlength="3" autocomplete="off" name="name">
    <p>Email</p>
    <input type="text" name="email" autocomplete="off" value="">
    <p>Phone</p>
    <input type="number" autocomplete="off" name="number">
    <p>Password</p>
    <input type="password" minlength="8" autocomplete="off" name="password" id="pwd" class="masked" >
    <button type="button" id="eye"> Show Password
    <img src="https://cdn0.iconfinder.com/data/icons/feather/96/eye-16.png" alt="eye" />
    </button>
    <p>Confirm Password</p>
    <input type="password" minlength="8" autocomplete="off" name="cPassword" id="pwd" class="masked">
    <p>Current City</p>
    <input type="text" autocomplete="off" name="city">
    <p>Years of Experience</p>
    <input type="number" autocomplete="off" name="experience">
    <p>Current State</p>
    <select name="state" id="state">
        <option selected="selected">Select a State</option>
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
        <input class="submitBtn" type="submit" name="submit" value="Submit">
    </select>
</form>
</body>
<script src="js/func.js"></script>
</html>
