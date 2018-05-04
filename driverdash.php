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
$sql1 = "SELECT * FROM `drivers` WHERE email = '$username' ";
//variable to query the code
$sql  = "SELECT * FROM `request_trans` WHERE driveremail= '$username' ";
//conn is taken from the connection file
$result = mysqli_query($conn, $sql);
//variable for displaying the current users information
$result1 = mysqli_query($conn, $sql1);
//this will update the users information on the database


if(isset($_POST['submit'])) {
//creates variables for handling the first file
    $file = $_FILES['medical'];
    $fileName = $_FILES['medical']['name'];
    $fileTmpName = $_FILES['medical']['tmp_name'];
    $fileSize = $_FILES['medical']['size'];
    $fileError = $_FILES['medical']['error'];
    $fileType = $_FILES['medical']['type'];


    //setting what extensions we want to allow
    //exploding the values into an array
    $fileExt = explode('.',$fileName);

    //getting the extension
    // and setting it to lower case
    $fileActualExt = strtolower(end($fileExt));


    //allowed files
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    //****************checking to see if the file we chose is allowed***********************
    //checking for file errors
    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            //this checks the file size in kb(kilobytes)
            if($fileSize <= 2000000) {
                //this variable will be equal to the new name of the file (unique id)
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                //this variable will be equal to the destination or folder of the file
                $fileDestination = 'driverDocs/'.$fileNameNew;


                //function that will move our uploaded file to its destination
                move_uploaded_file($fileTmpName, $fileDestination);


                $conn->query("UPDATE drivers SET medical ='$fileNameNew' WHERE email = '$username';");
                header('Location: '.$_SERVER['REQUEST_URI']);
                //now we can echo a success message or redirect them to a new page with header()
                echo "Uploaded Successfully!";
                //header("login1.php");

            }
            else{
                echo "your file is too big";
            }
        }
        else{
            echo "There was an error uploading your file!";
        }
    }
    else{
        //checks for the specified file types
        echo "you cannot upload this file type!";
    }

}




if(isset($_POST['submitCrash'])) {
//creates variables for handling the first file
    $file = $_FILES['crash_report'];
    $fileName = $_FILES['crash_report']['name'];
    $fileTmpName = $_FILES['crash_report']['tmp_name'];
    $fileSize = $_FILES['crash_report']['size'];
    $fileError = $_FILES['crash_report']['error'];
    $fileType = $_FILES['crash_report']['type'];


    //setting what extensions we want to allow
    //exploding the values into an array
    $fileExt = explode('.',$fileName);

    //getting the extension
    // and setting it to lower case
    $fileActualExt = strtolower(end($fileExt));


    //allowed files
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    //****************checking to see if the file we chose is allowed***********************
    //checking for file errors
    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            //this checks the file size in kb(kilobytes)
            if($fileSize <= 2000000) {
                //this variable will be equal to the new name of the file (unique id)
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                //this variable will be equal to the destination or folder of the file
                $fileDestination = 'driverDocs/'.$fileNameNew;


                //function that will move our uploaded file to its destination
                move_uploaded_file($fileTmpName, $fileDestination);


                $conn->query("UPDATE drivers SET crash_report ='$fileNameNew' WHERE email = '$username';");
                header('Location: '.$_SERVER['REQUEST_URI']);
                //now we can echo a success message or redirect them to a new page with header()
                echo "Uploaded Successfully!";
                //header("login1.php");

            }
            else{
                echo "your file is too big";
            }
        }
        else{
            echo "There was an error uploading your file!";
        }
    }
    else{
        //checks for the specified file types
        echo "you cannot upload this file type!";
    }

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
                <p>STATE: ' . $row1['state'] . '</p>
                <p>Medical: <a href="driverDocs/' . $row1['medical'] . '" target="_blank">View</a></p>
                <p>Crash Rep: <a href="driverDocs/' . $row1['crash_report'] . '" target="_blank">View</a></p>
                <img id="infoBtn" src="images/pencil.svg">
                <img id="filesBtn" src="images/document.svg">';
        }else{
            echo 'We cant seem to pull your info';
        }


     ?>
    </aside>

    <!-- The Modal The Modal For Account Info-->
    <div id="infoModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>

            <form id=" " method="post" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
                <h1>Update Account</h1>
                <p>Full Name</p>
                <input type="text" minlength="3" name="name">
                <p>Phone</p>
                <input type="number" maxlength="10" name="number">
                <p>CDL #</p>
                <input type="text" name="cdl">
                <p>Current City</p>
                <input type="text" name="city">
                <p>Years of Experience</p>
                <input type="number" name="experience">
                <p>Current State</p>
                <select name="state" id="state">
                    <option selected="selected">Select a State</option>
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>
                <input class="submitBtn" type="submit" name="submitDriverUpdate" value="submit">
                <br>
            </form>
        </div>
    </div>
    <?php

    if(isset($_POST['submitDriverUpdate'])) {

        $name = $_POST['name'];
        $number = $_POST['number'];
        //$cdl = $_POST['cdl']; // WE MUST MAKE CDL A FILE UPLOAD.
        $city = $_POST['city'];
        $experience = $_POST['experience'];
        $state = $_POST['state'];
        $conn->query("UPDATE drivers SET name = '$name', number = '$number', city = '$city', experience = '$experience', state = '$state' WHERE email = '$username';");

    } else {

        echo 'Invalid Request.';
    }

    ?>

    <!--End of modal-->
    <!-- The Modal The Modal For Account Info-->
    <div id="filesModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="closeFiles">&times;</span>

            <form id=" " method="post" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
                <h1>Update Field</h1>
                <p>Medical</p>
                <input type="file" name="medical">
                <input class="submitBtn" type="submit" name="submit" value="submit">
                <p>Crash Report</p>
                <input type="file" name="crash_report">
                <input class="submitBtn" type="submit" name="submitCrash" value="submit">
                <br>
            </form>
        </div>
    </div>
    <!--End of modal-->
    <main>
        <h1>Your Requests</h1>

        <?php
        if ($result->num_rows > 0) {
            // output data of each row in the database and displays it as a card

            while($row = $result->fetch_assoc()) {
                echo '
                <div class="driver-card">
                <form action="driverdash.php" method="post">
                <h1>' . $row['business'] . '</h1>
                <p>NAME: ' . $row['client_name'] . '</p>
                <p>DETAILS: ' . $row['details'] . '</p>
                <h2>$ ' . $row['amount_offered'] . '</h2>
                <input  type="hidden" name="client_name"  value="' . $row['client_name'] . '">
                <input  type="hidden" name="email"  value="' . $row['client_email'] . '">
                <input  type="hidden" name="details"  value="' . $row['details'] . '">
                <input  type="hidden" name="business"  value="' . $row['business'] . '">
                <input  type="hidden" name="amount_offered"  value="' . $row['amount_offered'] . '">
                <input type="submit" name="accept" value="accept">
                </form>     
                </div>';

            }

        } else {
            echo "No client requests yet. Come back soon!";
        }


        if (isset($_POST['accept'])) {
            $con = new mysqli('localhost', 'root', 'root', 'drive_time');

            $client_email = $_POST['email'];
            $client_name = $_POST['client_name'];
            $business = $_POST['business']; //use the row.
            $details = $_POST['details'];
            $amount_offered = $_POST['amount_offered'];


            $con->query("INSERT INTO transactions (client_email, client_name, business, details, amount_offered, driver_email) VALUES ('$client_email', '$client_name', '$business', '$details', '$amount_offered', '$username');");
            exit();
        }


        $conn->close();
        ?>

    </main>
</div>
</body>
<script src="js/dash.js"></script>
</html>
