<?php
define('LOCALHOST', 'sql311.byethost32.com');
define('DB_USERNAME', 'b32_39112753');
define('DB_PASSWORD', 'mu5ab@M51');
define('DB_NAME', 'b32_39112753_task_manager');

// Dynamically set SITEURL and task
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$folder = dirname($_SERVER['SCRIPT_NAME']); // gets /organizehub-main

define('SITEURL', $protocol . $host . $folder . '/');
define('task', SITEURL . 'taskmanager.php');
?>