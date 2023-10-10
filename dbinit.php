<?php
$hostname = "localhost";
$username = "root";
$password = "";

// Create a connection to MySQL server
$conn = mysqli_connect($hostname, $username, $password);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create the database if it doesn't exist
$databaseName = "laptopdb";
$sql = "CREATE DATABASE IF NOT EXISTS $databaseName";
if (mysqli_query($conn, $sql)) {
    // echo "Database '$databaseName' created successfully.<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

// Select the database
mysqli_select_db($conn, $databaseName);

// Create the 'laptops' table if it doesn't exist
$tableName = "laptops";
$sql = "CREATE TABLE IF NOT EXISTS $tableName (
    LaptopID INT AUTO_INCREMENT PRIMARY KEY,
    LaptopName VARCHAR(255) NOT NULL,
    LaptopGPU VARCHAR(255) NOT NULL,
    LaptopDescription TEXT NOT NULL,
    QuantityAvailable INT NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    ProductAddedBy VARCHAR(255) NOT NULL
)";

if (mysqli_query($conn, $sql)) {
    // echo "Table '$tableName' created successfully.<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}
?>
