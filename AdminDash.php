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
        <h1 align="center">Transactions</h1>
        <div class="table-scrol">


            <div class="table-responsive"><!--this is used for responsive display in mobile and other devices-->


                <table class="table table-bordered table-hover table-striped" style="table-layout: fixed">
                    <thead>

                    <tr>

                        <th>User Id</th>
                        <th>Client Email</th>
                        <th>Client Name</th>
                        <th>Business</th>
                        <th>Driver Email</th>
                        <th>Timestamp</th>
                    </tr>
                    </thead>

                    <?php

        $view_users_query="select * from transactions"; //select query for viewing users.
        $run=mysqli_query($conn,$view_users_query); //run the sql query.

        while($row=mysqli_fetch_array($run)) //while running query look to fetch the result and store in an array called $row.
        {

            $client_id = $row[0];
            $client_email = $row[1];
            $client_name = $row[2];
            $business = $row[3];
            $driver_email = $row[6];
            $timestamp = $row[8];

        }
        ?>

        <tr>
            <!--here showing results in the table -->
            <td><?php echo $client_id;  ?></td>
            <td><?php echo $client_email;  ?></td>
            <td><?php echo $client_name;  ?></td>
            <td><?php echo $business;  ?></td>
            <td><?php echo $driver_email;  ?></td>
            <td><?php echo $timestamp;  ?></td>
            <td><a href="delete.php?del=<?php echo $client_id ?>"><button class="btn">Delete</button></a></td> <!--btn btn-danger is a bootstrap button to show danger-->
        </tr>


        <?php

     //Will add code to pull from transactions sql db.
     //Show results as Client Email, Client Name, Business, Driver Email, Timestamp. Optionally Amount offered.

     ?>
    </main>
</div>
</body>
<script src="js/dash.js"></script>
</html>
