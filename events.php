<?php
session_start(); // Start session if not already started

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_register";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch event data
$sql = "SELECT * FROM event_registrations"; // Assuming events are stored in an 'event_registrations' table
$result = $conn->query($sql);

// Collect event data
$events = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration</title>
    <link rel="stylesheet" href="eventstyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
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
            background-color: #121212;
            color: #e0e0e0;
            overflow-x: hidden;
            /* Ensure no horizontal scrollbars appear */
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            width: 100%;
            height: 100%;
            background: radial-gradient(circle farthest-side at 0% 50%,
                    #282828 23.5%,
                    rgba(255, 170, 0, 0) 0) 21px 30px,
                radial-gradient(circle farthest-side at 0% 50%,
                    #2c3539 24%,
                    rgba(240, 166, 17, 0) 0) 19px 30px,
                linear-gradient(#282828 14%,
                    rgba(240, 166, 17, 0) 0,
                    rgba(240, 166, 17, 0) 85%,
                    #282828 0) 0 0,
                linear-gradient(150deg,
                    #282828 24%,
                    #2c3539 0,
                    #2c3539 26%,
                    rgba(240, 166, 17, 0) 0,
                    rgba(240, 166, 17, 0) 74%,
                    #2c3539 0,
                    #2c3539 76%,
                    #282828 0) 0 0,
                linear-gradient(30deg,
                    #282828 24%,
                    #2c3539 0,
                    #2c3539 26%,
                    rgba(240, 166, 17, 0) 0,
                    rgba(240, 166, 17, 0) 74%,
                    #2c3539 0,
                    #2c3539 76%,
                    #282828 0) 0 0,
                linear-gradient(90deg, #2c3539 2%, #282828 0, #282828 98%, #2c3539 0%) 0 0 #282828;
            background-size: 40px 60px;
        }


        header {
            position: sticky;
            margin: 0 5rem;
            top: 3rem;
            width: 90%;
            z-index: 2;
            border-radius: 100px;
            background-color: black;
            box-shadow: 0px 0px 50px #8B00FF;
        }

        .navbar {
            color: #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 90%;
            margin: 0 auto;
        }


        .logo h1 {
            font-size: 2rem;
            color: #8B00FF;
            /* Space Purple */
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
            /* Space Purple */
        }

        .nav-links .button {
            padding: 0.5rem 1rem;
            background: #8B00FF;
            /* Space Purple */
            border-radius: 5px;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .nav-links .button:hover {
            background: #6A00CC;
            /* Darker shade of Space Purple */
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 1rem;
                /* Adjust padding for better spacing */
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
                /* Adjust font size */
            }

            .nav-links .button {
                padding: 0.4rem 0.8rem;
                /* Adjust button padding */
                font-size: 0.9rem;
                /* Adjust button font size */
            }
        }

        @media (max-width: 480px) {
            .logo h1 {
                font-size: 1.2rem;
                /* Further adjust font size */
            }

            .nav-links .button {
                padding: 0.3rem 0.7rem;
                /* Adjust button padding */
                font-size: 0.8rem;
                /* Adjust button font size */
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                flex-direction: column;
                align-items: center;
                background: rgba(0, 0, 0, 0.9);
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
                height: 100vh;
                display: none;
                padding: 1em 0;
                gap: 1.5em;
            }

            .navbar.active .nav-links {
                display: flex;
            }

            .burger {
                display: block;
                cursor: pointer;
            }

            .burger div {
                width: 25px;
                height: 3px;
                background: #fff;
                margin: 5px;
                transition: all 0.3s ease;
            }
        }

        @media (max-width: 480px) {
            .nav-links li img {
                width: 40px;
                height: 40px;
            }
        }

        hr.animated {
            width: 137px;
            animation: animate .5s ease-in-out;
        }

        @keyframes animate {
            0% {
                transform: scaleX(0);
            }

            100% {
                transform: scaleX(1);
            }
        }


        /* Slide Navigation */
        .slide-nav {
            display: flex;
            justify-content: center;
            margin-top: 5rem;
        }

        .slide-nav-button {
            padding: 0.5rem;
            margin: 0 0.5rem;
            background: #8B00FF;
            /* Space Purple */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .slide-nav-button:hover {
            background: #6A00CC;
            /* Darker shade of Space Purple */
            transform: scale(1.05);
        }

        .slide-nav-button.active {
            background: #6A00CC;
            /* Darker shade of Space Purple */
        }

        /* Filter Section */
        .filter-section {
            display: flex;
            justify-content: center;
            margin: 5rem 0;
        }

        .filter-button {
            padding: 0.5rem 1rem;
            margin: 0 0.5rem;
            background: #8B00FF;
            /* Space Purple */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .filter-button:hover {
            background: #6A00CC;
            /* Darker shade of Space Purple */
            transform: scale(1.05);
        }

        #searchInput {
            margin: 0 14rem;
            padding: 0.5rem;
            border: none;
            width: 70%;
            border-radius: 100px;
            background-color: #4a2d4a;
            color: white;
            fontsize: x-large;
        }

        #searchInput::placeholder {
            color: #fff;
        }

        #searchInput:focus {
            outline: none;
            box-shadow: 0px 0px 5px #8B00FF;
            background: rgba(35, 35, 35, 0.9);
            /* Darker semi-transparent background on focus */
        }

        /* Event Cards and Slides */
        .slides-container {
            display: grid;
            gap: 3rem;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));

            justify-content: center;
            margin-top: 15px;
            /* Ensure content starts below fixed navbar */
        }

        .slide {
            display: none;
            align-items: center;
            padding: 2rem;
            width: 60%;
            max-width: 800px;
        }

        .slide.active {
            display: flex;
        }

        .event-card {
            width: 450px;
            background: rgba(6, 6, 6, 0.8);
            /* Transparent background */
            padding: 2rem;
            border-radius: 25% 5px/ 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .event-card:hover {

            box-shadow: 10px 10px 5px #8B00FF;
        }

        .event-card h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: #e0e0e0;
        }

        .event-card p {
            color: #b0b0b0;
            margin-bottom: 0.5rem;
        }

        .event-card .venue-time {
            display: flex;
            justify-content: space-between;
        }

        .event-card .button {
            padding: 0.5rem 1rem;
            background: #8B00FF;
            /* Space Purple */
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            display: inline-block;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .event-card .button:hover {
            background: #6A00CC;
            /* Darker shade of Space Purple */
            transform: scale(1.05);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
            }

            .nav-links {
                flex-direction: column;
                margin-top: 1rem;
            }

            .nav-links li {
                margin: 0.5rem 0;
            }

            .filter-section {
                flex-wrap: wrap;
                justify-content: center;
            }

            .filter-button {
                margin: 0.5rem;
            }

            #searchInput {
                width: 80%;
                max-width: none;
            }

            .slide {
                flex-direction: column;
                align-items: center;
                width: 80%;
            }

            .event-card {
                width: 100%;
            }

            .event-card .venue-time {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 480px) {
            .logo h1 {
                font-size: 1.5rem;
            }

            .filter-button {
                padding: 0.3rem 0.7rem;
                font-size: 0.8rem;
            }

            #searchInput {
                width: 90%;
                padding: 0.3rem 0.5rem;
            }

            .slide {
                width: 90%;
            }

            .event-card .venue-time {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        .footer {
            background: rgba(30, 30, 30, 0.8);
            /* Transparent background */
            text-align: center;
            padding: 2rem 0;
            border-radius: 10px;
            margin-top: ;

        }

        .footer ul {
            justify-content: center;
            margin: 0 33.5rem;
            display: flex;
            list-style: none;
            gap: 2rem;
            margin-top: 1rem;

        }

        .item a {
            text-decoration: none;
            width: 3rem;
            height: 3rem;
            background-color: #252627;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 1;
            border: 3px solid #141414;
            overflow: hidden;
        }

        .item a::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background: var(--bg-color);
            z-index: 0;
            scale: 1 0;
            transform-origin: bottom;
            transition: scale 0.5s ease;
        }

        .item:hover a::before {
            scale: 1 1;
        }

        .icon {
            font-size: 1.5rem;
            color: hsl(321, 89%, 42%);
            transition: 0.5s ease;
            z-index: 2;
        }

        .item a:hover .icon {
            color: #fff;
            transform: rotateY(360deg);
        }

        .item:nth-child(1) {
            --bg-color: linear-gradient(to bottom right, #f9ce34, #ee2a7b, #6228d7);
        }

        .item:nth-child(2) {
            --bg-color: #0077b5;
        }

        .item:nth-child(3) {
            --bg-color: #ff0000;
        }

        .item:nth-child(4) {
            --bg-color: #000;
        }

        .item:nth-child(5) {
            --bg-color: blue;
        }

        .item:nth-child(6) {
            --bg-color: #000;
        }

        .name {
            margin-top: 1rem;
        }

        .name ul {
            justify-content: center;
        }

        .name a {
            text-decoration: none;
            color: #00c3ff;

        }

        @media (max-width: 768px) {
            .footer ul {
                flex-wrap: wrap;
            }

            .footer ul .item {
                flex: 1 0 50%;
                /* Two items per row on smaller screens */
            }
        }

        @media (max-width: 480px) {
            .footer ul .item {
                flex: 1 0 100%;
                /* One item per row on even smaller screens */
                margin-bottom: 1rem;
                /* Add margin between items */
            }

            .footer ul {
                justify-content: center;
                /* Center items on smaller screens */
            }
        }

        .btt {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            border: none;
            outline: none;
            background-color: #8B00FF;
            color: black;
            cursor: pointer;
            padding: 15px;
            border-radius: 10px;

        }

        .btt:hover {
            background-color: #b474e9;
        }
    </style>
    <script>
        function showAlert(message) {
            alert(message);
        }

        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');

            if (status === 'success') {
                showAlert('Event registered successfully.');
            } else if (status === 'already_registered') {
                showAlert('You have already registered for this event.');
            } else if (status === 'error') {
                showAlert('Error registering event.');
            }
        };
    </script>
