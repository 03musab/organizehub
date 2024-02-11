<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organize hub</title>
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
                <li><a href="contact.php">Contact</a></li>
                <li><a href="logout.php">Logout</a></li>

            </ul>
        </div>
    </nav>
    <section id="about">
    <div class="container2">
        <h1>Contact Us</h1>
        <p>If you have any questions, feedback, or inquiries about our task manager application, please don't hesitate to contact us. We're here to help!</p>
        <p>Email: info@taskmanager.com</p>
        <p>Phone: +123-456-7890</p>
    </div>
</section>
</body>
<style>
  #about {
    padding: 10%;
    background-color:transparent;
    backdrop-filter: blur(10px); /* Apply blur effect */

  }


.container2 {
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
    background-color: rgba(255, 255, 255, 0.7); /* Container background color with opacity */
    padding: 40px;
    border-radius: 10px; /* Optional: Add rounded corners for better visual appeal */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Optional: Add a subtle shadow for depth */
}

.container2 h2 {
    font-size: 2.5rem;
    margin-bottom: 30px;
    color: black;
}

.container2 h3 {
    font-size: 1.8rem;
    margin-top: 40px;
    color: black;
}

.container2 p {
    font-size: 1.2rem;
    line-height: 1.6;
    color: black;
}

.container2 ul {
    list-style: none;
    padding-left: 0;
    margin-top: 20px;
}

.container2 ul li {
    margin-bottom: 10px;
}

.container2 ul li:before {
    content: "\2022"; /* Bullet character */
    color: #333;
    font-size: 1.2rem;
    margin-right: 10px;
}

.container2 p:last-child {
    margin-top: 40px;
}

.container2 p:last-child a {
    color: #007bff;
    text-decoration: none;
}

.container2 p:last-child a:hover {
    text-decoration: underline;
}

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
