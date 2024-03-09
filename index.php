<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="slide-navbar-style.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <title>Organize hub</title>
</head>
<header>
        <h1>Welcome to Orgainze Hub !</h1>
        
</header>
<body>
    <div class="main">  	
        <input type="checkbox" id="chk" aria-hidden="true">
            <div class="signup">
            <form method="POST">
                <label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="username" placeholder="User name" required="">
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="password" placeholder="Password" required="">
                <button type="submit" name="signup">Sign up</button>
            </form>
        </div>
		
<?php
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['signup'])) {
		// Handle user signup
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		$stmt->bind_param("sss", $username, $email, $hashedPassword);

		if ($stmt->execute()) {
			echo "<script>alert('Signup successful!')</script>";
			header("Location: dashboard.php"); 
			exit();
		} else {
			echo "<script>alert('Signup failed. Please try again.')</script>";
		}

		$stmt->close();
	} elseif (isset($_POST['login'])) {
		// Handle user login
		$email = $_POST['login_email'];
		$password = $_POST['login_password'];

		$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			if (password_verify($password, $row['password'])) {
				
				echo "<script>alert('Login successful!')</script>";
				header("Location: dashboard.php"); 
				exit();
			} else {
				echo "<script>alert('Invalid password.')</script>";
			}
		} else {
			echo "<script>alert('Email not found.')</script>";
		}

		$stmt->close();
	}
}

$conn->close();
?>


        <div class="login">
            <form method="POST">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="login_email" placeholder="Email" required="">
                <input type="password" name="login_password" placeholder="Password" required="">
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>
</body>
<style>
       @import url('https://fonts.googleapis.com/css2?family=Anta&display=swap');

*{
    font-family: "Anta", sans-serif;
    font-weight: 400;
    font-style: normal;
}
    h1{
        color: aqua;
        padding: 20px;
        font-size:35px;
        justify-content: left;
    }
  

    body{
	margin: 0;
	padding: 0;
	display: flex;
	justify-content: center;
	align-items: center;
	min-height: 100vh;
	font-family: 'Anta', sans-serif;
	background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
}
.main{
	width: 350px;
	height: 500px;
	background: red;
	overflow: hidden;
	background: url("https://doc-08-2c-docs.googleusercontent.com/docs/securesc/68c90smiglihng9534mvqmq1946dmis5/fo0picsp1nhiucmc0l25s29respgpr4j/1631524275000/03522360960922298374/03522360960922298374/1Sx0jhdpEpnNIydS4rnN4kHSJtU1EyWka?e=view&authuser=0&nonce=gcrocepgbb17m&user=03522360960922298374&hash=tfhgbs86ka6divo3llbvp93mg4csvb38") no-repeat center/ cover;
	border-radius: 10px;
	box-shadow: 5px 20px 50px #000;
}
#chk{
	display: none;
}
.signup{
	position: relative;
	width:100%;
	height: 100%;
    
}
label{
	font-size: 2.3em;
	justify-content: center;
	display: flex;
	margin: 60px;
	font-weight: bold;
	cursor: pointer;
	transition: .5s ease-in-out;
    color: white;
}
input{
	width: 60%;
	height: 20px;
	background: #e0dede;
	justify-content: center;
	display: flex;
	margin: 20px auto;
	padding: 10px;
	border: none;
	outline: none;
	border-radius: 5px;
}
button{
	width: 60%;
	height: 40px;
	margin: 10px auto;
	justify-content: center;
	display: block;
	color: #fff;
	background: #573b8a;
	font-size: 1em;
	font-weight: bold;
	margin-top: 20px;
	outline: none;
	border: none;
	border-radius: 5px;
	transition: .2s ease-in;
	cursor: pointer;
}
button:hover{
	background: #6d44b8;
}
.login{
	height: 460px;
	background: #eee;
	border-radius: 60% / 10%;
	transform: translateY(-180px);
	transition: .8s ease-in-out;
}
.login label{
	color: #573b8a;
	transform: scale(.6);
}

#chk:checked ~ .login{
	transform: translateY(-500px);
}
#chk:checked ~ .login label{
	transform: scale(1);	
}
#chk:checked ~ .signup label{
	transform: scale(.6);
}

</style>
</html>

