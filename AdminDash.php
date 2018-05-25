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
            <input type="text" name="keyword" placeholder="Search by email">
            <button type="submit" name="submit"><i class="fa fa-search"></i></button>
        </form>
        <br>
    </aside>
    <!--Main content-->
    <main id="admin-main">

            <h2>&nbsp; &nbsp; &nbsp; Client Email &nbsp; &nbsp; Client Name &nbsp;  &nbsp;  &nbsp;Business &nbsp; &nbsp; &nbsp; &nbsp; Driver &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Timestamp  </h2>

        <?php


        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            // output data of each row in the database and displays it as a card
            while($row = $result->fetch_assoc()) {
                echo "
                      <form method='post'>
                      <div class='admin-card'>
                      <div class='admin-content'>
                       <p>". $row["client_email"]."</p>
                       <p>" . $row["client_name"] ." </p>
                       <p>" . $row["business"] . "</p>
                       <p>" . $row["driver_email"] ."</p>
                       <p>" . $row["timestamp"] . "</p>
                       </div>
                       <a href='' name='delete'><button type='submit' name='delete'>Delete</button></a>
                      <input  name='id' type='hidden' value=" . $row["id"] . "> 
                      </form>
                       </div>
                       <br>" ;
            }
        } else {
            echo "No Transactions for $search Yet. Come back soon!";
        }

        if(isset($_POST['delete'])){

            $id = $_POST['id'];

            $conn->query("DELETE FROM transactions WHERE id='$id'");
            echo "<meta http-equiv='refresh' content='0'>";
            exit();

        }
?>
    </main>
</div>
</body>
<script src="js/dash.js"></script>
</html>
