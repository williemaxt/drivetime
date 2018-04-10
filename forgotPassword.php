<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once "functions.php";

if (isset($_POST['email'])) {
    $conn = new mysqli('localhost (connection)', 'user', 'password', 'drive_time (database)');

    $email = $conn->real_escape_string($_POST['email']);

    $sql = $conn->query("SELECT id FROM drivers WHERE email='$email'");
    if ($sql->num_rows > 0) {

        $token = generateNewString();

        $conn->query("UPDATE drivers SET token='$token', 
                      tokenExpire=DATE_ADD(NOW(), INTERVAL 5 MINUTE)
                      WHERE email='$email'
            ");

    date_default_timezone_set('Etc/UTC');
    require 'vendor/autoload.php';
    //require_once "PHPMailer/PHPMailer.php";
    //require_once "PHPMailer/Exception.php";

     $mail = new PHPMailer();
     $mail->isSMTP();
     $mail->SMTPDebug = 0;
     //Enable SMTP debugging
     // 0 = off (for production use)
     // 1 = client messages
     // 2 = client and server messages
     $mail->Host = 'smtp.gmail.com';
     $mail->Port = 587;
     $mail->SMTPAuth = true;
     $mail->Username = 'youremail@email.com';
     $mail->Password = 'youremailpassword';
     //Set who the message is to be sent from
     $mail->setFrom("youremail@gmail.com", "buisnesstag");
     //calls email from variables above to send from that db user address. For validation as well.
     $mail->addAddress($email);
     //$mail->addAddress('youremail', 'John Doe'); //this was for testing purposes
     $mail->Subject = "Reset Password";
     //enabling html message for link href to work. Otherwise --> altBody. 
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

    if ($mail->send())
         exit(json_encode(array("status" => 1, "msg" => 'Please Check Your Email Inbox!')));
     else
         exit(json_encode(array("status" => 0, "msg" => 'Something Went Wrong... Please try again!')));
    }else
        exit(json_encode(array("status" => 0, "msg" => 'Please Check Your Inputs!')));

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
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
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
