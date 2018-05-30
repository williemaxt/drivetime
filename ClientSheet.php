<?php
include_once 'connection.php';

//Search bar logic
if(empty($_POST['keyword'])){
    $sql  = 'SELECT * FROM `clients`';
}elseif(isset($_POST['keyword'])){
    $search = $_POST['keyword'];
    $sql = "SELECT * FROM `clients` WHERE state LIKE '$search'";
}
//variable to query the code
//conn is taken from the connection file
$result = mysqli_query($conn, $sql);

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
<body>
<nav id="navbar">
   <a href="#"><h1>Prodrivetime</h1></a>
   <p><a href="logout.php?logout=true">Logout</a></p>
   <p><a href="AdminDash.php">See Transactions</a></p>
   <p><a href="DriverSheet.php">See Drivers</p>
   <p><a href="ClientSheet.php">See Clients</p>
   <p><a href="UpdateInfo.php">Manage Info</a></p>
   <p><a href="UpdateHome.php">Manage Home</a></p>
</nav>
<!--This is where the list of drivers will show-->
<div class="wrapper">

    <!--Main content-->
    <main>
        <h1>Clients</h1>
        <!--Searchbar elements-->
        <form class="searchBar" method="post" action="AdminDash.php">
            <input type="text" name="keyword" placeholder="Search by State ex.(PA)">
            <button type="submit" name="submit"><i class="fa fa-search"></i></button>
        </form>
        <br>
        <!--List of normal AND SEARCH Results-->
<?php
       if ($result->num_rows > 0) {
            // output data of each row in the database and displays it as a card

            while($row = $result->fetch_assoc()) {
                echo '
                <div class="driver-card">
                <form action="AdminDash.php" method="post">
                <h1>Name: ' . $row['name'] . '</h1>
                <p>Email: ' . $row['email'] . '</p>
                <p>Phone Number: ' . $row['number'] . '</p>
                <p>Business Address: ' . $row['baddr'] . '</p>
                </form>     
                </div>';

            }

        } else {
            echo "No client requests yet. Come back soon!";
        }

?>

</main>
</div>
</body>
<script src="js/dash.js"></script>
<script src="js/index.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</html>
