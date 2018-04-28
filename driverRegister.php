<?php


if(isset($_POST['submit'])) {
//creates variables for handling the first file
    $file = $_FILES['medical'];
    $fileName = $_FILES['medical']['name'];
    $fileTmpName = $_FILES['medical']['tmp_name'];
    $fileSize = $_FILES['medical']['size'];
    $fileError = $_FILES['medical']['error'];
    $fileType = $_FILES['medical']['type'];
//creates variables for handling the second file
    $file1 = $_FILES['crash_report'];
    $fileName1 = $_FILES['crash_report']['name'];
    $fileTmpName1 = $_FILES['crash_report']['tmp_name'];
    $fileSize1 = $_FILES['crash_report']['size'];
    $fileError1 = $_FILES['crash_report']['error'];
    $fileType1 = $_FILES['crash_report']['type'];

    //setting what extensions we want to allow
    //exploding the values into an array
    $fileExt = explode('.',$fileName);
    $fileExt1 = explode('.',$fileName1);
    //getting the extension
    // and setting it to lower case
    $fileActualExt = strtolower(end($fileExt));
    $fileActualExt1 = strtolower(end($fileExt1));

    //allowed files
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    //****************checking to see if the file we chose is allowed***********************
    //checking for file errors
    if(in_array($fileActualExt, $allowed, $fileActualExt1)){
        if($fileError === 0){
            //this checks the file size in kb(kilobytes)
            if($fileSize < 5000000 || $fileSize1 < 5000000){
                //this variable will be equal to the new name of the file (unique id)
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileNameNew1 = uniqid('', true).".".$fileActualExt1;
                //this variable will be equal to the destination or folder of the file
                $fileDestination = 'driverDocs/'.$fileNameNew;
                $fileDestination1 = 'driverDocs/'.$fileNameNew1;
                //function that will move our uploaded file to its destination
                move_uploaded_file($fileTmpName, $fileDestination);
                move_uploaded_file($fileTmpName1, $fileDestination1);
                header("Location: driverRegister.php");
                //now we can echo a success message or redirect them to a new page with header()
                echo "Uploaded Successfully!";
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

$con = new mysqli('localhost','username','password_goes_here','drive_time');

$name = $con->real_escape_string($_POST['name']);
$email = $con->real_escape_string($_POST['email']);
$number = $con->real_escape_string($_POST['number']);
$password = $con->real_escape_string($_POST['password']);
$cPassword = $con->real_escape_string($_POST['cPassword']);
$cdl = $con->real_escape_string($_POST['cdl']);
$city = $con->real_escape_string($_POST['city']);
$experience = $con->real_escape_string($_POST['experience']);
$state = $con->real_escape_string($_POST['state']);
$medical = $con->real_escape_string($_POST['medical']);
$crash_report = $con->real_escape_string($_POST['crash_report']);


if ($password != $cPassword)
    $msg = "Passwords do not match.";
else {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $con->query("INSERT INTO drivers (name, email, number, password, cdl, city, experience, state, medical, crash_report) VALUES ('$name', '$email', '$number', '$hash', '$cdl','$city', '$experience', '$state', '$medical', '$crash_report');");

    //$sql = "INSERT INTO drivers (name, email, number, password, medical, crash_report) VALUES ('$name', '$email', '$number', '$password', '$medical', '$crash_report');";
    //mysqli_query($conn, $sql);
    //take us back home after submission
    // header("Location: allcode.php?commit=success");

}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Drive</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/forms.css">
</head>
<body>
<br>


<form id="registerDriverForm" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
    <h1>Register To Drive</h1>
    <p>Full Name</p>
    <input type="text" minlength="3" name="name">
    <p>Email</p>
    <input type="text" name="email" value="">
    <p>Phone</p>
    <input type="number" name="number">
    <p>Password</p>
    <input type="password" minlength="8" name="password">
    <p>Confirm Password</p>
    <input type="password" minlength="8" name="cPassword">
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
    <p>Medical</p>
    <input type="file" name="medical">
    <p>Crash Report</p>
    <input type="file" name="crash_report">
    <input class="submitBtn" type="submit" name="submit" value="submit">
</form>

</body>
</html>
