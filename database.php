<?php
// Define database connection variables
$host = "localhost"; // Database host
$username = "root"; // Database username
$password = ""; // Database password
$database = "bieren"; // Database name

// Create a new mysqli connection
$conn = new mysqli($host, $username, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Connection successful!
echo "Connected to database successfully.";
?>
<br>
<br>