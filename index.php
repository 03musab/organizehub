<?php


include 'db.php';

session_start();
if(isset($_SESSION['user_id'])){
	$user_id = $_SESSION['user_id'];
 }else{
	$user_id = '';
 };
if(isset($_POST['signup'])){

	$name = $_POST['username'];
	$name = filter_var($name, FILTER_SANITIZE_STRING);
	$email = $_POST['email'];
	$email = filter_var($email, FILTER_SANITIZE_STRING);
	$pass = sha1($_POST['password']);
	$pass = filter_var($pass, FILTER_SANITIZE_STRING);
	
 
	$select_user = $conn->prepare("SELECT * FROM `users` WHERE Email = ?");
	$select_user->execute([$email,]);
	$row = $select_user->fetch(PDO::FETCH_ASSOC);
 
	if($select_user->rowCount() > 0){
		echo '<script>alert("email already exists!")</script>';;
	}else{
		  $insert_user = $conn->prepare("INSERT INTO `users`(Username, Email, Password) VALUES(?,?,?)");
		  $insert_user->execute([$name, $email, $pass]);
		  $_SESSION['user_id'] = $row['user_id'];
		  echo '<script>alert("Registration Successful! Please Login now "); window.location.href = "index.php";</script>';

	}
 
 }
 
if(isset($_POST['login'])){

	$email = $_POST['login_email'];
	$email = filter_var($email, FILTER_SANITIZE_STRING);
	$pass = sha1($_POST['login_password']);
	$pass = filter_var($pass, FILTER_SANITIZE_STRING);
 
	$select_user = $conn->prepare("SELECT * FROM `users` WHERE Email = ? AND Password = ?");
	$select_user->execute([$email, $pass]);
	$row = $select_user->fetch(PDO::FETCH_ASSOC);
 
	if($select_user->rowCount() > 0){
	   $_SESSION['user_id'] = $row['user_id'];
		header('location:taskmanager.php');
	}else{
		echo '<script>alert("incorrect Email or password!")</script>';
	}
 
 }
?>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="slide-navbar-style.css">
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	

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
				<input type="submit" name="signup" value="REGISTER" class="btn">
		

			</form>
		</div>

		<?php
		
		?>


		<div class="login">
			<form method="POST">
				<label for="chk" aria-hidden="true">Login</label>
				<input type="email" name="login_email" placeholder="Email" required="">
				<input type="password" name="login_password" placeholder="Password" required="">
				<input type="submit" name="login" value="LOGIN" class="btn">

			</form>
		</div>
</body>
<style>
	@import url('https://fonts.googleapis.com/css2?family=Anta&display=swap');

	* {
		font-family: "Open Sans", sans-serif;
		font-weight: 300;
		font-style: normal;
	}

	h1 {
		color: aqua;
		font-weight: 650;
		padding: 20px;
		font-size: 55px;
		justify-content: left;
	}


	body {
		margin: 0;
		padding: 0;
		display: flex;
		justify-content: center;
		align-items: center;
		min-height: 100vh;
		font-family: 'Anta', sans-serif;
		background: linear-gradient(to bottom, #0d0d5c, #000000, #0d0d5c)
	}

	.main {
		width: 350px;
		height: 500px;
		background: red;
		overflow: hidden;
		background: url("https://doc-08-2c-docs.googleusercontent.com/docs/securesc/68c90smiglihng9534mvqmq1946dmis5/fo0picsp1nhiucmc0l25s29respgpr4j/1631524275000/03522360960922298374/03522360960922298374/1Sx0jhdpEpnNIydS4rnN4kHSJtU1EyWka?e=view&authuser=0&nonce=gcrocepgbb17m&user=03522360960922298374&hash=tfhgbs86ka6divo3llbvp93mg4csvb38") no-repeat center/ cover;
		border-radius: 10px;
		box-shadow: 5px 20px 50px #000;
	}

	#chk {
		display: none;
	}

	.signup {
		position: relative;
		width: 100%;
		height: 100%;

	}

	.containergg {
		display: flex;
		flex-direction: column;
		align-items: center;
		font-size: 20px;
	}

	.g-signin2 {
		display: flex;
		flex-direction: column;
		align-items: center;
		padding-top: 10px;
	}

	label {
		font-size: 2.3em;
		justify-content: center;
		display: flex;
		margin: 60px;
		font-weight: bold;
		cursor: pointer;
		transition: .5s ease-in-out;
		color: white;
	}

	input {
		width: 60%;
		height: 40px;
		background: #e0dede;
		justify-content: center;
		display: flex;
		margin: 20px auto;
		padding: 10px;
		border: none;
		outline: none;
		border-radius: 5px;
	}

	button {
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

	button:hover {
		background: #6d44b8;
	}

	.login {
		height: 460px;
		background: #eee;
		border-radius: 60% / 10%;
		transform: translateY(-180px);
		transition: .8s ease-in-out;
	}

	.login label {
		color: #573b8a;
		transform: scale(.6);
	}

	#chk:checked~.login {
		transform: translateY(-500px);
	}

	#chk:checked~.login label {
		transform: scale(1);
	}

	#chk:checked~.signup label {
		transform: scale(.6);
	}
	
.message{
   position: sticky;
   top:0;
   max-width: 1200px;
   margin:0 auto;
   background-color: var(--light-bg);
   padding:2rem;
   display: flex;
   align-items: center;
   justify-content: space-between;
   gap:1.5rem;
   z-index: 1100;
}

.message span{
   font-size: 2rem;
   color:var(--black);
}

.message i{
   cursor: pointer;
   color:var(--red);
   font-size: 2.5rem;
}

.message i:hover{
   color:var(--black);
}
.btn {
        background-color:#33b249;
        color: black;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease;
		font-weight: bold; /* Added font-weight to make text bold */
		letter-spacing: 1px; /* Added letter-spacing to add space between characters */


    }

    .btn:hover {
        background-color: green;
    }

    .btn:active {
        background-color: green;
    }
</style>

</html>