
<?php

// DB connection parameters
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "MYsql@123@";
$dbName = "e-clinic";


$conn = mysqli_connect($serverName, $dbUsername, $dbPassword,$dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>