<?php
      include_once 'connection.php';
    //write an sql statement to pull all information from table
   // $sql = "SELECT * FROM code;";
      $sql  = 'SELECT * FROM `clients`';
    //variable to query the code
    //conn istaken from the connection file
    $result = mysqli_query($conn, $sql); 
    
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
  </head>
  
    <body>
        
        <nav>
            <h1>Prodrivetime</h1>
            <p><a href="logout.php?logout=true">Logout</a></p>
            <p>example@gmail.com</p>
            <p>John Doe</p>
        </nav>
        <!--This is where the list of drivers will show-->
        <div class="wrapper">
        <!--This section shows the clients account information-->
        <aside>
             <h1>My Account</h1>
            <p>NAME:</p>
            <p>EMAIL:</p>
            <p>PHONE:</p>
            <p>ADDRESS:</p>
            
        </aside>
            
        <main>
        <h1>Your Requests</h1>
            
    <?php
        if ($result->num_rows > 0) {
        // output data of each row in the database and displays it as a card
        while($row = $result->fetch_assoc()) {
        echo '<div class="driver-card">
            <p>NAME: ' . $row['name'] . '</p>
            
            <p>BUSINESSES: ' . $row['bname'] . '</p>
            <p>ADDRESS: ' . $row['baddr'] . '</p>
            <input type="submit" name="accept" value="ACCEPT">
            </div>';
        }
            } else {
                echo "No Drivers Yet. Come back soon!";
        }
            $conn->close();
            ?>
          
        </main>
        </div>
    </body>
</html>
