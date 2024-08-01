<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$userEmail = $_SESSION["user"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["event_id"])) {
    $eventId = $_POST["event_id"];

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

    // Check if the user has already registered for the event
    $checkStmt = $conn->prepare("SELECT * FROM registered_events WHERE user_email = ? AND event_id = ?");
    $checkStmt->bind_param("si", $userEmail, $eventId);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        header("Location: events.php?status=already_registered");
    } else {
        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO registered_events (user_email, event_id) VALUES (?, ?)");
        $stmt->bind_param("si", $userEmail, $eventId);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: events.php?status=success");
        } else {
            header("Location: events.php?status=error");
        }

        // Close statement
        $stmt->close();
    }

    // Close check statement and connection
    $checkStmt->close();
    $conn->close();
}
?>
