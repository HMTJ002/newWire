<?php
$host = 'localhost';
$user = 'root';
$password = 'root@1234';
$database = 'news_wire_db';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
