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

// Ensure the user is logged in and has a club name associated
$logged_in_username = $_SESSION['username'] ?? '';
if (empty($logged_in_username)) {
    echo "<script>alert('Error: User not logged in.'); window.location.href = 'index4.php';</script>";
    exit;
}

// SQL query to fetch event data for the user's club
$sql = "SELECT * FROM event_registrations WHERE club_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $logged_in_username);
$stmt->execute();
$result = $stmt->get_result();

// Collect event data
$events = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

// Close the database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration</title>
    <link rel="stylesheet" href="eventstyle.css">
    <script src="event.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="container">
    <header>
        <nav class="navbar">
            <div class="logo">
                <h1>EventHub</h1>
                <hr class="animated" />
            </div>
            <ul class="nav-links">
                <li><a href="index4.php">Home</a></li>
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

<input type="text" id="searchInput" placeholder="Search events..." style="color: white;">

            <div class="slides-container">
                <?php
                if (!empty($events)) {
                    foreach ($events as $row) {
                        $event_name = htmlspecialchars($row['event_name']);
                        ?>
                        <div class="event-card">
                            <h3 class="event-title"><?php echo $event_name; ?></h3>
                            <p class="event-description"><?php echo htmlspecialchars($row['event_description']); ?></p>
                            <div class="venue-time">
                                <p class="event-venue">Venue: <?php echo htmlspecialchars($row['venue']); ?></p>
                                <p class="event-time">Time: <?php echo htmlspecialchars($row['event_time']); ?></p>
                            </div>
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
