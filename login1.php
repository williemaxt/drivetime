<?php
session_start();

include 'users.php';
$user = new User();


use PHPMailer\PHPMailer\PHPMailer;
use phpmailer\Exception;

date_default_timezone_set('Etc/UTC');
require 'vendor/autoload.php';


if(isset($_POST['forgotSubmit'])){
    //check whether email is empty
    if(!empty($_POST['email'])){
        //check whether user exists in the database
        $prevCon['where'] = array('email'=>$_POST['email']);
        $prevCon['return_type'] = 'count';
        $prevUser = $user->getRows($prevCon);
        if($prevUser > 0){
            //generate unique string
            $uniqidStr = md5(uniqid(mt_rand()));

            //update data with forgot pass code
            $conditions = array(
                'email' => $_POST['email']
            );
            $data = array(
                'forgot_pass_identity' => $uniqidStr
            );
            $update = $user->update($data, $conditions);

            if($update){
                $resetPassLink = 'http://localhost:8888/resetPassword.php?fp_code='.$uniqidStr;

                //get user details
                $con['where'] = array('email'=>$_POST['email']);
                $con['return_type'] = 'single';
                $userDetails = $user->getRows($con);




//if (isset($_POST['email'])) {
//  $conn = new mysqli('localhost', 'root', 'root', 'drive_time');
// $email = $conn->real_escape_string($_REQUEST['email']);
// $sql = $conn->query("SELECT id FROM drivers WHERE email='$email'");
// if ($sql->num_rows > 0) {
//   $token = generateNewString();
// $conn->query("UPDATE drivers SET token='$token',
//             tokenExpire=DATE_ADD(NOW(), INTERVAL 5 MINUTE)
//           WHERE email='$email'
//");
/**
 * This example shows making an SMTP connection with authentication.
 */
//Import the PHPMailer class into the global namespace

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');
//Create a new PHPMailer instance
$mail = new PHPMailer(true);
try {
//Tell PHPMailer to use SMTP
    $mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
    $mail->SMTPDebug = 0;
//Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
//Set the SMTP port number - likely to be 25, 465 or 587
    $mail->Port = 587;
//Whether to use SMTP authentication
    $mail->SMTPAuth = true;
//Username to use for SMTP authentication
    $mail->Username = 'youremail@account.com';
//Password to use for SMTP authentication
    $mail->Password = 'email-password';
//Set who the message is to be sent from
    $mail->setFrom('From_Sender@gmail.com', 'First Last');
//Set an alternative reply-to address. This is optional, uncomment and fill details below.
    $mail->addReplyTo('ReplyTo@gmail.com', 'First Last');
//Set who the message is to be sent to
    $mail->addAddress('Sendto@gmail.com', 'John Doe');
//Set the subject line
    $mail->Subject = 'PHPMailer SMTP test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
//Replace the plain text body with one created manually
//$mail->AltBody = 'This is the body message of the php mail message.';
    $mail->isHTML(true);
    $mail->Body = "
	            Hi,<br><br>
	            
	            In order to reset your password, please click on the link below:<br>
                                <br/>Recently a request was submitted to reset a password for your account. If this was a mistake, just ignore this email and nothing will happen.
                                <br/>To reset your password, visit the following link: <a href=\"'.$resetPassLink.'\">$resetPassLink</a><br><br>
	            
	            Kind Regards,<br>
	            Prodrivetime
	        ";
//send the message, check for errors
    $mail->send();
} catch (Exception $exception) {
    echo "Message could not be sent";
    echo 'Mailer Error:'. $mail->ErrorInfo;

    //   }
    // }
}

                $sessData['status']['type'] = 'success';
                $sessData['status']['msg'] = 'Please check your e-mail, we have sent a password reset link to your registered email.';
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'Some problem occurred, please try again.';
            }
        }else{
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Given email is not associated with any account.';
        }

    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Enter email to create a new password for your account.';
    }
    //store reset password status into the session
    $_SESSION['sessData'] = $sessData;
    //redirect to the forgot password page
    header("Location:forgotPassword.php");

}elseif(isset($_POST['resetSubmit'])){
    $fp_code = '';
    if(!empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['fp_code'])){
        $fp_code = $_POST['fp_code'];
        //password and confirm password comparison
        if($_POST['password'] !== $_POST['confirm_password']){
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Confirm password must match with the password.';
        }else{
            //check whether identity code exists in the database
            $prevCon['where'] = array('forgot_pass_identity' => $fp_code);
            $prevCon['return_type'] = 'single';
            $prevUser = $user->getRows($prevCon);
            if(!empty($prevUser)){
                //update data with new password
                $conditions = array(
                    'forgot_pass_identity' => $fp_code
                );
                $data = array(
                    //'password' => md5($_POST['password'])
                    'password' => password_hash($_POST['password'] , PASSWORD_DEFAULT)
                );
                $update = $user->update($data, $conditions);
                if($update){
                    $sessData['status']['type'] = 'success';
                    $sessData['status']['msg'] = 'Your account password has been reset successfully. Please login with your new password.';
                }else{
                    $sessData['status']['type'] = 'error';
                    $sessData['status']['msg'] = 'Some problem occurred, please try again.';
                }
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'You does not authorized to reset new password of this account.';
            }
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'All fields are mandatory, please fill all the fields.';
    }
    //store reset password status into the session
    $_SESSION['sessData'] = $sessData;
    $redirectURL = ($sessData['status']['type'] == 'success')?'login1.php':'resetPassword.php?fp_code='.$fp_code;
    //redirect to the login/reset password page
    header("Location:".$redirectURL);
}

require_once("connection.php");

if(isset($_POST['submit'])){
    $email = trim($_POST['email']);
    //this saves our email address in the session
    $_SESSION['username'] = $email;
    $password = trim($_POST['password']);
    $sql = "select * from drivers where email = '".$email."'";
    $rs = mysqli_query($conn,$sql);
    $numRows = mysqli_num_rows($rs);
    if($numRows  == 1){
        $row = mysqli_fetch_assoc($rs);
        if(password_verify($password,$row['password'])){
            header('Location: driverdash.php');
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
    <title>Driver Login</title>
    <link rel="stylesheet" href="css/forms.css">
</head>
<body>
<br>
<form id="loginForm" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <h1>Driver Login</h1>
    <p>Email</p>
    <input type="text" name="email" value="">
    <p>Password</p>
    <input type="password" name="password" value="">
    <input type="submit" name="submit" value="Login" class="submitBtn">
    <a style="text-align:center;" href="forgotPassword.php"><p>Forgot Password?</p></a>
</form>
</body>
</html>
