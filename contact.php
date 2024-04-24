
<!DOCTYPE html>
<html lang="en">
<style>
    /* Reset styles */
    /* Hide the specific element */
    .a {
        display: none;
    }

    /* Reset all margins, padding, and set font family to verdana */
    * {
        margin: 0;
        padding: 0;
        font-family: verdana;
    }

    .logo {
        position: absolute;
        top: 0;
        right: 0;
        margin: 20px;
    }

    .logo img {
        width: 100px;
        /* Adjust the size as needed */
        height: 100px;
        /* Adjust the size as needed */
        border-radius: 50%;
        /* Make it round */
    }

    /* Main wrapper */
    .wrapper {
        width: 70%;
        margin: 0 auto 2%;
    }

    /* Headings */
    h1 {
        color: #a00000;
        margin-bottom: 2%;
    }

    h3 {
        margin: 2% 0;
    }

    /* Navigation menu */
    .menu {
        margin-bottom: 2%;
    }

    .menu a {
        font-weight: bold;
        margin-right: 1%;
        color: black;
        text-decoration: none;
    }

    .menu a:hover {
        text-decoration: underline;
    }

    /* Buttons */
    .btn-primary,
    .btn-secondary {
        padding: 5px;
        font-weight: bold;
        text-decoration: none;
    }

    .btn-primary {
        background-color: #26de81;
        color: black;
    }

    .btn-primary:hover {
        background-color: #20bf6b;
    }

    .btn-secondary {
        background-color: #778ca3;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #4b6584;
    }

    .btn-lg {
        width: 50%;
    }

    /* Tables */
    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 1%;
    }

    .table th {
        text-align: left;
        border-bottom: 1px solid black;
    }

    /* Additional styles */
    .tbl-half {
        width: 40%;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organize hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>
<style>
    * {
        margin: 0;
        padding: 0;
        text-decoration: none;
    }

    :root {
        --accent-color: #fff;
        --gradient-color: #FBFBFB;
    }

    body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100vw;
        height: 100vh;
        background-image: linear-gradient(-45deg, #e3eefe 0%, #efddfb 100%);
    }

    .sidebar {
         z-index: 1;
        position: fixed;
        width: 250px;
        left: -250px;
        height: 100%;
        background-color: #fff;
        transition: all .5s ease;
    }

    .sidebar header {
        font-size: 28px;
        color: #353535;
        line-height: 70px;
        text-align: center;
        background-color: #fff;
        user-select: none;
        font-family: 'Lato', sans-serif;
    }

    .sidebar a {
        display: block;
        height: 65px;
        width: 100%;
        color: #353535;
        line-height: 65px;
        padding-left: 30px;
        box-sizing: border-box;
        border-left: 5px solid transparent;
        font-family: 'Lato', sans-serif;
        transition: all .5s ease;
    }

    a.active,
    a:hover {
        border-left: 5px solid var(--accent-color);
        color: #fff;
        background: linear-gradient(to left, var(--accent-color), var(--gradient-color));
    }

    .sidebar a i {
        font-size: 23px;
        margin-right: 16px;
    }

    .sidebar a span {
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    #check {
        display: none;
    }

    label #btn,
    label #cancel {
        position: absolute;
        top: 0px;
        /* Adjust top position as needed */
        left: 0px;
        cursor: pointer;
        color: #5c004c;
        border-radius: 5px;
        margin: 15px 30px;
        font-size: 29px;
        background-color: #e8d1ff;
        box-shadow: inset 2px 2px 2px 0px rgba(255, 255, 255, .5),
            inset -7px -7px 10px 0px rgba(0, 0, 0, .1),
            3.5px 3.5px 20px 0px rgba(0, 0, 0, .1),
            2px 2px 5px 0px rgba(0, 0, 0, .1);
        height: 45px;
        width: 45px;
        text-align: center;
        text-shadow: 2px 2px 3px rgba(255, 255, 255, 0.5);
        line-height: 45px;
        transition: all .5s ease;
    }

    label #cancel {
        opacity: 0;
        visibility: hidden;
    }

    #check:checked~.sidebar {
        left: 0;
    }

    #check:checked~label #btn {
        margin-left: 245px;
        opacity: 0;
        visibility: hidden;
    }

    #check:checked~label #cancel {
        margin-left: 245px;
        opacity: 1;
        visibility: visible;
    }

    @media(max-width : 860px) {
        .sidebar {
            height: auto;
            width: 70px;
            left: 0;
            margin: 100px 0;
        }

        header,
        #btn,
        #cancel {
            display: none;
        }

        span {
            position: absolute;
            margin-left: 23px;
            opacity: 0;
            visibility: hidden;
        }

        .sidebar a {
            height: 60px;
        }

        .sidebar a i {
            margin-left: -10px;
        }

        a:hover {
            width: 200px;
            background: inherit;
        }

        .sidebar a:hover span {
            opacity: 1;
            visibility: visible;
        }
    }

    .sidebar>a.active,
    .sidebar>a:hover:nth-child(even) {
        --accent-color: #52d6f4;
        --gradient-color: #c1b1f7;
    }

    .sidebar a.active,
    .sidebar>a:hover:nth-child(odd) {
        --accent-color: #c1b1f7;
        --gradient-color: #3902ff;
    }


    .frame {
        width: 50%;
        height: 30%;
        margin: auto;
        text-align: center;
    }

    h2 {
        position: relative;
        text-align: center;
        color: #353535;
        font-size: 60px;
        font-family: 'Lato', sans-serif;
        margin: 0;
        color: #a759f5;
    }

    /* Imported font */
    @import url('https://fonts.googleapis.com/css2?family=Anta&display=swap');

    /* Reset styles */
    * {
        margin: 0;
        padding: 0;
        font-family: "Anta", sans-serif;
        font-weight: 400;
        font-style: normal;
    }

    /* Navigation */
    nav {
        background-color: rgba(51, 51, 51, 0.5);
        color: #fff;
        backdrop-filter: blur(10px);
        /* Apply blur effect */
        background-size: cover;
        background-repeat: no-repeat;
        border-bottom: 2px solid #fff;
    }

    nav .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    nav .container h1 img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin-right: 10px;
        display: flex;
    }

    /* Navigation links */
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

    /* Responsive small navigation */
    .small-navbar {
        background-color: #000000;
        color: #fff;
    }

    .small-navbar .container {
        display: flex;
        justify-content: end;
        align-items: center;
    }

    .small-navbar ul li {
        display: inline-block;
    }

    .small-navbar ul li a {
        display: block;
        padding: 10px 20px;
        text-decoration: none;
        color: #fff;
    }

    .small-navbar ul li a:hover {
        background-color: #555;
    }

    /* Container for content */
    .container2 {
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
        background-color: rgba(255, 255, 255, 0.7);
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
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
        content: "\2022";
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

    /* Background image */
    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        /* Minimum height of viewport */
        width: 100%;
        background-image: url("bg.jpg");
        background-position: center;
        background-size: cover;
        overflow-y: auto;
        /* Always show scrollbar */
    }
