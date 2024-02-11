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

// Get the task text from the request body
$data = json_decode(file_get_contents("php://input"), true);
$taskText = $data['task_text'];

// Insert the new task into the database
$sql = "INSERT INTO tasks (task_text) VALUES ('$taskText')";
if ($conn->query($sql) === TRUE) {
    // Return the inserted task ID
    echo json_encode(array("id" => $conn->insert_id, "task_text" => $taskText));
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
