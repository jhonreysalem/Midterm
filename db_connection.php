<?php
$servername = "localhost"; 
$username = "root";
$password = ""; 
$dbname = "online_food_delivery"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
