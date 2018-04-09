<?php
session_start();
require_once("connection.php");
if(isset($_POST['submit'])){
    $email = trim($_POST['email']);
    //this saves our email address in the session
    $_SESSION['username'] = $email;
    $password = trim($_POST['password']);
    $sql = "select * from clients where email = '".$email."'";
    $rs = mysqli_query($conn,$sql);
    $numRows = mysqli_num_rows($rs);
    if($numRows  == 1){
        $row = mysqli_fetch_assoc($rs);
        if(password_verify($password,$row['password'])){
            header('Location: clientdash.php');
            exit();
        }
        else{
            echo "Either your email or password are incorrect. Please try again.";
        }
    }
    else{
        echo "No User found";
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Client Login</title>
    <link rel="stylesheet" href="css/forms.css">
</head>
<body>
<br>
<form id="loginForm" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <h1>Login</h1>
    <p>Email</p>
    <input type="text" name="email" value="">
    <p>Password</p>
    <input type="password" name="password" value="">
    <input type="submit" name="submit" value="Login" class="submitBtn">
    <a style="text-align:center;" href="index.html"><p>Forgot Password?</p></a>
</form>
</body>
</html>
