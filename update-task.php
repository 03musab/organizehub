<?php 
    include('config/constants.php');
    session_start();

    // Initialize variables
    $task_name = '';
    $task_description = '';
    $list_id = 0;
    $priority = 'Medium';
    $deadline = '';
    $error_message = '';
    $success_message = '';

    // Handle form submission FIRST (before any HTML output)
    if(isset($_POST['submit'])) {
        try {
            // Validate task_id
            if(!isset($_GET['task_id']) || !is_numeric($_GET['task_id'])) {
                throw new Exception("Invalid task ID provided.");
            }
            
            $task_id = intval($_GET['task_id']);
            
            // Sanitize and validate input
            $task_name = trim($_POST['task_name']);
            $task_description = trim($_POST['task_description']);
            $list_id = intval($_POST['list_id']);
            $priority = $_POST['priority'];
            $deadline = $_POST['deadline'];
            
            // Validation
            if(empty($task_name)) {
                throw new Exception("Task name is required.");
            }
            
            if(strlen($task_name) > 255) {
                throw new Exception("Task name is too long (maximum 255 characters).");
            }
            
            if(!in_array($priority, ['High', 'Medium', 'Low'])) {
                throw new Exception("Invalid priority selected.");
            }
            
            if(!empty($deadline) && !strtotime($deadline)) {
                throw new Exception("Invalid deadline format.");
            }
            
            // Database connection with error handling
            $conn3 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
            if (!$conn3) {
                throw new Exception("Database connection failed: " . mysqli_connect_error());
            }
            
            $db_select3 = mysqli_select_db($conn3, DB_NAME);
            if (!$db_select3) {
                mysqli_close($conn3);
                throw new Exception("Database selection failed: " . mysqli_error($conn3));
            }
            
            // Use prepared statement to prevent SQL injection
            $sql3 = "UPDATE tbl_tasks SET 
                    task_name = ?,
                    task_description = ?,
                    list_id = ?,
                    priority = ?,
                    deadline = ?
                    WHERE task_id = ?";
            
            $stmt = mysqli_prepare($conn3, $sql3);
            if (!$stmt) {
                mysqli_close($conn3);
                throw new Exception("Failed to prepare statement: " . mysqli_error($conn3));
            }
            
            mysqli_stmt_bind_param($stmt, "ssissi", $task_name, $task_description, $list_id, $priority, $deadline, $task_id);
            
            if (!mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                mysqli_close($conn3);
                throw new Exception("Failed to update task: " . mysqli_stmt_error($stmt));
            }
            
            $affected_rows = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn3);
            
            if($affected_rows === 0) {
                throw new Exception("Task not found or no changes were made.");
            }
            
            $_SESSION['update'] = "Task updated successfully.";
            
            // Use JavaScript redirect instead of header() to avoid headers already sent error
            echo "<script>window.location.href = '" . SITEURL . "task';</script>";
            exit();
            
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            error_log("Task update error: " . $e->getMessage()); // Log the error
        }
    }

    // Fetch task data for display
    if(isset($_GET['task_id']) && is_numeric($_GET['task_id'])) {
        $task_id = intval($_GET['task_id']);
        
        try {
            $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
            if (!$conn) {
                throw new Exception("Database connection failed: " . mysqli_connect_error());
            }
            
            $db_select = mysqli_select_db($conn, DB_NAME);
            if (!$db_select) {
                mysqli_close($conn);
                throw new Exception("Database selection failed: " . mysqli_error($conn));
            }
            
            // Use prepared statement
            $sql = "SELECT * FROM tbl_tasks WHERE task_id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            
            if (!$stmt) {
                mysqli_close($conn);
                throw new Exception("Failed to prepare statement: " . mysqli_error($conn));
            }
            
            mysqli_stmt_bind_param($stmt, "i", $task_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if($row = mysqli_fetch_assoc($result)) {
                $task_name = htmlspecialchars($row['task_name']);
                $task_description = htmlspecialchars($row['task_description']);
                $list_id = intval($row['list_id']);
                $priority = htmlspecialchars($row['priority']);
                $deadline = htmlspecialchars($row['deadline']);
            } else {
                throw new Exception("Task not found.");
            }
            
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            error_log("Task fetch error: " . $e->getMessage());
        }
    } else {
        // Use JavaScript redirect instead of header()
        echo "<script>window.location.href = '" . SITEURL . "task';</script>";
        exit();
    }

    // Handle session messages
    if(isset($_SESSION['update_fail'])) {
        $error_message = $_SESSION['update_fail'];
        unset($_SESSION['update_fail']);
    }
    
    if(isset($_SESSION['update'])) {
        $success_message = $_SESSION['update'];
        unset($_SESSION['update']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>OrganizeHub - Update Task</title>
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
        .alert { margin-bottom: 1rem; border-radius: 8px; }
        .error-container {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .success-container {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #16a34a;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
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
            <h1><i class="fas fa-edit"></i> Update Task</h1>
            <div class="header-actions">
                <a href="<?php echo SITEURL; ?>task" class="btn-modern btn-primary-modern">
                    <i class="fas fa-home"></i> Home
                </a>
                <a href="user_logout.php" class="btn-modern btn-danger-modern" onclick="return confirm('Are you sure you want to logout?')">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
        <div class="form-container fade-in">
            <?php if(!empty($error_message)): ?>
                <div class="error-container">
                     <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            
            <?php if(!empty($success_message)): ?>
                <div class="success-container">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="" onsubmit="return validateForm()">
                <div class="form-title">Update Task</div>
                <div class="mb-3">
                    <label class="form-label">Task Name <span style="color: red;">*</span></label>
                    <input type="text" name="task_name" class="form-control" value="<?php echo $task_name; ?>" required maxlength="255" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Task Description</label>
                    <textarea name="task_description" class="form-control" rows="4"><?php echo $task_description; ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Select List</label>
                    <select name="list_id" class="form-select">
                        <?php 
                            try {
                                $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
                                if (!$conn2) {
                                    throw new Exception("Database connection failed: " . mysqli_connect_error());
                                }
                                
                                $db_select2 = mysqli_select_db($conn2, DB_NAME);
                                if (!$db_select2) {
                                    mysqli_close($conn2);
                                    throw new Exception("Database selection failed: " . mysqli_error($conn2));
                                }
                                
                                $sql2 = "SELECT * FROM tbl_lists ORDER BY list_name";
                                $res2 = mysqli_query($conn2, $sql2);
                                
                                if($res2 && mysqli_num_rows($res2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($res2)) {
                                        $list_id_db = intval($row2['list_id']);
                                        $list_name = htmlspecialchars($row2['list_name']);
                                        $selected = ($list_id_db == $list_id) ? "selected='selected'" : "";
                                        echo "<option $selected value=\"$list_id_db\">$list_name</option>";
                                    }
                                } else {
                                    $selected = ($list_id == 0) ? "selected='selected'" : "";
                                    echo "<option $selected value=\"0\">None</option>";
                                }
                                
                                mysqli_close($conn2);
                                
                            } catch (Exception $e) {
                                echo "<option value=\"0\">None (Error loading lists)</option>";
                                error_log("Lists fetch error: " . $e->getMessage());
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Priority</label>
                    <select name="priority" class="form-select">
                        <option <?php if($priority=="High"){echo "selected='selected'";} ?> value="High">High</option>
                        <option <?php if($priority=="Medium"){echo "selected='selected'";} ?> value="Medium">Medium</option>
                        <option <?php if($priority=="Low"){echo "selected='selected'";} ?> value="Low">Low</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deadline</label>
                    <input type="date" name="deadline" class="form-control" value="<?php echo $deadline; ?>" />
                </div>
                <button type="submit" class="btn-submit" name="submit">
                    <i class="fas fa-save"></i> Update Task
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

        function validateForm() {
            const taskName = document.querySelector('input[name="task_name"]').value.trim();
            if (taskName === '') {
                alert('Task name is required.');
                return false;
            }
            if (taskName.length > 255) {
                alert('Task name is too long (maximum 255 characters).');
                return false;
            }
            const deadline = document.querySelector('input[name="deadline"]').value;
            if (deadline && new Date(deadline) < new Date().setHours(0,0,0,0)) {
                if (!confirm('The deadline is in the past. Do you want to continue?')) {
                    return false;
                }
            }
            return true;
        }

        // Auto-hide success/error messages after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.error-container, .success-container');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            });
        }, 5000);
    </script>
</body>
</html>