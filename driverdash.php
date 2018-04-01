<?php
      include_once 'connection.php';
    //write an sql statement to pull all information from table
      $sql  = 'SELECT * FROM `clients`';
      //the query will look for users with that email and display their information on the dashboard
      $sql1 = 'SELECT * FROM `drivers` WHERE email = "God@gmail.com"';
    //variable to query the code
    //conn is taken from the connection file
    $result = mysqli_query($conn, $sql);
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
                <p>STATE: ' . $row1['state'] . '</p>';
            }else{
                echo 'We cant seem to pull your info';
            }
            ?>
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
