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

// Check if the request method is DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Extract task ID from the request URL
    $id = $_GET['id'];

    // Delete the task from the database
    $sql = "DELETE FROM tasks WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Task deleted successfully
        http_response_code(200);
        echo json_encode(array("message" => "Task deleted successfully"));
    } else {
        // Failed to delete task
        http_response_code(500);
        echo json_encode(array("message" => "Failed to delete task: " . $conn->error));
    }
} else {
    // Method not allowed
    http_response_code(405);
    echo json_encode(array("message" => "Method Not Allowed"));
}

// Close the database connection
$conn->close();
?>
