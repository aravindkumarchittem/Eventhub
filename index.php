<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>College Event Registration</title>
    <link rel="stylesheet" href="styles.css" />
    <script src="script.js" defer></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>

  <body>
    <div class="background-container">
      <iframe
        src="https://my.spline.design/particlenebula-06b22761de6d1115e4497c38f6065f99/"
        frameborder="0"
        width="100%"
        height="100%"
      ></iframe>
    </div>
    <header>
      <nav class="navbar">
        <div class="logo">
          <h1>EventHub</h1>
          <hr class="animated" />
        </div>
        <ul class="nav-links">
          <li><a href="#home">Home</a></li>
          <!-- <li><a href="events.php">Events</a></li> -->
          <!-- <li><a href="cclist.html">Clubs & Chapters</a></li> -->
          <li><a href="#about">About</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="login.php" class="button">Login</a></li>
          <li><a href="registration.php" class="button">Sign Up</a></li>
        </ul>
      </nav>
    </header>

    <main>
      <section id="home" class="hero">
        <div class="hero-content">
          <h2>Welcome to EventHub</h2>
          <div class="line"></div>
          <p>Discover and register for exciting events at our college</p>
          <a href="#events" class="button">Explore Events</a>
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
        <div class="events-grid">
          <!-- Event cards will be populated here by JavaScript -->
        </div>
      </section>

      <section id="contact" class="contact-section">
        <h2>Contact Us</h2>
        <form>
          <input type="text" placeholder="Your Name" required />
          <input type="email" placeholder="Your Email" required />
          <textarea placeholder="Your Message" required></textarea>
          <button type="submit" class="button">Send Message</button>
        </form>
      </section>
    </main>
    <section class="footer">
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
          <a href="#home">Home </a>
          <a href="events.php">Events </a>
          <a href="#about">About </a>
          <a href="cclist.html">Clubs&Chapters </a>
        </ul>
      </div>
    </section>
    <button class="btt" id="backToTop" onclick="topFunction()">
      <i class="fas fa-arrow-up"></i>
    </button>
  </body>
</html>
