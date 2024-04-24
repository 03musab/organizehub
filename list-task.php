<?php
include ('config/constants.php');
//Get the listid from URL
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:index.php');
}
;
$list_id_url = $_GET['list_id'];
?>
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
        width: 240px;
        left: -240px;
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
            z-index: 100; /* Lower z-index value */

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

    p {
        font-family: 'Lato', sans-serif;
        font-weight: 300;
        text-align: center;
        font-size: 30px;
        color: #8000ff;
        margin: 0;
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
        background: linear-gradient(to bottom, #0d0d5c, #00c1c1, #0d0d5c);
        background-position: center;
        background-size: cover;
        overflow-y: auto;
        /* Always show scrollbar */
    }
    .logout-button {
    position: absolute;
    top: 45px; /* Adjust top position as needed */
    left: 1120px; /* Adjust right position as needed */
    padding: 10px 20px;
    background-color: #ffdf00; /* Electric Yellow */
    color: black; /* Example color */
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.logout-button {
    background-color: #ffdf00; /* Electric Yellow */
    /* Add other button styles */
    transition: background-color 0.3s ease; /* Smooth transition effect */

}

/* Hover Effect */
.logout-button:hover {
    background-color: #ffad29; /* Darker shade of Electric Yellow */
}
</style>
</head>
<body>
<div class="container">
    <button class="logout-button" id="logoutBtn">Logout</button>
</div>

<script>
    document.getElementById("logoutBtn").addEventListener("click", function() {
        window.location.href = "user_logout.php";
    });
</script>
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

    <div class="wrapper">


        <!-- Menu Starts Here -->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">

                <a href="taskmanager.php" style="text-decoration: none;"><button class="nav-link active" id="nav-home-tab"
                        data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab"
                        aria-controls="nav-home" aria-selected="true"><b>All Tasks</b></button></a>

                <?php

                //Comment Displaying Lists From Database in ourMenu
                $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

                //SELECT DATABASE
                $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());

                //Query to Get the Lists from database
                $sql2 = "SELECT * FROM tbl_lists";

                //Execute Query
                $res2 = mysqli_query($conn2, $sql2);

                //CHeck whether the query executed or not
                if ($res2 == true) {
                    //Display the lists in menu
                    while ($row2 = mysqli_fetch_assoc($res2)) {
                        $list_id = $row2['list_id'];
                        $list_name = $row2['list_name'];
                        ?>
                        <div class="px-3"></div>


                        <a href="<?php echo SITEURL; ?>list-task.php?list_id=<?php echo $list_id; ?>"
                            style="text-decoration: none;"><button class="nav-link active" id="nav-home-tab"
                                data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab"
                                aria-controls="nav-home" aria-selected="true"><b><?php echo $list_name; ?></b></button></a>

                        <?php

                    }
                }

                ?>
              
        </nav>
        <!-- Menu Ends Here -->
        <div><br></div>
        <a href="<?php echo SITEURL; ?>add-task.php"><button class="btn btn-dark">Add Task</button></a>
        <div><br><div>
        <div class="all-task">



            <table class="table table-hover table-dark">

                <tr>
                    <th>S.N.</th>
                    <th>Task Name</th>
                    <th>Priority</th>
                    <th>Deadline</th>
                    <th>Actions</th>
                </tr>

                <?php

                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

                $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

                //SQL QUERY to display tasks by list selected
                $sql = "SELECT * FROM tbl_tasks WHERE list_id=$list_id_url and user_id = $user_id";

                //Execute Query
                $res = mysqli_query($conn, $sql);

                if ($res == true) {
                    //Display the tasks based on list
                    //Count the Rows
                    $count_rows = mysqli_num_rows($res);
                    $sn = 1;
                    if ($count_rows > 0) {
                        //We have tasks on this list
                        while ($row = mysqli_fetch_assoc($res)) {
                            $task_id = $row['task_id'];
                            $task_name = $row['task_name'];
                            $priority = $row['priority'];
                            $deadline = $row['deadline'];
                            ?>

                            <tr>
                                <td><?php echo $sn++; ?>.</td>
                                <td><?php echo $task_name; ?></td>
                                <td><?php echo $priority; ?></td>
                                <td><?php echo $deadline; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id; ?>"
                                        style="text-decoration:none;">
                                        <div class="btn btn-success btn-sm">Update</div>
                                    </a>

                                    <a href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>"
                                        style="text-decoration:none;">
                                        <div class="btn btn-danger btn-sm">Delete</div>
                                    </a>
                                </td>
                            </tr>

                            <?php
                        }
                    } else {
                        //NO Tasks on this list
                        ?>

                        <tr>
                            <td colspan="5">No Tasks added on this list.</td>
                        </tr>

                        <?php
                    }
                }
                ?>



            </table>

        </div>

    </div>
</body>

</html>