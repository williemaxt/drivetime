<?php

include 'users1.php';
$user = new User();


use PHPMailer\PHPMailer\PHPMailer;
use phpmailer\Exception;

date_default_timezone_set('Etc/UTC');
require 'vendor/autoload.php';


if(isset($_POST['forgotSubmit1'])){
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
                $resetPassLink = 'https://drivetimepro1.000webhostapp.com/resetPassword1.php?fp_code='.$uniqidStr;

                //get user details
                $con['where'] = array('email'=>$_POST['email']);
                $con['return_type'] = 'single';
                $userDetails = $user->getRows($con);

//This below portion for mail must be edited.

$mail = new PHPMailer(true);
try {
//Tell PHPMailer to use SMTP
// Do not touch this line below.
    $mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
// In your case this will need to be set at 0. If it is already zero you can skip this line.
    $mail->SMTPDebug = 0;
//Set the hostname of the mail server
//If you are using gmail, leave it as is.
    $mail->Host = 'smtp.gmail.com';
//Set the SMTP port number - likely to be 25, 465 or 587
//If you are using gmail, port 587 will suffice and you can leave this as is.
    $mail->Port = 587;
//Whether to use SMTP authentication
//Do not edit the line below.
    $mail->SMTPAuth = true;
//Username to use for SMTP authentication
// Type in your email below in place of the example email placeholder. Make sure to leave the single quotes.
    $mail->Username = 'drivetimedriver@gmail.com';
//Password to use for SMTP authentication
// Enter your password to the email account below. Make sure to leave the single quotes.
    $mail->Password = 's3cur1ty!!!';
//Set who the message is to be sent from
//Set your email in the placeholder below. Leave the single quotes and make sure not to remove any code.
//You can change the name that will show in the users email inbox. This should be a business tag. As in the example below.
    $mail->setFrom('drivetimedriver@gmail.com', 'ProDriveTime');
//Set an alternative reply-to address
//Repeat the same process as the last line of code. Email, business tag.
    $mail->addReplyTo('drivetimedriver@gmail.com', 'ProDriveTime');
//Set who the message is to be sent to
// Do not change the code below. There is no need to change anything beyond this point.
//There is nothing else that needs to be done on this page.

    $mail->addAddress($_POST['email']);
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
    header("Location:forgotPassword1.php");

}elseif(isset($_POST['resetSubmit1'])){
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
                $sessData['status']['msg'] = 'You are not authorized to reset a new password for this account.';
            }
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'All fields are mandatory, please fill all the fields.';
    }
    //store reset password status into the session
    $_SESSION['sessData'] = $sessData;
    $redirectURL = ($sessData['status']['type'] == 'success')?'login.php':'resetPassword1.php?fp_code='.$fp_code;
    //redirect to the login/reset password page
    header("Location:".$redirectURL);
}

require_once("connection.php");
if(isset($_POST['submit'])){
    $email = trim($_POST['email']);
    //this saves our email address in the session
    $_SESSION['username'] = $email;
    $password = trim($_POST['password']);
    $sql = "select * from clients where email = '".$email."';";
    $rs = mysqli_query($conn,$sql);
    $numRows = mysqli_num_rows($rs);
    if($numRows  == 1){
        $row = mysqli_fetch_assoc($rs);
        if(password_verify($password, $row['password'])){
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Client Login</title>
    <link rel="stylesheet" href="css/forms.css">
</head>
<body>
<br>
<form id="loginForm" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <h1>Client Login</h1>
    <p>Email</p>
    <input type="text" name="email" autocomplete="off" value="">
    <p>Password</p>
    <input type="password" name="password" autocomplete="off" value="">
    <input type="submit" name="submit" value="Login" class="submitBtn">
    <a style="text-align:center;" href="forgotPassword1.php"><p>Forgot Password?</p></a>
</form>
</body>
</html>
