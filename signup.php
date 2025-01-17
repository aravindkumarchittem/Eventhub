<?php
// signup.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'login_register');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO club_heads (username, password, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $username, $password, $email);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Club Head Signup</title>
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
        <h2>Signup</h2>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <input type="submit" value="Signup">
        </form>
    </div>
</body>
</html>
