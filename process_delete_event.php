<?php
session_start(); // Start or resume the session

// Ensure this file is accessed via POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) && $_POST['submit'] == 'Delete Event') {
    // Validate event_id
    $event_id = $_POST['event_id'] ?? '';

    if (empty($event_id)) {
        // Handle error - event ID not provided
        echo "<script>alert('Error: Event ID not provided.'); window.location.href = 'index4.php';</script>";
        exit;
    }

    // Connect to database
    require_once "database.php"; // Adjust the path as per your setup

    // Prepare SQL statement to delete event by ID
    $sql_delete = "DELETE FROM event_registrations WHERE id = ?";
    $stmt_delete = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt_delete, $sql_delete)) {
        mysqli_stmt_bind_param($stmt_delete, "i", $event_id);
        mysqli_stmt_execute($stmt_delete);

        // Check if a row was affected
        if (mysqli_stmt_affected_rows($stmt_delete) > 0) {
            // Display success message using JavaScript popup and redirect
            echo "<script>
                    alert('Event deleted successfully.');
                    window.location.href = 'index4.php';
                  </script>";
            exit; // Stop further execution
        } else {
            echo "<script>alert('Error: Event not found or could not be deleted.'); window.location.href = 'index4.php';</script>";
        }
    } else {
        echo "<script>alert('Error: Database error - failed to prepare statement.'); window.location.href = 'index4.php';</script>";
    }

    // Close statement
    mysqli_stmt_close($stmt_delete);
    
    // Fetch events for the logged-in user's club name
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
                echo "<select id='event_id' name='event_id' required>";
                echo "<option value=''>--Select Event--</option>";
                while ($row = mysqli_fetch_assoc($result_select)) {
                    echo "<option value='{$row['id']}'>{$row['event_name']}</option>";
                }
                echo "</select>";
            } else {
                echo "<select id='event_id' name='event_id' required>";
                echo "<option value=''>--No Events Found--</option>";
                echo "</select>";
            }
        } else {
            echo "<script>alert('Error: Database error - failed to prepare statement.'); window.location.href = 'index4.php';</script>";
        }

        // Close statement
        mysqli_stmt_close($stmt_select);
    } else {
        echo "<script>alert('Error: User not logged in.'); window.location.href = 'index4.php';</script>";
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // Handle invalid request method or missing submit button value
    echo "<script>alert('Invalid request.'); window.location.href = 'index4.php';</script>";
}
?>
