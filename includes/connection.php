<?php

$server = "localhost";
$username = "root";
$password = "root";
$db = "db_butterflies";

// Create a connection
$connection = mysqli_connect($server, $username, $password, $db);

// Test the connection
if(!$connection) {
    die("Connection failed: ".mysqli_connect_error());
}

// echo "Connection successful";

?>