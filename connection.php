<?php
// this is where you pass in the info to conect to db
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "ogbytheoz";
$dbName = "drive_time";
//  this variable has the connection information
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);