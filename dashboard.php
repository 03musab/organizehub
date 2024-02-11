<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organize hub</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <nav>
        <div class="container">
            <h1><img src="12.jpg" alt="Logo"></h1>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="aboutus.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- Small Navbar -->
    <nav class="small-navbar">
        <div class="container">
            <ul>
                <li><a href="#">Item 1</a></li>
                <li><a href="#">Item 2</a></li>
                <!-- Add more items as needed -->
            </ul>
        </div>
    </nav>

    <!-- Task Management Section -->
    <section id="task-management">
        <div class="container2">
            <h2>Task Manager</h2>
            <form id="task-form">
                <input type="text" id="task-input" placeholder="Enter task">
                <button type="submit">Add Task</button>
            </form>
            <ul id="task-list">
                <!-- Task items will be dynamically added here -->
            </ul>
        </div>
    </section>

    <script src="dashboard.js"></script>
</body>
</html>
