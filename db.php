<?php
$db_host = 'localhost';
$db_name = 'task_manager';
$user_name = 'root';
$user_password = '';

try {
    $conn = new PDO(
        "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4",
        $user_name,
        $user_password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch(PDOException $e) {
}
?>
