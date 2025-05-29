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
$list_id_url = $_GET['list_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OrganizeHub - List Tasks</title>
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: var(--text-primary);
        }

        /* Sidebar */
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

        .sidebar.active {
            left: 0;
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
        }

        .sidebar-header h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .sidebar-nav {
            padding: 2rem 0;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.2s ease;
            border-left: 4px solid transparent;
        }

        .sidebar-nav a:hover {
            background: var(--secondary-color);
            border-left-color: var(--primary-color);
            color: var(--primary-color);
            transform: translateX(5px);
        }

        .sidebar-nav a i {
            width: 20px;
            margin-right: 1rem;
            font-size: 1.1rem;
        }

        /* Toggle Button */
        .sidebar-toggle {
            position: fixed;
            top: 1.5rem;
            left: 1.5rem;
            z-index: 1001;
            background: var(--bg-primary);
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            box-shadow: var(--shadow);
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-toggle:hover {
            background: var(--primary-color);
            color: white;
            transform: scale(1.05);
        }

        .sidebar-toggle i {
            font-size: 1.2rem;
        }

        /* Main Content */
        .main-content {
            margin-left: 0;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
            padding: 2rem;
        }
        #mainContent {
            transition: margin-left 0.3s ease;
        }
        #mainContent.sidebar-open {
            margin-left: 280px;
        }
        .sidebar-toggle.sidebar-open {
            left: 300px;
        }

        /* Header */
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

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
        }

        .btn-modern {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-primary-modern {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary-modern:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-danger-modern {
            background: var(--danger-color);
            color: white;
        }

        .btn-danger-modern:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }

        /* Navigation Tabs */
        .nav-tabs-modern {
            background: var(--bg-primary);
            border-radius: 16px;
            padding: 1rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .nav-tab-modern {
            padding: 0.75rem 1.5rem;
            background: transparent;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .nav-tab-modern:hover,
        .nav-tab-modern.active {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        /* Tasks Container */
        .tasks-container {
            background: var(--bg-primary);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--shadow);
        }

        /* Enhanced Table */
        .table-modern {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .table-modern thead th {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 1.5rem 1rem;
            font-weight: 600;
            text-align: left;
            border: none;
        }

        .table-modern tbody tr {
            transition: all 0.2s ease;
        }

        .table-modern tbody tr:hover {
            background: var(--secondary-color);
            transform: scale(1.01);
        }

        .table-modern tbody td {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table-modern tbody tr:last-child td {
            border-bottom: none;
        }

        /* Priority Badges */
        .priority-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .priority-high {
            background: #fee2e2;
            color: var(--danger-color);
        }

        .priority-medium {
            background: #fef3c7;
            color: var(--warning-color);
        }

        .priority-low {
            background: #d1fae5;
            color: var(--accent-color);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-sm-modern {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            transition: all 0.2s ease;
        }

        .btn-success-modern {
            background: var(--accent-color);
            color: white;
        }

        .btn-success-modern:hover {
            background: #059669;
            transform: translateY(-1px);
        }

        .btn-danger-sm-modern {
            background: var(--danger-color);
            color: white;
        }

        .btn-danger-sm-modern:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-secondary);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-state h3 {
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }

            .header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .header h1 {
                font-size: 2rem;
            }

            .nav-tabs-modern {
                flex-direction: column;
            }

            .table-modern {
                font-size: 0.875rem;
            }

            .table-modern thead th,
            .table-modern tbody td {
                padding: 1rem 0.5rem;
            }

            .action-buttons {
                flex-direction: column;
            }
        }

        /* Fade-in Animation */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
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
        <!-- Header -->
        <div class="header fade-in">
            <h1><i class="fas fa-list"></i> List Tasks</h1>
            <div class="header-actions">
                <a href="<?php echo SITEURL; ?>add-task.php" class="btn-modern btn-primary-modern">
                    <i class="fas fa-plus"></i>
                    Add New Task
                </a>
                <a href="user_logout.php" class="btn-modern btn-danger-modern" onclick="return confirm('Are you sure you want to logout?')">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="nav-tabs-modern fade-in">
            <a href="taskmanager.php" class="nav-tab-modern">
                <i class="fas fa-list"></i> All Tasks
            </a>
            <?php
            $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
            if (!$conn2) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error($conn2));
            $sql2 = "SELECT * FROM tbl_lists ORDER BY list_name";
            $res2 = mysqli_query($conn2, $sql2);
            if ($res2 == true) {
                while ($row2 = mysqli_fetch_assoc($res2)) {
                    $list_id = $row2['list_id'];
                    $list_name = $row2['list_name'];
                    $active = ($list_id_url == $list_id) ? 'active' : '';
                    ?>
                    <a href="<?php echo SITEURL; ?>list-task.php?list_id=<?php echo $list_id; ?>" class="nav-tab-modern <?php echo $active; ?>">
                        <i class="fas fa-folder"></i> <?php echo htmlspecialchars($list_name); ?>
                    </a>
                    <?php
                }
            }
            ?>
        </div>

        <!-- Tasks Container -->
        <div class="tasks-container fade-in">
            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag"></i> #</th>
                            <th><i class="fas fa-tasks"></i> Task Name</th>
                            <th><i class="fas fa-flag"></i> Priority</th>
                            <th><i class="fas fa-calendar"></i> Deadline</th>
                            <th><i class="fas fa-cogs"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));
                        $sql = "SELECT * FROM tbl_tasks WHERE list_id=$list_id_url and user_id = $user_id";
                        $res = mysqli_query($conn, $sql);
                        if ($res == true) {
                            $sn = 1;
                            $count_rows = mysqli_num_rows($res);
                            if ($count_rows > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $task_id = $row['task_id'];
                                    $task_name = $row['task_name'];
                                    $priority = $row['priority'];
                                    $deadline = $row['deadline'];
                                    // Determine priority class
                                    $priority_class = 'priority-low';
                                    if (strtolower($priority) == 'high') {
                                        $priority_class = 'priority-high';
                                    } elseif (strtolower($priority) == 'medium') {
                                        $priority_class = 'priority-medium';
                                    }
                                    ?>
                                    <tr>
                                        <td><strong><?php echo $sn++; ?></strong></td>
                                        <td>
                                            <strong><?php echo htmlspecialchars($task_name); ?></strong>
                                        </td>
                                        <td>
                                            <span class="priority-badge <?php echo $priority_class; ?>">
                                                <?php echo htmlspecialchars($priority); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <i class="fas fa-calendar"></i> 
                                            <?php echo date('M d, Y', strtotime($deadline)); ?>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id; ?>" 
                                                   class="btn-sm-modern btn-success-modern">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>" 
                                                   class="btn-sm-modern btn-danger-sm-modern"
                                                   onclick="return confirm('Are you sure you want to delete this task?')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5">
                                        <div class="empty-state">
                                            <i class="fas fa-clipboard-list"></i>
                                            <h3>No Tasks Found</h3>
                                            <p>Get started by adding your first task!</p>
                                            <a href="<?php echo SITEURL; ?>add-task.php" class="btn-modern btn-primary-modern">
                                                <i class="fas fa-plus"></i> Add Task
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scripts -->
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

        // Close sidebar when clicking outside
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

        // Add smooth transitions and animations
        document.addEventListener('DOMContentLoaded', function() {
            // Add fade-in animation to table rows
            const rows = document.querySelectorAll('.table-modern tbody tr');
            rows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.1}s`;
                row.classList.add('fade-in');
            });
        });
    </script>
</body>
</html>