<?php
include ('config/constants.php');
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>OrganizeHub - Add Task</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --secondary-color: #f1f5f9;
            --accent-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --border-color: #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: var(--text-primary);
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: -280px;
            width: 280px;
            height: 100vh;
            background: var(--bg-primary);
            box-shadow: var(--shadow-lg);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            border-right: 1px solid var(--border-color);
        }
        .sidebar.active { left: 0; }
        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
        }
        .sidebar-header h3 { font-size: 1.5rem; font-weight: 700; margin: 0; }
        .sidebar-nav { padding: 2rem 0; }
        .sidebar-nav a {
            display: flex; align-items: center; padding: 1rem 1.5rem;
            color: var(--text-primary); text-decoration: none;
            transition: all 0.2s ease; border-left: 4px solid transparent;
        }
        .sidebar-nav a:hover {
            background: var(--secondary-color);
            border-left-color: var(--primary-color);
            color: var(--primary-color);
            transform: translateX(5px);
        }
        .sidebar-nav a i { width: 20px; margin-right: 1rem; font-size: 1.1rem; }

        .sidebar-toggle {
            position: fixed; top: 1.5rem; left: 1.5rem; z-index: 1001;
            background: var(--bg-primary); border: none; width: 50px; height: 50px;
            border-radius: 12px; box-shadow: var(--shadow); cursor: pointer;
            transition: all 0.2s ease; display: flex; align-items: center; justify-content: center;
        }
        .sidebar-toggle:hover { background: var(--primary-color); color: white; transform: scale(1.05); }
        .sidebar-toggle i { font-size: 1.2rem; }

        .main-content {
            margin-left: 0;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
            padding: 2rem;
        }
        #mainContent.sidebar-open {
            margin-left: 280px;
        }
        .sidebar-toggle.sidebar-open {
            left: 300px;
        }

        .header {
            background: var(--bg-primary);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 { font-size: 2.5rem; font-weight: 700; color: var(--text-primary); margin: 0; }
        .header-actions { display: flex; gap: 1rem; }
        .btn-modern {
            padding: 0.75rem 1.5rem; border: none; border-radius: 12px; font-weight: 600;
            text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;
            transition: all 0.2s ease; cursor: pointer;
        }
        .btn-primary-modern { background: var(--primary-color); color: white; }
        .btn-primary-modern:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: var(--shadow); }
        .btn-danger-modern { background: var(--danger-color); color: white; }
        .btn-danger-modern:hover { background: #dc2626; transform: translateY(-2px); }

        .form-container {
            background: var(--bg-primary);
            border-radius: 16px;
            padding: 2rem 2.5rem;
            box-shadow: var(--shadow);
            max-width: 600px;
            margin: 0 auto;
        }
        .form-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            text-align: center;
        }
        .form-label { font-weight: 600; color: var(--text-primary); }
        .form-control, .form-select { border-radius: 8px; }
        .btn-submit {
            background: var(--primary-color);
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            padding: 0.75rem 2rem;
            border: none;
            margin-top: 1rem;
            transition: background 0.2s;
        }
        .btn-submit:hover { background: var(--primary-dark); }
        .alert { margin-bottom: 1rem; }
        @media (max-width: 768px) {
            .main-content { padding: 1rem; }
            .form-container { padding: 1rem; }
            .header { flex-direction: column; gap: 1rem; text-align: center; }
            .header h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>
    <!-- Sidebar Toggle -->
    <button class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-tasks"></i> OrganizeHub</h3>
        </div>
        <nav class="sidebar-nav">
            <a href="taskmanager.php">
                <i class="fas fa-clipboard-list"></i>
                <span>Task Manager</span>
            </a>
            <a href="calendar.html">
                <i class="fas fa-calendar-alt"></i>
                <span>Events</span>
            </a>
            <a href="aboutus.php">
                <i class="fas fa-info-circle"></i>
                <span>About Us</span>
            </a>
            <a href="contact.php">
                <i class="fas fa-envelope"></i>
                <span>Contact</span>
            </a>
            <a href="user_logout.php" onclick="return confirm('Are you sure you want to logout?')">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <div class="header fade-in">
            <h1><i class="fas fa-plus"></i> Add Task</h1>
            <div class="header-actions">
                <a href="<?php echo task; ?>" class="btn-modern btn-primary-modern">
                    <i class="fas fa-home"></i> Home
                </a>
                <a href="user_logout.php" class="btn-modern btn-danger-modern" onclick="return confirm('Are you sure you want to logout?')">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
        <div class="form-container fade-in">
            <?php
            if (isset($_SESSION['add_fail'])) {
                echo '<div class="alert alert-danger">'.$_SESSION['add_fail'].'</div>';
                unset($_SESSION['add_fail']);
            }
            ?>
            <form method="POST" action="">
                <div class="form-title">Add Task</div>
                <div class="mb-3">
                    <label class="form-label">Task Name</label>
                    <input type="text" name="task_name" class="form-control" placeholder="Type your Task Name" required />
                </div>
                <div class="mb-3">
                    <label class="form-label">Task Description</label>
                    <textarea name="task_description" class="form-control" placeholder="Type Task Description"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Select List</label>
                    <select name="list_id" class="form-select">
                        <?php
                        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        $db_select = mysqli_select_db($conn, DB_NAME);
                        if (!$db_select) {
                            die("Database selection failed: " . mysqli_error($conn));
                        }
                        $sql = "SELECT * FROM tbl_lists";
                        $res = mysqli_query($conn, $sql);
                        if ($res == true) {
                            $count_rows = mysqli_num_rows($res);
                            if ($count_rows > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $list_id = $row['list_id'];
                                    $list_name = $row['list_name'];
                                    echo "<option value=\"$list_id\">$list_name</option>";
                                }
                            } else {
                                echo '<option value="0">None</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Priority:</label>
                    <select name="priority" class="form-select">
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deadline</label>
                    <input type="date" class="form-control" name="deadline" />
                </div>
                <button type="submit" class="btn-submit" name="submit">
                    <i class="fas fa-plus"></i> Add
                </button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const toggleBtn = document.querySelector('.sidebar-toggle');
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('sidebar-open', sidebar.classList.contains('active'));
            toggleBtn.classList.toggle('sidebar-open', sidebar.classList.contains('active'));
        }
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.querySelector('.sidebar-toggle');
            const mainContent = document.getElementById('mainContent');
            if (!sidebar.contains(event.target) && !toggle.contains(event.target)) {
                sidebar.classList.remove('active');
                mainContent.classList.remove('sidebar-open');
                toggle.classList.remove('sidebar-open');
            }
        });
    </script>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $task_name = $_POST['task_name'];
    $task_description = $_POST['task_description'];
    $list_id = $_POST['list_id'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];

    $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
    if (!$conn2) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $db_select2 = mysqli_select_db($conn2, DB_NAME);
    if (!$db_select2) {
        die("Database selection failed: " . mysqli_error($conn2));
    }

    $sql2 = "INSERT INTO tbl_tasks SET 
            task_name = '$task_name',
            task_description = '$task_description',
            list_id = $list_id,
            priority = '$priority',
            deadline = '$deadline',
            user_id = $user_id
        ";
    $res2 = mysqli_query($conn2, $sql2);

    if ($res2 == true) {
        $_SESSION['add'] = "Task Added Successfully.";
        ?>
        <script>
            alert("Task Added Successfully.");
            window.location = "<?php echo task; ?>";
        </script>
        <?php
    } else {
        $_SESSION['add_fail'] = "Failed to Add Task";
        ?>
        <script>
            alert("Failed to Add Task");
            window.location = "<?php echo SITEURL . 'add-task.php'; ?>";
        </script>
        <?php
    }
}
?>

