<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <div class="container">
            <h1>
            <img src="12.jpg" alt="Logo"></h1>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="aboutus.php">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="logout.php">Logout</a></li>

            </ul>
        </div>
    </nav>
    <div class="content">
        <!-- Your content here -->
        <p>This is the main content area.</p>
    </div>
</body>
<style>
body {
    margin: 0;
    padding: 0;
    height: 100vh;
    width: 100%;
    background-image:url("bg.jpg");
    background-position: center;
    background-size: cover;
}
nav .container h1 img {
    width: 80px; /* Adjust width as needed */
    height: 80px; /* Adjust height as needed */
    border-radius: 50%; /* Make the image round */
    margin-right: 10px; /* Add some spacing between the image and text */
    display: flex;


}

nav {
    background-color: rgba(51, 51, 51, 0.5);
    color: #fff;
    backdrop-filter: blur(10px); 
    background-size: cover; 
    background-repeat: no-repeat; 
    border-bottom: 2px solid #fff; 
}
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;

}

h1 {
    margin: 0;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

li {
    display: inline;
    margin-left: 20px;
}

a {
    text-decoration: none;
    color: #fff;
}
</style>
</html>
