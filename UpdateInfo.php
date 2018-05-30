<?php
include_once 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Drive Time</title>
    <link rel="stylesheet" href="css/dash.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<nav id="navbar">
   <a href="#"><h1>Prodrivetime</h1></a>
   <p><a href="logout.php?logout=true">Logout</a></p>
   <p><a href="AdminDash.php">See Transactions</a></p>
   <p><a href="DriverSheet.php">See Drivers</a></p>
   <p><a href="ClientSheet.php">See Clients</a></p>
   <p><a href="UpdateInfo.php">Manage Info</a></p>
   <p><a href="UpdateHome.php">Manage Home</a></p>
</nav>
<body>
<div class="wrapper">
    <aside>
        <h1>Important!</h1>
        <!--Searchbar elements-->
        <p>This the page where editing of the Info Page can take place.
        Be very careful as all changes are final. It is suggested that you
      write all entries ahead of time and then paste into the fields to prevent
    mistakes.</p>
        <br>
        <p>Each form corresponds to a piece of information on the homepage so
        edit accordingly.</p>
        <br>
        <p>Support: 611thesolutions@gmail.com</p>
    </aside>
    <!--Main content-->
    <main id="admin-main">
            <h1>Update The Info Page</h1>

            <!--Update Content for the text Areas and subheading-->
            <div class="card-box">
              <h2>About Us</h2>
              <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="aboutus" value="" placeholder="Title...">
                <br>
                <textarea name="aboutus1" rows="8" cols="80" placeholder="Body..."></textarea>
                <br>
                <input type="submit" name="header_update" value="Submit">
              </form>
            </div>
            
            <!--Update Content for the text Areas and subheading-->
            <div class="card-box">
              <h2>Why Use Us?</h2>
              <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="whyus" value="" placeholder="Title...">
                <br>
                <textarea name="whyus1" rows="8" cols="80" placeholder="Body..."></textarea>
                <br>
                <input type="submit" name="whyus_submit" value="Submit">
              </form>
            </div>

            <!--Update Content for the text Areas and subheading-->
            <div class="card-box">
              <h2>Text Area 3</h2>
              <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="phone" value="" placeholder="1234567890">
                <br>
                <input type="text" name="email" value="" placeholder="support@example.com">
                <br>
                <input type="text" name="address" value="" placeholder="123 Main Street, USA">
                <br>
                <input type="submit" name="textarea_submit" value="Submit">
              </form>
            </div>
<?php 

// About Us
if (isset($_POST['header_update'])) {
            $aboutus = $_POST['aboutus'];
            $aboutus1 = $_POST['aboutus1'];
           // $sql = "INSERT INTO `info` (aboutus, aboutus1) VALUES ('$aboutus', '$aboutus1')";
            $sql = "UPDATE info SET aboutus = '$aboutus', aboutus1 = '$aboutus1'";
if($conn->query($sql) === true){
    echo "Records were updated successfully.";
} else{
  echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
} }

//Why us
if (isset($_POST['whyus_submit'])) {
            $whyus = $_POST['whyus'];
            $whyus1 = $_POST['whyus1'];
            $sql = "UPDATE info SET whyus ='$whyus', whyus1 = '$whyus1'";

if($conn->query($sql) === true){
    echo "Records were updated successfully.";
} else{
  echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
} }

//Text Area 3
if (isset($_POST['textarea_submit'])) {
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $sql = "UPDATE `info` SET phone ='$phone', email = '$email', address = '$address'";

if($conn->query($sql) === true){
    echo "Records were updated successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
} }

?>
</main>
</div>
</body>
<script src="js/dash.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</html>
