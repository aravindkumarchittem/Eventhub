<?php
session_start(); // Start or resume the session

// Other PHP code and HTML follows...
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Basic CSS Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            background-color:	#660094;
            color: #e0e0e0;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        html {
            height: 100%;
        }
       

        .content {
            background-color:	#9614d0;
            border-radius: .25em;
            box-shadow: 0 0 .25em rgba(0, 0, 0, .25);
            box-sizing: border-box;
            left: 50%;
            padding: 10vmin;
            position: fixed;
            text-align: center;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        h1 {
            font-family: monospace;
        }

        @keyframes slide {
            0% {
                transform: translateX(-25%);
            }

            100% {
                transform: translateX(25%);
            }
        }

        header {
            position: fixed;
            margin: 0 5rem;
            top: 3rem;
            width: 90%;
            z-index: 2;
            border-radius: 100px;
            background-color:rgba(0, 0, 0, 0.1);
            box-shadow: 0px 0px 20px black;
        }

        .navbar {
            color: #e0e0e0;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 90%;
            margin: 0 auto;
        }

        .logo h1 {
            font-size: 2rem;
            color: white;
            font-weight: bold;
        }

        .nav-links {
            list-style: none;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: auto;
        }

        .nav-links li {
            margin-left: 2rem;
        }

        .nav-links a {
            color: #e0e0e0;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #8B00FF;
        }

        .nav-links .button {
            padding: 0.5rem 1rem;
            background: #8B00FF;
            border-radius: 5px;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .nav-links .button:hover {
            background: #6A00CC;
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 1rem;
            }

            .nav-links {
                flex-direction: column;
                align-items: center;
                margin-top: 1rem;
            }

            .nav-links li {
                margin: 0.5rem 0;
            }

            .logo h1 {
                font-size: 1.5rem;
            }

            .nav-links .button {
                padding: 0.4rem 0.8rem;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .logo h1 {
                font-size: 1.2rem;
            }

            .nav-links .button {
                padding: 0.3rem 0.7rem;
                font-size: 0.8rem;
            }
        }

        /* New CSS for Event Management Section */
        .flex-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin-top: 100px;
        }

        .container {
           background-color: 	#9614d0;
            padding: 20px;
            border-radius: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0.1, 0.1);
            width: 100%;
            max-width: 500px;
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: whitesmoke;
            font-size: xx-large;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        textarea,
        select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            background-color: #f9f7f78f;
        }

        button {
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            background-color: #dc3545;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #c82333;
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            color: #fff;
        }

        .alert-danger {
            background-color: #dc3545;
        }

        .alert-success {
            background-color: #28a745;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .already-registered {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <!-- <div class="wrapper">
        <div><span class="dot"></span></div>
        <div><span class="dot"></span></div>
        <div><span class="dot"></span></div>
        <div><span class="dot"></span></div>
        <div><span class="dot"></span></div>
        <div><span class="dot"></span></div>
        <div><span class="dot"></span></div>
        <div><span class="dot"></span></div>
        <div><span class="dot"></span></div>
        <div><span class="dot"></span></div>
        <div><span class="dot"></span></div>
        <div><span class="dot"></span></div>
        <div><span class="dot"></span></div>
        <div><span class="dot"></span></div>
        <div><span class="dot"></span></div>
    </div> -->
    <header>
        <nav class="navbar">
            <div class="logo">
                <h1>EventHub</h1>
                <hr class="animated" />
            </div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="events2.php">Events</a></li>
                <li><a href="profile2.php">Profile</a></li>
            </ul>
        </nav>
    </header>
    <div class="flex-container">
        <div class="container">
            <h2>Add Event</h2>
            <form action="insert_event.php" method="post">
                <label for="event_name">Event Name:</label>
                <input type="text" id="event_name" name="event_name" required>

                <label for="event_description">Event Description:</label>
                <textarea id="event_description" name="event_description" rows="4" required></textarea>

                <label for="venue">Venue:</label>
                <input type="text" id="venue" name="venue" required>

                <label for="event_date">Event Date:</label>
                <input type="date" id="event_date" name="event_date" required>

                <label for="event_time">Event Time:</label>
                <input type="time" id="event_time" name="event_time" required>


                <label for="club_name">Club Name:</label>
                <input type="text" id="club_name" name="club_name" value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>" readonly>

                <button type="submit" name="submit">Add Event</button>
            </form>
        </div>
        <div class="container">
            <h2>Delete Event</h2>
            <form action="process_delete_event.php" method="post">
                <label for="event_id">Select Event to Delete:</label>
                <select id="event_id" name="event_id" required>
                    <option value="">--Select Event--</option>
                    <?php
                    require_once "database.php";

                    // Fetch events for the logged-in user's club name
                    session_start();
                    $logged_in_username = $_SESSION['username'] ?? '';
                    if (!empty($logged_in_username)) {
                        $sql_select = "SELECT id, event_name FROM event_registrations WHERE club_name = ?";
                        $stmt_select = mysqli_stmt_init($conn);

                        if (mysqli_stmt_prepare($stmt_select, $sql_select)) {
                            mysqli_stmt_bind_param($stmt_select, "s", $logged_in_username);
                            mysqli_stmt_execute($stmt_select);
                            $result_select = mysqli_stmt_get_result($stmt_select);

                            // Check if events were found
                            if (mysqli_num_rows($result_select) > 0) {
                                while ($row = mysqli_fetch_assoc($result_select)) {
                                    echo "<option value='{$row['id']}'>{$row['event_name']}</option>";
                                }
                            } else {
                                echo "<option value=''>--No Events Found--</option>";
                            }
                        } else {
                            echo "<script>alert('Error: Database error - failed to prepare statement.'); window.location.href = 'index4.php';</script>";
                        }

                        // Close statement
                        mysqli_stmt_close($stmt_select);
                    } else {
                        echo "<script>alert('Error: User not logged in.'); window.location.href = 'login2.php';</script>";
                    }

                    // Close database connection
                    mysqli_close($conn);
                    ?>
                </select>
                <button type="submit" name="submit" value="Delete Event">Delete Event</button>
            </form>
        </div>

</body>

</html>