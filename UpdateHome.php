<?php

include_once 'connection.php';

/*if(!isset($_SESSION))
{
    header('Location:index.php');
    exit;
}*/
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

<nav id="navbar">
   <a href="#"><h1>Prodrivetime</h1></a>
   <p><a href="logout.php?logout=true">Logout</a></p>
   <p><a href="AdminDash.php">See Transactions</a></p>
   <p><a href="DriverSheet.php">See Drivers</a></p>
   <p><a href="ClientSheet.php">See Clients</a></p>
   <p><a href="UpdateInfo.php">Manage Info</a></p>
   <p><a href="UpdateHome.php">Manage Home</a></p>
</nav>

<body>

<div class="wrapper">
    <aside>
        <h1>Important!</h1>
        <!--Searchbar elements-->
        <p>This the page where editing of the hompage can take place.
        Be very careful as all changes are final. It is suggested that you
      write all entries ahead of time and then paste into the fields to prevent
    mistakes.</p>
        <br>
        <p>Each form corresponds to a piece of information on the hompage so
        edit accordingly.</p>
        <br>
        <p>Support: 611thesolutions@gmail.com</p>
    </aside>
    <!--Main content-->
    <main id="admin-main">
            <h1>Update The Home Page</h1>

            <!--Update Content for the title and subheading-->
            <div class="card-box">
              <h2>Header and Sub heading</h2>
              <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="title" value="" placeholder="Title">
                <br>
                <input type="text" name="sub_paragraph" value="" placeholder="Sub Heading">
                <br>
                <input type="submit" name="header_update" value="Submit">
              </form>
            </div>

            <!--Update Content for the text Areas and subheading-->
            <div class="card-box">
              <h2>Text Area 1</h2>
              <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="text1" value="" placeholder="Title...">
                <br>
                <textarea name="textarea1" rows="8" cols="80" placeholder="Body..."></textarea>
                <br>
                <input type="submit" name="header_update1" value="Submit">
              </form>
            </div>

            <!--Update Content for the text Areas and subheading-->
            <div class="card-box">
              <h2>Text Area 2</h2>
              <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="textarea3" value="" placeholder="Title...">
                <br>
                <textarea name="textareatext" rows="8" cols="80" placeholder="Body..."></textarea>
                <br>
                <input type="submit" name="header_update2" value="Submit">
              </form>
            </div>

            <!--Update Content for the text Areas and subheading-->
            <div class="card-box">
              <h2>Text Area 3</h2>
              <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="" name="textareatext1" value="" placeholder="Title...">
                <br>
                <textarea name="textareatext2" rows="8" cols="80" placeholder="Body..."></textarea>
                <br>
                <input type="submit" name="header_update3" value="Submit">
              </form>
            </div>

            <!--Update Content for the text Areas and subheading-->
            <div class="card-box">
              <h2>Text Area 4</h2>
              <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="textareatext3" value="" placeholder="Title...">
                <br>
                <textarea name="name22" rows="8" cols="80" placeholder="Body..."></textarea>
                <br>
                <input type="submit" name="header_update4" value="Submit">
              </form>
            </div>

            <!--Update Content for the Info Cards-->
            <div class="card-box">
              <h2>Info Card 1</h2>
              <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="name23" value="" placeholder="Title...">
                <br>
                <textarea name="name24" rows="8" cols="80" placeholder="Body..."></textarea>
                <br>
                <input type="submit" name="header_update5" value="Submit">
              </form>
            </div>

            <!--Update Content for the Info Cards-->
            <div class="card-box">
              <h2>Info Card 2</h2>
              <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="name25" value="" placeholder="Title...">
                <br>
                <textarea name="name26" rows="8" cols="80" placeholder="Body..."></textarea>
                <br>
                <input type="submit" name="header_update6" value="Submit">
              </form>
            </div>

            <!--Update Content for the Info Cards-->
            <div class="card-box">
              <h2>Info Card 3</h2>
              <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="name27" value="" placeholder="Title...">
                <br>
                <textarea name="comment1" rows="8" cols="80" placeholder="Body..."></textarea>
                <br>
                <input type="submit" name="header_update7" value="Submit">
              </form>
            </div>

            <!--Update Content for the Comments-->
            <div class="card-box">
              <h2>Comment 1</h2>
              <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="comment2" value="" placeholder="Name...">
                <br>
                <textarea name="comment3" rows="8" cols="80" placeholder="Comment..."></textarea>
                <br>
                <input type="submit" name="header_update8" value="Submit">
              </form>
            </div>

            <!--Update Content for the Comments-->
            <div class="card-box">
              <h2>Comment 2</h2>
              <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="comment4" value="" placeholder="Name...">
                <br>
                <textarea name="comment5" rows="8" cols="80" placeholder="Comment..."></textarea>
                <br>
                <input type="submit" name="header_update9" value="Submit">
              </form>
            </div>

            <!--Update Content for the Comments-->
            <div class="card-box">
              <h2>Comment 3</h2>
              <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="comment6" value="" placeholder="Name...">
                <br>
                <textarea name="comment7" rows="8" cols="80" placeholder="Comment..."></textarea>
                <br>
                <input type="submit" name="header_update10" value="Submit">
              </form>
            </div>

            <!--Update Content for the Footer paragraphs-->
            <div class="card-box">
              <h2>Footer 1</h2>
              <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="footer1" value="" placeholder="Title...">
                <br>
                <textarea name="footer2" rows="8" cols="80" placeholder="Body..."></textarea>
                <br>
                <input type="submit" name="header_update11" value="Submit">
              </form>
            </div>

            <!--Update Content for the Footer paragraphs-->
            <div class="card-box">
              <h2>Footer 2</h2>
              <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="footer3" value="" placeholder="Title...">
                <br>
                <textarea name="footer4" rows="8" cols="80" placeholder="Body..."></textarea>
                <br>
                <input type="submit" name="header_update12" value="Submit">
              </form>
            </div>

            <!--Update Content for the Footer paragraphs-->
            <div class="card-box">
              <h2>Footer 3</h2>
              <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="footer5" value="" placeholder="Title...">
                <br>
                <textarea name="footer6" rows="8" cols="80" placeholder="Body..."></textarea>
                <br>
                <input type="submit" name="header_update13" value="Submit">
              </form>
            </div>

            <!--Update Content for the Footer paragraphs-->
            <div class="card-box">
              <h2>Footer 4</h2>
              <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="footer7" value="" placeholder="Title...">
                <br>
                <textarea name="footer8" rows="8" cols="80" placeholder="Body..."></textarea>
                <br>
                <input type="submit" name="header_update14" value="Submit">
              </form>
            </div>
