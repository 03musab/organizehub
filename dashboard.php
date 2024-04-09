<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organize hub</title>
    <link rel="stylesheet" href="dashboard.css">

</head>

<body>
    <nav>
        <div class="container">
            <h1><img src="12.jpg" alt="Logo"></h1>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="aboutus.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="calendar.html">Calendar</a></li>
                <li><a href="logout.php">Logout</a></li>

            </ul>
        </div>
    </nav>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS -->
        <link rel="stylesheet" href="dashboard.css">

        <!--- Tailwind CSS & Daisy UI CSS -->
        <link href="https://cdn.jsdelivr.net/npm/daisyui@2.18.0/dist/full.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>


        <title>Orgaizehub</title>
    </head>
    <body2>


        <!-- Copyright -->



        <div class="containertsk">
            <header>
                <h1>Todo List</h1>
                <!-- Error message -->
                <div class="input-section">
                    <input type="text" placeholder="Add a todo . . ." class="input input-bordered input-secondary w-full max-w-xs" />
                    <input type="date" placeholder="Due date?" class="input input-bordered input-secondary w-full max-w-xs schedule-date" />
                    <select id="priorityDropdown" class="input input-bordered input-secondary  w-full max-w-xs">
                        <option value="N/A">No priority</option>
                        <option value="1">Low</option>
                        <option value="2">Medium</option>
                        <option value="3">High</option>
                    </select>
                    <button id="btnaddtsk" class="btn btn-primary add-task-button">
                        <i class="bx bx-plus bx-sm"></i>
                    </button>
                </div>
                <div>
                    <p>
                        <br>
                    </p>
                </div>
                <div class="alert-message"></div>

            </header>

            <div class="todos-filter">
                <div class="dropdown">
                    <label tabindex="0" class="btn m-1">Filter</label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                        <li onclick="filterTodos('all')"><a>All</a></li>
                        <li onclick="filterTodos('pending')"><a>Pending</a></li>
                        <li onclick="filterTodos('completed')"><a>Completed</a></li>
                    </ul>

                </div>

                <button class="btn btn-primary delete-all-btn">
                    Delete All
                </button>
            </div>
            <div style="min-height:250px;max-height: 250px; min-width:600px; max-width:600 ;overflow-y:scroll;">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="todos-list-body">
                    </tbody>
                </table>
            </div>
        </div>



        <!--Theme switcher-->
        <div class="theme-switcher">
            <div class="dropdown dropdown-left">
                <label tabindex="0" class="btn m-1 border border-white">
                    <i class='bx bxs-palette bx-sm '></i>
                </label>
                <ul tabindex="0" class="dropdown-content menu p-1 shadow bg-base-100 rounded-box border border-gray-300 w-56">
                    <li class="theme-item" theme="dark"><a>dark</a></li>
                    <li class="theme-item" theme="light"><a>light</a></li>
                    <li class="theme-item" theme="bumblebee"><a>bumblebee</a></li>
                    <li class="theme-item" theme="halloween"><a>halloween</a></li>
                    <li class="theme-item" theme="fantasy"><a>fantasy</a></li>
                    <li class="theme-item" theme="aqua"><a>aqua</a></li>
                    <li class="theme-item" theme="luxury"><a>luxury</a></li>
                    <li class="theme-item" theme="night"><a>night</a></li>
                </ul>
            </div>
        </div>

        <style>
            /* CSS styling for the sticky note */
            .sticky-note {

                position: fixed;
                bottom: 45px;
                right: 20px;
                width: 250px;
                padding: 10px;
                background: rgba(255, 255, 255, 0.15);
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.3);
                backdrop-filter: blur(3px);
                -webkit-backdrop-filter: blur(3px);
                border-radius: 10px solid;
                border: 2px solid rgba(255, 255, 255, 0.18) rounded-box;
                box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
                margin: 20px auto;
                cursor: pointer;
                transition: transform 0.3s ease-in-out;
            }

            .sticky-note:hover {
                transform: translateY(-5px);
            }

            .sticky-note textarea {
                width: 100%;
                height: 100%;
                border-radius: 15px;
                padding: 10px;
                border: 1px black;
                resize: none;
                color: black;
            }

            .sticky-note button {
                margin-top: 10px;
                padding: 5px 10px;
                border: none;
                border-radius: 3px;
                background-color: #007bff;
                color: #fff;
                cursor: pointer;
                transition: background-color 0.3s ease-in-out;
            }

            /* Green hover for Save button */
            .sticky-note button:nth-child(1):hover {
                background-color: green;
            }

            /* Red hover for Delete button */
            .sticky-note button:nth-child(2):hover {
                background-color: red;
            }


            .sticky-note button.delete {
                background-color: #dc3545;
            }

            .sticky-note button.delete:hover {
                background-color: #c82333;
            }
        </style>
        </head>
        </div>

        <body>
            <div class="sticky-note">
                <textarea id="noteContent" placeholder="Type your note here..."></textarea>
                <div>
                    <button onclick="saveNote()">Save</button>
                    <button onclick="deleteNote()">Delete</button>
                </div>
            </div>
            <script>
                // JavaScript functionality for saving and deleting notes
                function saveNote() {
                    const noteContent = document.getElementById("noteContent").value.trim();
                    if (noteContent !== "") {
                        localStorage.setItem("stickyNote", noteContent);
                        alert("Note saved successfully!");
                    } else {
                        alert("Note content is empty!");
                    }
                }

                function deleteNote() {
                    const noteContent = document.getElementById("noteContent").value.trim();
                    if (noteContent === "") {
                        alert("Note is already empty!");
                    } else {
                        localStorage.removeItem("stickyNote");
                        document.getElementById("noteContent").value = "";
                        alert("Note deleted successfully!");
                    }
                }


                // Load saved note from localStorage when the page loads
                window.addEventListener("DOMContentLoaded", function() {
                    const savedNote = localStorage.getItem("stickyNote");
                    if (savedNote) {
                        document.getElementById("noteContent").value = savedNote;
                    }
                });
            </script>
            <script src="dashboard.js"></script>
    </body2>

</html>