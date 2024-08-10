<?php
// Database Connection
$host = "localhost";
$username = "root";
$password = "";
$database = "airlines";

$con = new mysqli($host, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>