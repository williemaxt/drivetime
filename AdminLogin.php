<?php
session_start();
require_once("connection.php");
if(isset($_POST['submit'])){
    $email = trim($_POST['email']);
    //this saves our email address in the session
    $_SESSION['username'] = $email;
    $password = trim($_POST['password']);
    $sql = "select * from admin where email = '".$email."'";
    $rs = mysqli_query($conn,$sql);
    $numRows = mysqli_num_rows($rs);
    if($numRows  == 1){
        $row = mysqli_fetch_assoc($rs);
        if(password_verify($password,$row['password'])){
            header('Location: Admindash.php');
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

//Built a function to log a users IP address.
//Is later used to just display it on Admin login form.
function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

?>

<html>
<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/forms.css">
</head>
<body>
<br>
<form id="loginForm" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <h1>Admin Login</h1>
    <p>Email</p>
    <input type="text" name="email" autocomplete="off" value="">
    <p>Password</p>
    <input type="password" name="password" autocomplete="off" value="">
    <input type="submit" name="submit" value="Login" class="submitBtn">
    <?php echo 'Your IP is: '.getUserIpAddr().' and will be logged for security.'; ?>
    <a style="text-align:center;" href="forgotPassword.php"><p>Forgot Password?</p></a>
</form>
</body>
</html>
