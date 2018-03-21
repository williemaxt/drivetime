<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Reset Password</title>
      <link rel="stylesheet" href="css/forms.css">
  </head>
  <body>
      <?php include 'connection.php'?>
      <br>
      <form id="loginForm">
          <h1>Login</h1>
          <p>Email</p>
          <input type="text" name="lgEmail">
          <p>Password</p>
          <input type="password" name="lgPassword">
          <input class="submitBtn" type="submit" value="Login">
          <a style="text-align:center;" href="index.html"><p>Forgot Password?</p></a>
      </form>

  </body>
</html>
