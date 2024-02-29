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
        <h2>About Our Task Manager</h2>
        <p>Welcome to our task manager application! Our task manager is designed to help individuals and teams organize their tasks efficiently, boost productivity, and achieve their goals.</p>
        
        <h3>Our Mission</h3>
        <p>Our mission is to provide a user-friendly and feature-rich task management solution that simplifies task organization, enhances collaboration, and improves overall productivity.</p>
        
        <h3>Key Features</h3>
        <p>Our task manager application offers a range of powerful features, including:</p>
        <ul>
            <li>Task creation and assignment</li>
            <li>Prioritization and categorization of tasks</li>
            <li>Due date tracking and reminders</li>
            <li>Integration with popular tools and platforms</li>
            <!-- Add more features as needed -->
        </ul>
        
        <h3>Why Choose Our Task Manager?</h3>
        <p>There are many reasons to choose our task manager for your personal and professional task management needs:</p>
        <ul>
            <li>Intuitive and user-friendly interface</li>
            <li>Flexible customization options to suit your workflow</li>
            <li>Secure and reliable data storage</li>
            <li>Efficient team collaboration features</li>
            <li>Regular updates and customer support</li>
            <!-- Add more reasons as needed -->
        </ul>
      
    </div>
</section>
</body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Anta&display=swap');

    *{
        font-family: "Anta", sans-serif;
        font-weight: 400;
        font-style: normal;
    }

  #about {
    padding: 80px 0;
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
