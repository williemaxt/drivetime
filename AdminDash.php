<?php
session_start();
include_once 'connection.php';

if(!isset($_SESSION))
{
    header('Location:index.php');
    exit;
}

$sql = 'SELECT * 
		FROM transactions';

$query = mysqli_query($conn, $sql);

if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Drive Time</title>
    <link rel="stylesheet" href="css/dash.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<nav id="navbar">
    <h1>Prodrivetime</h1>
    <p><a href="logout.php?logout=true">Logout</a></p>
</nav>

<body>


<div class="wrapper">
    <aside>
        <h1>My Account</h1>
        <?php
        //Admin Name, ProDriveTime, Edit Info. 
        ?>
    </aside>
    <!--Main content-->
    <main>
        <h1>Transactions</h1>
     <?php
     
     //Will add code to pull from transactions sql db.
     //Show results as Client Email, Client Name, Business, Driver Email, Timestamp. Optionally Amount offered.
     
     ?>
    </main>
</div>
</body>
<script src="js/dash.js"></script>
</html>