<?php

 // Follow names above for comments below. Match them.


//Header and Sub Heading
if (isset($_POST['header_update'])) {
            $title = $_POST['title'];
            $sub_paragraph = $_POST['sub_paragraph'];

            $sql = "UPDATE home SET title ='$title', sub_paragraph = '$sub_paragraph'";

if($conn->query($sql) === true){
    echo "Records were updated successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
} }

//Text Area 1
if (isset($_POST['header_update1'])) {
            $text1 = $_POST['text1'];
            $textarea1 = $_POST['textarea1'];

            $sql = "UPDATE home SET text1 ='$text1', textarea1 = '$textarea1'";

if($conn->query($sql) === true){
    echo "Records were updated successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
} }

//Text Area 2
if (isset($_POST['header_update2'])) {
            $textarea3 = $_POST['textarea3'];
            $textareatext = $_POST['textareatext'];

            $sql = "UPDATE home SET textarea3 ='$textarea3', textareatext = '$textareatext'";

if($conn->query($sql) === true){
    echo "Records were updated successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
} }

//Text Area 3
if (isset($_POST['header_update3'])) {
            $textareatext1 = $_POST['textareatext1'];
            $textareatext2 = $_POST['textareatext2'];

            $sql = "UPDATE home SET textareatext1 ='$textareatext1', textareatext2 = '$textareatext2'";

if($conn->query($sql) === true){
    echo "Records were updated successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
} }

