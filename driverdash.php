<?php
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
                echo "Your file is too large.";
            }
        }
        else{
            echo "There was an error uploading your file!";
        }
    }
    else{
        //checks for the specified file types
        echo "You cannot upload this file type!";
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
                echo "Your file is too large.";
            }
        }
        else{
            echo "There was an error uploading your file!";
        }
    }
    else{
        //checks for the specified file types
        echo "You cannot upload this file type!";
    }

}


if(isset($_POST['submitCdl'])) {
//creates variables for handling the first file
    $file = $_FILES['cdl'];
    $fileName = $_FILES['cdl']['name'];
    $fileTmpName = $_FILES['cdl']['tmp_name'];
    $fileSize = $_FILES['cdl']['size'];
    $fileError = $_FILES['cdl']['error'];
    $fileType = $_FILES['cdl']['type'];


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


                $conn->query("UPDATE drivers SET cdl ='$fileNameNew' WHERE email = '$username';");
                header('Location: '.$_SERVER['REQUEST_URI']);
                //now we can echo a success message or redirect them to a new page with header()
                echo "Uploaded Successfully!";
                //header("login1.php");

            }
            else{
                echo "Your file is too large.";
            }
        }
        else{
            echo "There was an error uploading your file!";
        }
    }
    else{
        //checks for the specified file types
        echo "You cannot upload this file type!";
    }

}


?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <p>Name: ' . $row1['name'] . '</p>
                <p>Email: ' . $row1['email'] . '</p>
                <p>Phone: ' . $row1['number'] . '</p>
                <p>State: ' . $row1['state'] . '</p>
                <p>CDL Expiration: ' .$row1['cdl_expire'] . '</p>
                <p>Medical Status: '. $row1['med_expire'] .'</p>
                <p>Crash Report Status: '. $row1['crash_expire'] .'</p>
                <p>Medical: <a href="driverDocs/' . $row1['medical'] . '" target="_blank">View</a></p>
                <p>Crash Rep: <a href="driverDocs/' . $row1['crash_report'] . '" target="_blank">View</a></p>
                <p>CDL: <a href="driverDocs/' . $row1['cdl'] . '" target="_blank">View</a></p>
                <img id="infoBtn" src="images/pencil.svg">
                <img id="filesBtn" src="images/document.svg">';
        }else{
            echo 'We cant seem to pull your info';
        }

?>
    </aside>

    <!-- The Modal For Account Info-->
    <div id="infoModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>

            <form id="" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
                <h1>Update Account</h1>
                <p>Full Name</p>
                <input type="text" minlength="3" name="name">
                <p>Phone</p>
                <input type="number" maxlength="10" name="number">
                <p>Current City</p>
                <input type="text" name="city">
                <p>Years of Experience</p>
                <input type="number" name="experience">
                <p>CDL Expiration Date</p>
                <input type="date" name="cdl_expire" placeholder="0000-00-00">
                <p>Medical Expiration Date</p>
                <input type="date" name="med_expire" placeholder="0000-00-00">
                <p>Crash Report Exp. Date</p>
                <input type="date" name="crash_expire" placeholder="0000-00-00">
                <p>Choose your license type</p>
                <input type="checkbox" name="ids[]" value="Type A "> Type A
                <input type="checkbox" name="ids[]" value="Type B "> Type B
                <input type="checkbox" name="ids[]" value="Type C "> Type C
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
        $city = $_POST['city'];
        $experience = $_POST['experience'];
        $state = $_POST['state'];
        $cdl_expire = $_POST['cdl_expire'];
        $med_expire = $_POST['med_expire'];
        $crash_expire = $_POST['crash_expire'];
        $ids = implode(",",$_POST["ids"]);
        
        
        $conn->query("UPDATE `drivers` SET name = '$name', city = '$city', experience = '$experience', state = '$state', cdl_expire = '$cdl_expire', med_expire = '$med_expire', crash_expire = '$crash_expire', checkbox = '$ids'  WHERE email = '$username';");

    }
?>
    <!--End of modal-->
    <!-- The Modal The Modal For Account Info-->
    <div id="filesModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="closeFiles">&times;</span>

            <form id="" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
                <h1>Update Field</h1>
                <p>Medical</p>
                <input type="file" name="medical">
                <input class="submitBtn" type="submit" name="submit" value="submit">
                <p>Crash Report</p>
                <input type="file" name="crash_report">
                <input class="submitBtn" type="submit" name="submitCrash" value="submit">
                <p>CDL</p>
                <input type="file" name="cdl">
                <input class="submitBtn" type="submit" name="submitCdl" value="submit">
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
                <input type="hidden" name="id" value="'. $row['id'].'">
                <input type="submit" name="accept" value="Accept">
                </form>     
                </div>';

            }

        } else {
            echo "No client requests yet. Come back soon!";
        }


        if (isset($_POST['accept'])) {


            $client_email = $_POST['email'];
            $client_name = $_POST['client_name'];
            $business = $_POST['business']; //use the row.
            $details = $_POST['details'];
            $amount_offered = $_POST['amount_offered'];
            $id = $_POST['id'];

            $conn->query("INSERT INTO transactions (client_email, client_name, business, details, amount_offered, driver_email) VALUES ('$client_email', '$client_name', '$business', '$details', '$amount_offered', '$username');");
            $conn->query("DELETE FROM request_trans WHERE id=$id");
            echo "<meta http-equiv='refresh' content='0'>";
            exit();


        }

/**

// This is code for judging whether or not a drivers'...
// ...cdl license is expired or not.

date_default_timezone_set('America/New_York');
//$nextThursday = strtotime("next year, 2019-12-05");

$nextExpire = strtotime($row1['cdl_expire']);

//$remaining = $nextThursday - time();
$days_remaining = floor($nextExpire / 86400); //Dividing between the number of seconds in a day to get number of days


if($days_remaining > 0) {

    echo "<h3 style='color: green'>Active</h3>";


} else {

    echo "<h3 style='color: red'>Expired</h3>";

}
**/

$conn->close();

?>
    </main>
</div>
</body>
<script src="js/dash.js"></script>
<script src="js/index.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</html>
