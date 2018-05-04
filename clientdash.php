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
    $sql  = 'SELECT * FROM `drivers`';
}elseif(isset($_POST['keyword'])){
    $search = $_POST['keyword'];
    $sql = "SELECT * FROM `drivers` WHERE state LIKE '$search'";
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
                <a href="orders.php">My Orders</a>
                ';

        }else{
            echo 'We cant seem to pull your info';
        }
        ?>
    </aside>
    <!--Main content-->
    <main>
        <h1>Hire A Pro</h1>
        <!--Searchbar elements-->
        <form class="searchBar" method="post" action="clientdash.php">
            <input type="text" name="keyword" placeholder="Search by State ex.(PA)">
            <button type="submit" name="submit"><i class="fa fa-search"></i></button>
        </form>
        <br>
        <!--List of normal AND SEARCH Results-->
        <?php


            if ($result->num_rows > 0) {

                // output data of each row in the database and displays it as a card
                //$row = $result->fetch_assoc();
                //$experience = ''. $row['experience'] .'';

                    while ($row = $result->fetch_assoc()) {


                        echo '<div class="driver-card">  
            <form action="clientdash.php" method="post">
            <h1>' . $row['name'] . '</h1>
            <p>STATE: ' . $row['state'] . '</p>
            <p>CITY: ' . $row['city'] . '</p>
            <p>EXPERIENCE: '. $row['experience']. 'YEARS</p>
            <p>Medical: <a href="driverDocs/' . $row['medical'] . '" target="_blank">View</a></p>
            <p>Crash Rep: <a href="driverDocs/' . $row['crash_report'] . '" target="_blank">View</a></p>
            <input name="details" type="text" maxlength="60" placeholder="Enter the details"><br><br>
            <input name="price" type="text" placeholder="Enter Price Amount">
            <input  type="hidden" name="email" style="visibility: hidden"  value=' . $row['email'] . '>            
            <input type="submit" value="hire" name="hire"> 
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
