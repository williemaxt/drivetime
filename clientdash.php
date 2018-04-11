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
$sql1 = "SELECT * FROM `clients` WHERE email = '$username' ";
//THIS WILL RUN THE SEARCH OPERATION
//Search bar logic
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
//transactions in sql. records current user email, driver email, token, and a current timestamp (Y-m-d h:i:s).
$driveremail = $_POST['driveremail'];
$token = $_POST['token'];
$timestamp = $_POST['timestamp'];
$timestamp = date("Y-m-d h:i:s");
//inserting into sql.
$sql = "INSERT INTO transactions (client_email, driver_email, transaction_token, timestamp) VALUES ('$username', '$driveremail', '$token','$timestamp');";
require_once('vendor/stripe/stripe-php/init.php');
require_once('vendor/stripe/stripe-php/lib/Stripe.php')
?>
<!-- The required Stripe lib -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<!-- jQuery is used only for this example; it isn't required to use Stripe -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script type="text/javascript">
    // This identifies your website in the createToken call below
    Stripe.setPublishableKey('pk_test_SF7SVH5ZE1Q3snDwNfCrAoWg');
    var stripeResponseHandler = function(status, response) {
        var $form = $('#payment-form');
        if (response.error) {
            // Show the errors on the form
            $form.find('.payment-errors').text(response.error.message);
            $form.find('button').prop('disabled', false);
        } else {
            // token contains id, last4, and card type
            var token = response.id;
            // Insert the token into the form so it gets submitted to the server
            $form.append($('<input type="hidden" name="stripeToken" />').val(token));
            // and re-submit
            $form.get(0).submit();
        }
    };
    jQuery(function($) {
        $('#payment-form').submit(function(e) {
            var $form = $(this);
            // Disable the submit button to prevent repeated clicks
            $form.find('button').prop('disabled', true);
            Stripe.card.createToken($form, stripeResponseHandler);
            // Prevent the form from submitting with the default action
            return false;
        });
    });
</script>
<?php

\Stripe\Stripe::setApiKey("sk_test_9PyrNgAkYffqfvViseLNf4Sa");


if(isset($_POST['stripeToken'])) {
    $token = $_POST['stripeToken'];

    echo $token;

    $customer = \Stripe\Customer::create(array(
            "source" => $token,
            "description" => "Example customer")
    );



    echo "customer ID is ".$customer->id;

    $newCustomer = $customer->id;

    $con = new mysqli('localhost','root','root','drive_time');

    $transaction_token = $con->real_escape_string($_POST['stripeToken']);
    $con->query("INSERT INTO transactions (transaction_token) VALUES ('$transaction_token')");

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
                <p>BUSINESS: ' . $row1['bname'] . '</p>';
        }else{
            echo 'We cant seem to pull your info';
        }
        ?>
    </aside>
    <!--Main content-->
    <main>
        <h1>Hire A Pro</h1>
        <!--Searchbar elements-->
        <form class="searchBar" method="post" action="clientdash.php">
            <input type="text" name="keyword" placeholder="Search by State ex.(PA)">
            <button type="submit" name="submit"><i class="fa fa-search"></i></button>
        </form>
        <br>
        <!--List of normal AND SEARCH Results-->
        <?php
        if ($result->num_rows > 0) {
            // output data of each row in the database and displays it as a card
            while($row = $result->fetch_assoc()) {
                echo '<div class="driver-card">
            <h1>' . $row['name'] . '</h1>
            <p>STATE: ' . $row['state'] . '</p>
            <p>CITY: ' . $row['city'] . '</p>
            <p>EXPERIENCE: ' . $row['experience'] . ' YEARS</p>
            <p>Medical: <a href="driverDocs/' . $row['medical'] . '" target="_blank">View</a></p>
            <p>Crash Rep: <a href="driverDocs/' . $row['crash_report'] . '" target="_blank">View</a></p>
            <input type="submit" value="hire" name="hire">  <h1>Charge $10 with Stripe</h1>

  <form action="" method="POST" id="payment-form">
    <span class="payment-errors"></span>

    <div class="form-row">
      <label>
        <span>Card Number</span>
        <input type="text" size="20" data-stripe="number"/>
      </label>
    </div>

    <div class="form-row">
      <label>
        <span>CVC</span>
        <input type="text" size="4" data-stripe="cvc"/>
      </label>
    </div>

    <div class="form-row">
      <label>
        <span>Expiration (MM/YYYY)</span>
        <input type="text" size="2" data-stripe="exp-month"/>
      </label>
      <span> / </span>
      <input type="text" size="4" data-stripe="exp-year"/>
    </div>

    <button type="submit">Submit Payment</button>
  </form>

 
</body>
</html>
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

</body>
</html>
<script src="js/dash.js"></script>
</html>
