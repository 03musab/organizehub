<?php
// No PHP logic needed for this static page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - OrganizeHub</title>
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
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: var(--text-primary);
            margin: 0;
            padding: 0;
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
            position: fixed;
            top: 1.5rem;
            left: 1.5rem;
            z-index: 2001;
            background: var(--bg-primary);
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            box-shadow: var(--shadow);
            cursor: pointer;
            transition: all 0.2s ease, left 0.3s cubic-bezier(0.4,0,0.2,1);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .sidebar-toggle:hover {
            background: var(--primary-color);
            color: white;
            transform: scale(1.05);
        }
        .sidebar-toggle i { font-size: 1.2rem; }
        .sidebar-toggle.sidebar-open { left: 300px; }
        #mainContent {
            transition: margin-left 0.3s ease;
            padding: 2rem;
            min-height: 100vh;
        }
        #mainContent.sidebar-open { margin-left: 280px; }
        .about-container {
            background: var(--bg-primary);
            border-radius: 16px;
            padding: 2.5rem 2rem;
            box-shadow: var(--shadow);
            max-width: 800px;
            margin: 3rem auto 0 auto;
        }
        .about-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }
        .about-logo img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(99,102,241,0.15);
        }
        .about-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .about-section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-dark);
            margin-top: 2rem;
            margin-bottom: 1rem;
        }
        .about-text {
            font-size: 1.1rem;
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .about-list {
            list-style: none;
            padding-left: 0;
            margin-bottom: 1.5rem;
        }
        .about-list li {
            margin-bottom: 0.75rem;
            padding-left: 1.5rem;
            position: relative;
            color: var(--text-primary);
            font-size: 1.05rem;
        }
        .about-list li:before {
            content: "\f058";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            color: var(--primary-color);
            position: absolute;
            left: 0;
            top: 0;
        }
        @media (max-width: 768px) {
            #mainContent { padding: 1rem; }
            .about-container { padding: 1rem; }
            .about-title { font-size: 2rem; }
            .about-section-title { font-size: 1.2rem; }
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
            <a href="aboutus.php" class="active">
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
    <div id="mainContent">
        <div class="about-container fade-in">
            <div class="about-logo">
                <img src="og.jpg" alt="OrganizeHub Logo">
            </div>
            <div class="about-title">About OrganizeHub</div>
            <div class="about-text">
                Welcome to OrganizeHub! Our platform is designed to help individuals and teams organize their tasks efficiently, boost productivity, and achieve their goals.
            </div>
            <div class="about-section-title">Key Features</div>
            <ul class="about-list">
                <li>Task creation and assignment</li>
                <li>Prioritization and categorization of tasks</li>
                <li>Multi-list and calendar integration</li>
                <li>Modern, responsive interface</li>
                <li>Secure and reliable data storage</li>
            </ul>
            <div class="about-section-title">Why Choose OrganizeHub?</div>
            <ul class="about-list">
                <li>Intuitive and user-friendly interface</li>
                <li>Flexible customization options to suit your workflow</li>
                <li>Regular updates and customer support</li>
                <li>Seamless collaboration for teams</li>
            </ul>
            <div class="about-text">
                Thank you for choosing OrganizeHub to manage your tasks and boost your productivity!
            </div>
        </div>
    </div>
    <script>
       // Fixed JavaScript for About Us page sidebar functionality

// Option 1: Define function in global scope (if keeping onclick attribute)
function toggleSidebar() {
    console.log('toggleSidebar called'); // for debugging
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const toggleBtn = document.querySelector('.sidebar-toggle');
    
    sidebar.classList.toggle('active');
    mainContent.classList.toggle('sidebar-open', sidebar.classList.contains('active'));
    toggleBtn.classList.toggle('sidebar-open', sidebar.classList.contains('active'));
}

// Ensure function is available globally
window.toggleSidebar = toggleSidebar;

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

console.log('About Us page script loaded');
    </script>
</body>
</html>