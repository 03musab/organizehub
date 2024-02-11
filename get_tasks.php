<?php

$servername = "localhost";
$username = "root";
$password = "musab";
$dbname = "organizehub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch tasks from the database
$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);

$tasks = [];

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }
}

// Return tasks as JSON
echo json_encode($tasks);

$conn->close();
?>
