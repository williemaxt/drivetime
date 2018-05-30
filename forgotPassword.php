<?php

$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>
<html>
    <head>
      <link rel="stylesheet" href="css/forms.css">
      </head>
<p>Enter the Email associated with your account to Reset Password</p>
<?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
<div class="container">
    <div class="regisFrm">
        <form action="login1.php" method="post">
            <input type="email" autocomplete="off" name="email" placeholder="Email" required="">
            <div class="send-button">
                <input type="submit" name="forgotSubmit" value="Continue...">
            </div>
        </form>
    </div>
</div>
</html>

