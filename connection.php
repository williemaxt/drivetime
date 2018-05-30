<?php
session_start();

// this is where you pass in the info to connect to db
//type in your database credentials below. Servername, username, password, database_name.
$dbServername = "localhost";
$dbUsername = "id5811675_root";
$dbPassword = "s3cur1ty";
$dbName = "id5811675_drive_time";
//  this variable has the connection information
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

