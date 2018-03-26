<?php
      include_once 'connection.php';
    //write an sql statement to pull all information from table
   // $sql = "SELECT * FROM code;";
      $sql  = 'SELECT * FROM `drivers`';
    //variable to query the code
    //conn istaken from the connection file
    $result = mysqli_query($conn, $sql); 
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
            <p><a href="#">Logout</a></p>
            <p>example@gmail.com</p>
            <p>John Doe</p>
        </nav>
        <!--This is where the list of drivers will show-->
        <div class="wrapper">
        <main>
        <h1>Hire A Pro</h1>
          <!--An example of a driver card that will show-->
            <div class="driver-card">
            <p>NAME:</p>
            <p>EXPERIENCE:</p>
            <p>Bio:</p>
            <p>Medical:</p>
            <p>Crash Rep:</p>
                <input type="submit" value="HIRE">
            </div>
            
            <div class="driver-card">
            <p>NAME:</p>
            <p>EXPERIENCE:</p>
            <p>Bio:</p>
            <p>Medical:</p>
            <p>Crash Rep:</p>
                <input type="submit" value="HIRE">
            </div>
            
            <div class="driver-card">
            <p>NAME:</p>
            <p>EXPERIENCE:</p>
            <p>Bio:</p>
            <p>Medical:</p>
            <p>Crash Rep:</p>
                <input type="submit" value="HIRE">
            </div>
            
            <div class="driver-card">
            <p>NAME:</p>
            <p>EXPERIENCE:</p>
            <p>Bio:</p>
            <p>Medical:</p>
            <p>Crash Rep:</p>
                <input type="submit" value="HIRE">
            </div>
            
            <div class="driver-card">
            <p>NAME:</p>
            <p>EXPERIENCE:</p>
            <p>Bio:</p>
            <p>Medical:</p>
            <p>Crash Rep:</p>
                <input type="submit" value="HIRE">
            </div>
          
        </main>
        <!--This section shows the clients account information-->
        <aside>
             <h1>My Account</h1>
            <p>NAME:</p>
            <p>EMAIL:</p>
            <p>PHONE:</p>
            <p>ADDRESS:</p>
            
        </aside>
        </div>
    </body>
</html>
