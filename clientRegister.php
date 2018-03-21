<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Register</title>
      <link rel="stylesheet" href="css/main.css">
      <link rel="stylesheet" href="css/forms.css">
  </head>
  <body>
      <?php include 'connection.php'?>
      <br>
      <form id="registerClientForm">
          <h1>Register To Use</h1>
          <p>Full Name</p>
          <input type="text" name="regName">
          <p>Email</p>
          <input type="email" name="regEmail">
          <p>Phone</p>
          <input type="number" name="lgEmail">
          <p>Business Name</p>
          <input type="text" name="lgEmail">
          <p>Business Address</p>
          <input type="address" name="lgEmail">
          <input class="submitBtn" type="submit" value="Submit">
      </form>

  </body>
</html>