</style>
<body>
    <div class="logo">
        <img src="og.jpg" alt="Logo">
    </div>

    <input type="checkbox" id="check">
    <label for="check">
        <i class="fas fa-bars" id="btn"></i>
        <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
        <header>Menu</header>
        
        <a href="taskmanager.php">
            <i class="fas fa-qrcode"></i>
            <span>Task manager</span>
        </a>
        <a href="calendar.html">
            <i class="fas fa-calendar"></i>
            <span>Events</span>
        </a>
        <a href="aboutus.php">
            <i class="far fa-question-circle"></i>
            <span>About</span>
        </a>
        <a href="contact.php">
            <i class="far fa-envelope"></i>
            <span>Contact</span>
        </a>
        <a href="user_logout.php" onclick="return confirm('Leaving too soon ? :( ');">
            <i class="fas fa-sliders-h"></i>
            <span>LogOut</span>
        </a>
    </div>

    <section id="about">
        <div class="container2">
            <h1>Contact Us</h1>
            <p>If you have any questions, feedback, or inquiries about our task manager application, please don't hesitate to contact us. We're here to help!</p>
            <p>Email: info@taskmanager.com</p>
            <p>Phone: +91 1234567890</p>
        </div>
    </section>
</body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Anta&display=swap');

    * {
        font-family: "Anta", sans-serif;
        font-weight: 400;
        font-style: normal;
    }

    #about {
        padding: 10%;
        background-color: transparent;

    }


    .container2 {
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
        background-color: rgba(255, 255, 255, 0.7);
        /* Container background color with opacity */
        padding: 40px;
        border-radius: 10px;
        /* Optional: Add rounded corners for better visual appeal */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        /* Optional: Add a subtle shadow for depth */
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
        content: "\2022";
        /* Bullet character */
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
        background:linear-gradient(to bottom right, #000000, #014771);
        background-position: center;
        background-size: cover;
    }

    nav .container h1 img {
        width: 80px;
        /* Adjust width as needed */
        height: 80px;
        /* Adjust height as needed */
        border-radius: 50%;
        /* Make the image round */
        margin-right: 10px;
        /* Add some spacing between the image and text */
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