//Text Area 4
if (isset($_POST['header_update4'])) {
            $textareatext3 = $_POST['textareatext3'];
            $name22 = $_POST['name22'];

            $sql = "UPDATE home SET textareatext3 ='$textareatext3', name22 = '$name22'";

if($conn->query($sql) === true){
    echo "Records were updated successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
} }

//Info Card 1
if (isset($_POST['header_update5'])) {
            $name23 = $_POST['name23'];
            $name24 = $_POST['name24'];

            $sql = "UPDATE home SET name23 ='$name23', name24 = '$name24'";

if($conn->query($sql) === true){
    echo "Records were updated successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
} }

//Info Card 2
if (isset($_POST['header_update6'])) {
            $name25 = $_POST['name25'];
            $name26 = $_POST['name26'];

            $sql = "UPDATE home SET name25 ='$name25', name26 = '$name26'";

if($conn->query($sql) === true){
    echo "Records were updated successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
} }

//Info Card 3
if (isset($_POST['header_update7'])) {
            $name27 = $_POST['name27'];
            $comment1 = $_POST['comment1'];

            $sql = "UPDATE home SET name27 ='$name27', comment1 = '$comment1'";

if($conn->query($sql) === true){
    echo "Records were updated successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
} }


// Comment 1
if (isset($_POST['header_update8'])) {
            $comment2 = $_POST['comment2'];
            $comment3 = $_POST['comment3'];

            $sql = "UPDATE home SET comment2 ='$comment2', comment3 = '$comment3'";

if($conn->query($sql) === true){
    echo "Records were updated successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
} }


// Comment 2
if (isset($_POST['header_update9'])) {
            $comment4 = $_POST['comment4'];
            $comment5 = $_POST['comment5'];

            $sql = "UPDATE home SET comment4 ='$comment4', comment5 = '$comment5'";

if($conn->query($sql) === true){
    echo "Records were updated successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
} }


// Comment 3
if (isset($_POST['header_update10'])) {
            $comment6 = $_POST['comment6'];
            $comment7 = $_POST['comment7'];

            $sql = "UPDATE home SET comment6 ='$comment6', comment7 = '$comment7'";

if($conn->query($sql) === true){
    echo "Records were updated successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
} }

// Footer 1
if (isset($_POST['header_update11'])) {
            $footer1 = $_POST['footer1'];
            $footer2 = $_POST['footer2'];

            $sql = "UPDATE home SET footer1 ='$footer1', footer2 = '$footer2'";

if($conn->query($sql) === true){
    echo "Records were updated successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
} }


// Footer 2
if (isset($_POST['header_update12'])) {
            $footer3 = $_POST['$footer3'];
            $footer4 = $_POST['$footer4'];

            $sql = "UPDATE home SET footer3 ='$footer3', footer4 = '$footer4'";

if($conn->query($sql) === true){
    echo "Records were updated successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
} }

// Footer 3
if (isset($_POST['header_update13'])) {
            $footer5 = $_POST['$footer5'];
            $footer6 = $_POST['$footer6'];

            $sql = "UPDATE home SET footer5 ='$footer5', footer6 = '$footer6'";

if($conn->query($sql) === true){
    echo "Records were updated successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
} }

// Footer 4
if (isset($_POST['header_update14'])) {
            $footer7 = $_POST['$footer7'];
            $footer8 = $_POST['$footer8'];

            $sql = "UPDATE home SET footer7 ='$footer7', footer8 = '$footer8'";

if($conn->query($sql) === true){
    echo "Records were updated successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
} }
?>
</main>
</div>
</body>
<script src="js/dash.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</html>
