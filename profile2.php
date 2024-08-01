<?php
  session_start();

  // Check if user is logged in
  if (!isset($_SESSION['username'])) {
    header("Location: login2.php");
    exit;
  }

  $username = $_SESSION['username'];
  $conn = new mysqli('localhost', 'root', '', 'login_register');
  // Connect to database (replace with your connection details)
  // ... (code to connect to database)

  // Fetch user information from database based on username
  $sql = "SELECT * FROM club_heads WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  // Close database connection (if not done within the connection code)
  // ... (code to close database connection)
?>

<!DOCTYPE html>
<html>
<head>
  <title>Profile - <?php echo $username; ?></title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <style>
        /* Overall styling */
body {
  background-color: black;
  font-family: sans-serif; /* Choose a suitable font family */
  margin: 0; /* Remove default margin */
  padding: 20px; /* Add some padding for aesthetics */
}

/* Header styling */
h1 {
  color: purple;
  text-align: center;
  font-size: 2em; /* Adjust font size as needed */
  margin-bottom: 20px; /* Add some space after the heading */
}

/* User information styling */
p {
  color: purple;
  margin-bottom: 10px; /* Add some space between paragraphs */
}

/* Logout button styling */
form {
  text-align: center;
}

input[type="submit"] {
  background-color: transparent; /* Remove default button background */
  color: purple;
  border: 2px solid #ba55c9; /* Radium purple border */
  border-radius: 5px; /* Add rounded corners */
  padding: 10px 20px; /* Adjust padding for button size */
  cursor: pointer; /* Indicate clickable behavior */
}

input[type="submit"]:hover { /* Button hover effect */
  background-color: #ba55c9; /* Subtle background change */
  color: white;
}

    </style>
  <h1>Welcome, <?php echo $username; ?>!</h1>

  <?php
    // Display user information based on what's stored in the database
    if ($user) {
      echo "<p>Email: " . $user['email'] . "</p>"; // Assuming email is stored
      // Add more information as needed based on your database schema
    } else {
      echo "<p>An error occurred while fetching user information.</p>";
    }
  ?>

  <form action="login2.php" method="POST">
    <input type="submit" value="Logout">
  </form>
</body>
</html>
