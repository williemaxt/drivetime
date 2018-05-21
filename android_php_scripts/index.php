<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Drive</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/forms.css">
</head>
<body>
<br>


<form id="registerDriverForm" method="post" action="add_info.php">
    <h1>Register To Drive</h1>
    <p>Full Name</p>
    <input type="text" minlength="3" name="name">
    <p>Email</p>
    <input type="text" name="email">
    <p>Phone</p>
    <input type="number" name="number">

    <input class="submitBtn" type="submit" name="submit" value="submit">
</form>

</body>
</html>
