<?php
$host = 'localhost';
$dbname = 'Students';
$username = 'amol'; // Change this to your database username
$password = 'rcbian2332'; // Change this to your database password

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>