</head>

<body class="container">
    <header>
        <nav class="navbar">
            <div class="logo">
                <h1>EventHub</h1>
                <hr class="animated" />
            </div>
            <ul class="nav-links">
                <li><a href="index2.php ">Home</a></li>
                <li><a href="cclist.html">Clubs&Chapters</a></li>
                <li><a href="registered_events.php">Registered Events</a></li>
                <li><a href="profile.php">Profile</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="events" class="events-section">
            <div class="filter-section">
                <button class="filter-button" data-filter="all">All</button>
                <button class="filter-button" data-filter="workshop">Workshops</button>
                <button class="filter-button" data-filter="conference">Conferences</button>
                <button class="filter-button" data-filter="seminar">Seminars</button>
            </div>
            <div>
                <input type="text" id="searchInput" placeholder="Search events...">

            </div>

            <div class="slides-container">
                <?php
                if (!empty($events)) {
                    foreach ($events as $row) {
                        $event_id = htmlspecialchars($row['id']);
                        $event_name = htmlspecialchars($row['event_name']);
                ?>
                        <div class="event-card">
                            <h3 class="event-title"><?php echo htmlspecialchars($event_name); ?></h3>
                            <p class="event-description"><?php echo htmlspecialchars($row['event_description']); ?></p>
                            <div class="venue-time">
                                <p class="event-venue">Venue: <?php echo htmlspecialchars($row['venue']); ?></p>
                                <p class="event-date">Date: <?php echo htmlspecialchars($row['event_date']); ?></p>
                                <p class="event-time">Time: <?php echo htmlspecialchars($row['event_time']); ?></p>
                            </div>
                            <form action="register_event.php" method="POST">
                                <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                                <button type="submit" class="button">Register</button>
                            </form>
                        </div>

                <?php
                    }
                } else {
                    echo "<p>No events found.</p>";
                }
                ?>
            </div>
        </section>
    </main>

    <!-- <section class="footer">
        <ul>
            <li class="item">
                <a href="#">
                    <i class="fa-brands fa-instagram icon"></i>
                </a>
            </li>
            <li class="item">
                <a href="#">
                    <i class="fa-brands fa-linkedin icon"></i>
                </a>
            </li>
            <li class="item">
                <a href="#">
                    <i class="fa-brands fa-youtube icon"></i>
                </a>
            </li>
            <li class="item">
                <a href="#">
                    <i class="fa-brands fa-x-twitter icon"></i>
                </a>
            </li>
            <li class="item">
                <a href="#">
                    <i class="fa-brands fa-facebook icon"></i>
                </a>
            </li>
            <li class="item">
                <a href="#">
                    <i class="fa-brands fa-github icon"></i>
                </a>
            </li>
        </ul>
        <div class="name">
            <ul>
                <a href="index.html">Home</a>
                <a href="event.html">Events</a>
                <a href="cclist.html">Clubs&Chapters</a>
            </ul>
        </div>
    </section> -->
    <button class="btt" id="backToTop" onclick="topFunction()"><i class="fas fa-arrow-up"></i></button>

    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let eventCards = document.querySelectorAll('.event-card');

            eventCards.forEach(function(card) {
                let title = card.querySelector('.event-title').textContent.toLowerCase();
                let description = card.querySelector('.event-description').textContent.toLowerCase();
                let venue = card.querySelector('.event-venue').textContent.toLowerCase();
                let time = card.querySelector('.event-time').textContent.toLowerCase();

                if (title.includes(filter) || description.includes(filter) || venue.includes(filter) || time.includes(filter)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>