<?php
session_start();
include_once 'connection.php';

if(!isset($_SESSION))
{
    header('Location:index.php');
    exit;
}

//Search bar logic
if(empty($_POST['keyword'])){
    $sql  = 'SELECT * FROM transactions';
}elseif(isset($_POST['keyword'])){
    $search = $_POST['keyword'];
    $sql = "SELECT * FROM transactions WHERE transactions.business LIKE '$search' ";
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
        <h1>Search</h1>
        <!--Searchbar elements-->
        <form class="searchBar" method="post" action="AdminDash.php">
            <input type="text" name="keyword" placeholder="Search by buisness (verbatim)">
            <button type="submit" name="submit"><i class="fa fa-search"></i></button>
        </form>
        <br>
    </aside>
    <!--Main content-->
    <main>

            <h2>&nbsp; &nbsp; &nbsp; ID &nbsp; &nbsp; &nbsp; Client Email &nbsp; &nbsp; Client Name &nbsp;  &nbsp;  &nbsp;Business &nbsp; &nbsp; &nbsp; &nbsp; Driver &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Timestamp  </h2>

        <?php


        $result = $conn->query($sql);


        $id = "SELECT id FROM transactions";

        if ($result->num_rows > 0) {
            // output data of each row in the database and displays it as a card
            while($row = $result->fetch_assoc()) {
                echo "<div class='admin-card'>
                      <div class='admin-content'>
                       <p>". $row["id"]." </p>
                       <p>". $row["client_email"]."</p>
                       <p>" . $row["client_name"] ." </p>
                       <p>" . $row["business"] . "</p>
                       <p>" . $row["driver_email"] ."</p>
                       <p>" . $row["timestamp"] . "</p>
                       </div>
                       <a href='delete.php?del=<?php echo $id ?>'> <button type='button' name='button'>Delete</button></a>
                       </div>
                       <br>" ;
            }
        } else {
            echo "No Transactions for $search Yet. Come back soon!";
        }


     //Will add code to pull from transactions sql db.
     //Show results as Client Email, Client Name, Business, Driver Email, Timestamp. Optionally Amount offered.
        $conn->close();
     ?>
    </main>
</div>
</body>
<script src="js/dash.js"></script>
</html>
