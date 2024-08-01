<?php
// login2.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username and password are set in the POST request
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'login_register');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM club_heads WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['username'] = $user['username'];
            echo "Login successful!";
            // Redirect to a different page
            header("Location: index4.php");
            exit();
        } else {
            echo "Invalid username or password!";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Please provide both username and password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Club Head Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <style>
        /* styles.css */
body {
    background-color: #000000; /* Black background */
    color: #800080; /* Purple text */
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background-color: #1a1a1a; /* Dark background for the container */
    border: 2px solid #8A2BE2; /* Radium purple border */
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Soft shadow for better depth */
    text-align: center;
    width: 350px;
}

h2 {
    color: #8A2BE2; /* Radium purple */
    margin-bottom: 20px;
    font-size: 24px;
}

label {
    display: block;
    margin: 10px 0 5px;
    font-weight: bold;
    font-size: 14px;
}

input[type="text"],
input[type="password"],
input[type="email"] {
    width: calc(100% - 20px); /* Account for padding */
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #8A2BE2; /* Radium purple border */
    border-radius: 5px;
    background-color: #000000; /* Black background for inputs */
    color: #800080; /* Purple text for inputs */
    font-size: 16px;
    box-sizing: border-box;
}

input[type="submit"] {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 5px;
    background-color: #8A2BE2; /* Radium purple background */
    color: #ffffff; /* White text */
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

input[type="submit"]:hover {
    background-color: #7326a4; /* Darker radium purple on hover */
    transform: scale(1.05); /* Slightly enlarge button on hover */
}

input[type="submit"]:active {
    transform: scale(1); /* Reset scale when clicked */
}

    </style>
    <div class="container">
        <h2>Login</h2>
        <form method="POST" action="login2.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Login" >
        </form>
    </div>
</body>
</html>
