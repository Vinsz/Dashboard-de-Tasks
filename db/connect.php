<?php
$servername = "localhost";
$username = "root";  //your user name for php my admin if in local most probaly it will be "root"
$password = "";  //password probably it will be empty
$databasename = "tasksdb"; //Your db nane
// Create connection
$conn = new mysqli($servername, $username, $password,$databasename);
//set charset
mysqli_set_charset($conn, 'utf-8');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
#echo "Connected successfully";
?>