<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$userEmail = $_SESSION["user"];

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

// Fetch profile photo URL
$sqlProfile = "SELECT profile_photo FROM users WHERE email = ?";
$stmtProfile = $conn->prepare($sqlProfile);
$stmtProfile->bind_param("s", $userEmail);
$stmtProfile->execute();
$resultProfile = $stmtProfile->get_result();
$profilePhoto = $resultProfile->fetch_assoc()['profile_photo'];

// SQL query to fetch registered events for the current user, ordered by date and time
$sql = "SELECT r.id, e.event_name, e.event_description, e.venue, e.event_date, e.event_time 
        FROM registered_events r
        JOIN event_registrations e ON r.event_id = e.id
        WHERE r.user_email = ?
        ORDER BY e.event_date, e.event_time";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>College Event Registration</title>
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .swiper-container {
            width: 100%;
            padding-top: 25px;
            padding-bottom: 25px;
        }

        .swiper-slide {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: flex;
            justify-content: center;
            padding: 1px;
            margin: 0;
        }

        .swiper-slide-active {
            transform: scale(1.05);
        }

        .event-card {
            text-align: center;
        }

        .event-title {
            font-size: 1.8em;
            margin-bottom: 15px;
            color: #333;
        }

        .event-description {
            font-size: 1.2em;
            margin-bottom: 20px;
            color: #666;
        }

        .venue-time {
            font-size: 1em;
            color: #999;
        }

        .background-container iframe {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5em 2em;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            height: 60px;
        }

        .logo h1 {
            margin: 0;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 1em;
        }

        .nav-links li a {
            color: #fff;
            text-decoration: none;
        }

        .nav-links li img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
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

        .hero-content {
            text-align: center;
            padding: 3em 1em;
            color: #fff;
        }

        .hero-content .button {
            background: #8b00ff;
            color: #e0e0e0;
            padding: 0.5em 1.5em;
            text-decoration: none;
            border-radius: 5px;
        }

        .about-section,
        .events-section,
        .contact-section {
            padding: 3em 1em;
            color: #333;
        }

        .footer {
            background: rgba(30, 30, 30, 0.8);
            color: #fff;
            padding: 2em 1em;
            text-align: center;
        }

        .footer ul {
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 1em;
        }

        .footer ul a {
            color: #fff;
            text-decoration: none;
        }

        .footer .icon {
            font-size: 1.5em;
        }

        .btt {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #ff6600;
            color: #fff;
            border: none;
            border-radius: 50%;
            padding: 0.5em;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="background-container">
        <iframe src="https://my.spline.design/particlenebula-06b22761de6d1115e4497c38f6065f99/" frameborder="0" width="100%" height="100%"></iframe>
    </div>
    <header>
        <nav class="navbar">
            <div class="logo">
                <h1>EventHub</h1>
            </div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="cclist.html">Clubs & Chapters</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="registered_events.php">Registered Events</a></li>
                <li><a href="profile.php"><img src="<?php echo htmlspecialchars($profilePhoto); ?>" alt="Profile Photo"></a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="home" class="hero">
            <div class="hero-content">
                <h2>Welcome to EventHub</h2>
                <p>Discover and register for exciting events at our college</p>
                <a href="events.php" class="button">Explore Events</a>
            </div>
        </section>
        <section id="about" class="about-section">
            <div class="about-content">
                <div class="about-text">
                    <h2>About Us</h2>
                    <p>
                        EventHub is a platform for college students to discover and
                        register for various events organized by clubs and chapters within
                        the college.
                    </p>
                </div>
                <div class="about-image">
                    <img src="VIT-ALL-EVENTS.jpg" alt="About Us Image" />
                </div>
            </div>
        </section>

        <section id="events" class="events-section">
            <h2>Upcoming Events</h2>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <div class="swiper-slide">
                                <div class="event-card">
                                    <h3 class="event-title"><?php echo htmlspecialchars($row['event_name']); ?></h3>
                                    <p class="event-description"><?php echo htmlspecialchars($row['event_description']); ?></p>
                                    <div class="venue-time">
                                        <p class="event-venue">Venue: <?php echo htmlspecialchars($row['venue']); ?></p>
                                        <p class="event-date">Date: <?php echo htmlspecialchars($row['event_date']); ?></p>
                                        <p class="event-time">Time: <?php echo htmlspecialchars($row['event_time']); ?></p>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p>No events registered.</p>";
                    }

                    $stmt->close();
                    $conn->close();
                    ?>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>

        <section id="contact" class="contact-section">
            <h2>Contact Us</h2>
            <form action="submit_contact.php" method="POST">
                <input type="text" name="name" placeholder="Your Name" required />
                <input type="email" name="email" placeholder="Your Email" required />
                <textarea name="message" placeholder="Your Message" required></textarea>
                <button type="submit" class="button">Send Message</button>
            </form>
        </section>
    </main>
    <section class="footer">
        <ul>
            <li class="item">
                <a href="#"><i class="fa-brands fa-instagram icon"></i></a>
            </li>
            <li class="item">
                <a href="#"><i class="fa-brands fa-linkedin icon"></i></a>
            </li>
            <li class="item">
                <a href="#"><i class="fa-brands fa-youtube icon"></i></a>
            </li>
            <li class="item">
                <a href="#"><i class="fa-brands fa-x-twitter icon"></i></a>
            </li>
            <li class="item">
                <a href="#"><i class="fa-brands fa-facebook icon"></i></a>
            </li>
            <li class="item">
                <a href="#"><i class="fa-brands fa-github icon"></i></a>
            </li>
        </ul>
        <div class="name">
            <ul>
                <a href="#home">Home</a>
                <a href="events.php">Events</a>
                <a href="#about">About</a>
                <a href="cclist.html">Clubs & Chapters</a>
            </ul>
        </div>
    </section>
    <button class="btt" id="backToTop" onclick="topFunction()">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 3,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            centeredSlides: false,
        });

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
</body>

</html>