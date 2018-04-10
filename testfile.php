<?php
/**
 * This example shows making an SMTP connection with authentication.
 */
//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');
require 'vendor/autoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 587;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = 'cmerchant1598@gmail.com';
//Password to use for SMTP authentication
$mail->Password = 's3cur3m3';
//Set who the message is to be sent from
$mail->setFrom('cmerchant1598@gmail.com', 'First Last');
//Set an alternative reply-to address
$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress('cmerchant1598@gmail.com', 'John Doe');
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
	            <a href='
	            http://domain.com/resetPassword.php?email=$email&token=$token
	            '>http://domain.com/resetPassword.php?email=$email&token=$token</a><br><br>
	            
	            Kind Regards,<br>
	            Prodrivetime
	        ";


//Attach an image file
$mail->addAttachment('images/background.png');
//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container" style="margin-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3" align="center">
            <img src="images/background.png"><br><br>
            <input class="form-control" id="email" placeholder="Your Email Address"><br>
            <input type="button" class="btn btn-primary" value="Reset Password">
            <br><br>
            <p id="response"></p>
        </div>
    </div>
</div>

<script type="text/javascript">
    var email = $("#email");

    $(document).ready(function () {
        $('.btn-primary').on('click', function () {
            if (email.val() !== "") {
                email.css('border', '1px solid green');

                $.ajax({
                    url: 'forgotPassword.php',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                    email: email.val()
                    }, success: function (response) {
                    if (!response.success)
                        $("#response").html(response.msg).css('color', "red");
                    else
                        $("#response").html(response.msg).css('color', "green");
                }
                });
            } else
                email.css('border', '1px solid red');
        });
    });
</script>
</body>
</html>