<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'hotel_management_system';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Test the connection
//$result = $conn->query("SELECT 1");
//if ($result) {
  //  echo "Database connection successful.<br>";
//} else {
//    echo "Database connection failed.<br>";
//}
?>