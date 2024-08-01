<?php
session_start(); // Start the session to access session variables

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Retrieve form data
    $eventName = $_POST["event_name"] ?? '';
    $eventDescription = $_POST["event_description"] ?? '';
    $venue = $_POST["venue"] ?? '';
    $eventDate = $_POST["event_date"] ?? '';
    $eventTime = $_POST["event_time"] ?? '';

    // Retrieve club name from session (assuming it's stored there during login)
    if (isset($_SESSION['username'])) {
        $clubName = $_SESSION['username']; // Set club_name to logged-in user's username
    } else {
        $clubName = ''; // Handle case where username isn't set
    }

    // Validate inputs (you can add more validation as needed)
    $errors = [];
    if (empty($eventName) || empty($eventDescription) || empty($venue) || empty($eventDate) || empty($eventTime)) {
        $errors[] = "All fields are required";
    }

    // If no errors, proceed with inserting into database
    if (empty($errors)) {
        require_once "database.php"; // Include your database connection script

        // Prepare and execute SQL statement to insert into event_registrations table
        $sql = "INSERT INTO event_registrations (event_name, event_description, venue, event_date, event_time, club_name) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssss", $eventName, $eventDescription, $venue, $eventDate, $eventTime, $clubName);
            if (mysqli_stmt_execute($stmt)) {
                // Display success message using JavaScript popup and redirect
                echo "<script>
                        alert('Event added successfully!');
                        window.location.href = 'index4.php';
                      </script>";
                exit; // Stop further execution to prevent error messages from appearing
            } else {
                echo "<p>Error: " . mysqli_error($conn) . "</p>";
            }
        } else {
            echo "<p>Database error: failed to prepare statement</p>";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
    }
}
?>
