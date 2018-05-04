<?php
session_start();
include_once 'connection.php';

if(!isset($_SESSION))
{
    header('Location:index.php');
    exit;
}
//this pulls the username(email) saved in the session to put into the sql query
$username = $_SESSION['username'];
//the query will look for users with that email and display their information on the dashboard
$sql1 = "SELECT * FROM `clients` WHERE email = '$username'";
//THIS WILL RUN THE SEARCH OPERATION
//Search bar logic
if(empty($_POST['keyword'])){
    $sql  = "SELECT * FROM `transactions`WHERE client_email='$username'";
}elseif(isset($_POST['keyword'])){
    $search = $_POST['keyword'];
    $sql = "SELECT * FROM `transactions` WHERE client_email = '$username' LIKE '$search'";
}

//variable to query the code
//conn is taken from the connection file
$result = mysqli_query($conn, $sql);
//variable for displaying the current users information
$result1 = mysqli_query($conn, $sql1);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Drive Time</title>
    <link rel="stylesheet" href="css/dash.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<nav id="navbar">
    <h1>Prodrivetime</h1>
    <p><a href="logout.php?logout=true">Logout</a></p>

    <!--the php snippet below echos the account information of the person logged in-->
    <?php
    if($result1->num_rows > 0){
        $row1 = $result1->fetch_assoc();
        echo '<p id="dashEmail"> ' . $row1['email'] . '</p>
                     <p id="dashName">' . $row1['name'] . '</p>';
    }else{
        echo 'We cant seem to pull your info';
    }


    ?>
</nav>
<!--This is where the list of drivers will show-->
<div class="wrapper">
    <!--This section shows the clients account information-->
    <aside>
        <h1>My Account</h1>
        <?php
        if($result1->num_rows > 0){
            echo '
                <p>NAME: ' . $row1['name'] . '</p>
                <p>EMAIL: ' . $row1['email'] . '</p>
                <p>PHONE: ' . $row1['number'] . '</p>
                <p>BUSINESS: ' . $row1['bname'] . '</p>
                <a href="clientdash.php">Dashboard</a>
                ';

        }else{
            echo 'We cant seem to pull your info';
        }
        ?>
    </aside>
    <!--Main content-->
    <main>
    <h1>These are your accepted requests. You may contact them via email!</h1>
        <?php


        if ($result->num_rows > 0) {

            // output data of each row in the database and displays it as a card
            //$row = $result->fetch_assoc();
            //$experience = ''. $row['experience'] .'';

            while ($row = $result->fetch_assoc()) {


                echo '<div class="driver-card">  
            <form action="clientdash.php" method="post">
            <h1>' . $row['client_name'] . '</h1>
            <p>Email: ' . $row['client_email'] . '</p>
            <p>Business: ' . $row['business'] . '</p>
            <p>Details: '. $row['details']. '</p>
            <p>Price: ' . $row['amount_offered'] . '</p>
            <p>Driver Email: ' . $row['driver_email'] . '</p>     
            </form>

            </div>';

            }

        } else {
            echo "No Drivers In $search Yet. Come back soon!";
        }

        $conn->close();

        if (isset($_POST['hire'])) {
            $con = new mysqli('localhost', 'root', 'root', 'drive_time');


            $name = '' . $row1['name'] . '';
            $business = '' . $row1['bname'] . '';
            $driveremail = $_POST['email'];
            $details = $_POST['details'];
            $amount_offered = $_POST['price'];

            $con->query("INSERT INTO request_trans (client_email, client_name, business, details, amount_offered, driveremail) VALUES ('$username', '$name','$business', '$details','$amount_offered','$driveremail');");

        }



        ?>
    </main>
</div>
</body>
<script src="js/dash.js"></script>
</html>
