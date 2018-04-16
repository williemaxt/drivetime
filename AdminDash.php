<?php
session_start();
include_once 'connection.php';

if(!isset($_SESSION))
{
    header('Location:index.php');
    exit;
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

        ?>
    </aside>
    <!--Main content-->
    <main>


        <?php
        $sql = "SELECT id, client_email, client_name, business, driver_email, timestamp FROM transactions";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<br>". $row["id"]." ". $row["client_email"]. " " . $row["client_name"] . " " . $row["business"] . " " . $row["driver_email"] . " " . $row["timestamp"] . "<a href=\"delete.php?del=<?php echo $client_id ?>\"><button class=\"btn\">Delete</button></a><br>";
            }
        } else {
            echo "0 results";
        }
     //Will add code to pull from transactions sql db.
     //Show results as Client Email, Client Name, Business, Driver Email, Timestamp. Optionally Amount offered.

     ?>
    </main>
</div>
</body>
<script src="js/dash.js"></script>
</html>
