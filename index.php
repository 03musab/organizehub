<?php
include 'db.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: taskmanager.php');
    exit();
}

if (isset($_POST['signup'])) {
    $name = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass = htmlspecialchars(sha1($_POST['password']), ENT_QUOTES, 'UTF-8');

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE Email = ?");
    $select_user->execute([$email]);
    
    if ($select_user->rowCount() > 0) {
        echo "<script>alert('Email already exists!');</script>";
    } else {
        $insert_user = $conn->prepare("INSERT INTO `users`(Username, Email, Password) VALUES(?, ?, ?)");
        $insert_user->execute([$name, $email, $pass]);
        echo "<script>alert('Registration Successful! Please login now.');</script>";
    }
}

if (isset($_POST['login'])) {
    $email = filter_var($_POST['login_email'], FILTER_SANITIZE_EMAIL);
    $pass = filter_var(sha1($_POST['login_password']), FILTER_SANITIZE_STRING);

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE Email = ? AND Password = ?");
    $select_user->execute([$email, $pass]);

    if ($select_user->rowCount() > 0) {
        $row = $select_user->fetch();
        $_SESSION['user_id'] = $row['user_id'];
        header('Location: taskmanager.php');
        exit();
    } else {
        echo "<script>alert('Incorrect email or password!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organize Hub - Login & Register</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6366f1;
            --secondary-color: #8b5cf6;
            --accent-color: #06d6a0;
            --danger-color: #ef4444;
            --success-color: #10b981;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --gradient: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            --text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--gradient);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(1deg); }
            66% { transform: translateY(10px) rotate(-1deg); }
        }

        .header {
            position: absolute;
            top: 2rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            text-align: center;
        }

        .header h1 {
            color: white;
            font-size: 2.5rem;
            font-weight: 800;
            text-shadow: var(--text-shadow);
            margin-bottom: 0.5rem;
        }

        .header p {
            color: rgba(255,255,255,0.8);
            font-size: 1.1rem;
        }

        .auth-container {
            position: relative;
            z-index: 5;
            width: 100%;
            max-width: 400px;
            margin: 2rem;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            overflow: hidden;
            position: relative;
        }

        .tab-container {
            display: flex;
            background: var(--light-color);
            border-bottom: 1px solid #e2e8f0;
        }

        .tab {
            flex: 1;
            padding: 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            color: #64748b;
            border-bottom: 3px solid transparent;
        }

        .tab.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
            background: white;
        }

        .form-container {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark-color);
            font-size: 0.9rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 1rem;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .btn {
            width: 100%;
            padding: 1rem;
            background: var(--gradient);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 1rem;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.3);
        }

        .btn:active {
            transform: translateY(0);
        }

        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .floating-element {
            position: absolute;
            opacity: 0.1;
            animation: floatRandom 15s infinite linear;
            color: white;
        }

        .floating-element:nth-child(1) { top: 20%; left: 10%; animation-delay: 0s; }
        .floating-element:nth-child(2) { top: 60%; right: 15%; animation-delay: 5s; }
        .floating-element:nth-child(3) { bottom: 30%; left: 20%; animation-delay: 10s; }

        @keyframes floatRandom {
            0% { transform: translateY(0px) rotate(0deg); }
            25% { transform: translateY(-20px) rotate(90deg); }
            50% { transform: translateY(10px) rotate(180deg); }
            75% { transform: translateY(-15px) rotate(270deg); }
            100% { transform: translateY(0px) rotate(360deg); }
        }

        @media (max-width: 768px) {
            .header h1 { font-size: 2rem; }
            .auth-container { margin: 1rem; }
            .form-container { padding: 1.5rem; }
        }

        .back-home {
            position: absolute;
            top: 1.5rem;
            left: 1.5rem;
            z-index: 20;
            color: #6366f1;
            background: rgba(255,255,255,0.85);
            padding: 0.5rem 1.2rem 0.5rem 0.8rem;
            border-radius: 30px;
            font-weight: 600;
            text-decoration: none;
            font-size: 1rem;
            box-shadow: 0 2px 8px rgba(99,102,241,0.08);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: background 0.2s, color 0.2s;
        }
        .back-home:hover {
            background: #6366f1;
            color: #fff;
        }
    </style>
</head>
<body>
    <!-- Back to Home Button -->
    <a href="index.html" class="back-home">
        <i class="fas fa-arrow-left"></i> Back to Home
    </a>
    <div class="floating-elements">
        <i class="fas fa-user-plus floating-element" style="font-size: 3rem;"></i>
        <i class="fas fa-lock floating-element" style="font-size: 2.5rem;"></i>
        <i class="fas fa-shield-alt floating-element" style="font-size: 3.5rem;"></i>
    </div>

 
    <div class="auth-container">
        <div class="auth-card">
            <div class="tab-container">
                <div class="tab active" onclick="switchTab('login')">
                    <i class="fas fa-sign-in-alt"></i> Login
                </div>
                <div class="tab" onclick="switchTab('signup')">
                    <i class="fas fa-user-plus"></i> Sign Up
                </div>
            </div>

            <div class="form-container">
                <!-- Login Form -->
                <div id="login-form" class="form-section active">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="login_email">Email Address</label>
                            <div class="input-wrapper">
                                <i class="fas fa-envelope"></i>
                                <input type="email" id="login_email" name="login_email" class="form-input" 
                                       placeholder="Enter your email" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="login_password">Password</label>
                            <div class="input-wrapper">
                                <i class="fas fa-lock"></i>
                                <input type="password" id="login_password" name="login_password" class="form-input" 
                                       placeholder="Enter your password" required>
                            </div>
                        </div>

                        <button type="submit" name="login" class="btn">
                            <i class="fas fa-sign-in-alt"></i> Login to Dashboard
                        </button>
                    </form>
                </div>

                <!-- Signup Form -->
                <div id="signup-form" class="form-section">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="username">Full Name</label>
                            <div class="input-wrapper">
                                <i class="fas fa-user"></i>
                                <input type="text" id="username" name="username" class="form-input" 
                                       placeholder="Enter your full name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <div class="input-wrapper">
                                <i class="fas fa-envelope"></i>
                                <input type="email" id="email" name="email" class="form-input" 
                                       placeholder="Enter your email" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-wrapper">
                                <i class="fas fa-lock"></i>
                                <input type="password" id="password" name="password" class="form-input" 
                                       placeholder="Create a password" required>
                            </div>
                        </div>

                        <button type="submit" name="signup" class="btn">
                            <i class="fas fa-user-plus"></i> Create Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            // Update tab appearance
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            event.target.classList.add('active');

            // Show/hide forms
            document.querySelectorAll('.form-section').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(tab + '-form').classList.add('active');
        }

        // Auto-focus first input field
        document.addEventListener('DOMContentLoaded', function() {
            const activeForm = document.querySelector('.form-section.active');
            const firstInput = activeForm.querySelector('input');
            if (firstInput) {
                firstInput.focus();
            }
        });
    </script>
</body>
</html>