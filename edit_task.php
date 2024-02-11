<?php

$servername = "localhost";
$username = "root";
$password = "musab"; // Change this to your actual database password
$dbname = "organizehub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is PUT
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Get data from the request body
    $data = json_decode(file_get_contents("php://input"), true);
    
    // Extract task ID and new text
    $id = $data['id'];
    $newText = $data['task_text'];

    // Update the task in the database
    $stmt = $conn->prepare("UPDATE tasks SET task_text = ? WHERE id = ?");
    $stmt->bind_param('si', $newText, $id);
    
    if ($stmt->execute()) {
        // Task successfully updated
        http_response_code(200);
        echo json_encode(array("message" => "Task updated successfully"));
    } else {
        // Failed to update task
        http_response_code(500);
        echo json_encode(array("message" => "Failed to update task"));
    }
} else {
    // Method not allowed
    http_response_code(405);
    echo json_encode(array("message" => "Method Not Allowed"));
}

// Close the database connection
$conn->close();
?>
