<?php
      include_once 'connection.php';

    //the query will look for users with that email and display their information on the dashboard
    $sql1 = 'SELECT * FROM `clients` WHERE email = "new@new.com" ';
    //THIS WILL RUN THE SEARCH OPERATION
    if(empty($_POST['keyword'])){

    $sql  = 'SELECT * FROM `drivers`';

    }elseif(isset($_POST['keyword'])){
        $search = $_POST['keyword'];
        $sql = "SELECT * FROM `drivers` WHERE state LIKE '$search' ";
    }
    //variable to query the code
    //conn is taken from the connection file
    $result = mysqli_query($conn, $sql);
    //variable for displaying the current users information
    $result1 = mysqli_query($conn, $sql1);

    session_start();
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
  
    <body>
        
        <nav>
            <h1>Prodrivetime</h1>
            <p><a href="logout.php?logout=true">Logout</a></p>
            <!--the php snippet below echos the account information of the person logged in-->
            <?php
            if($result1->num_rows > 0){
                $row1 = $result1->fetch_assoc();
                echo '<p> ' . $row1['email'] . '</p>
                     <p>' . $row1['name'] . '</p>';
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
                <p>BUSINESS: ' . $row1['bname'] . '</p>';
            }else{
                echo 'We cant seem to pull your info';
            }
            ?>
            
        </aside>


        <!--Main content-->
        <main>
        <h1>Hire A Pro</h1>
            <!--Search bar logic-->
            <?php
                echo $sql;
            ?>
            <!--Searchbar elements-->
            <form class="searchBar" method="post" action="clientdash.php">
                <input type="text" name="keyword" placeholder="Search..">
                <button type="submit" name="submit"><i class="fa fa-search"></i></button>
            </form>
            <br>

            <!--List of normal AND SEARCH Results-->
    <?php
        if ($result->num_rows > 0) {
        // output data of each row in the database and displays it as a card
        while($row = $result->fetch_assoc()) {
        echo '<div class="driver-card">
            <p>NAME: ' . $row['name'] . '</p>
            <p>STATE: ' . $row['state'] . '</p>
            <p>CITY: ' . $row['city'] . '</p>
            <p>EXPERIENCE: ' . $row['experience'] . ' YEARS</p>
            <p>Medical: <a href="driverDocs/' . $row['medical'] . '">View</a></p>
            <p>Crash Rep: <a href="driverDocs/' . $row['crash_report'] . '">View</a></p>
            <input type="submit" value="HIRE">
            </div>';
        }
            } else {
                echo "No Drivers In $search Yet. Come back soon!";
        }
            $conn->close();
            ?>

        </main>
        </div>
    </body>
</html>
