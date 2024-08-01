<?php
// Connect to your database - include or require_once your database connection file
require_once "database.php";

// Query to fetch data from registered_events table including event_name, user_email, and registration_time
$sql = "SELECT event_name, user_email, registration_time FROM registered_events";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users List</title>
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
            background-color: #f0f0f0;
            color: #333;
            overflow-x: hidden;
            /* Ensure no horizontal scrollbars appear */
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Users List</h2>
    
    <table>
        <thead>
            <tr>
                <th>Event Name</th>
                <th>User Email</th>
                <th>Registration Time</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through rows of data
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['event_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['user_email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['registration_time']) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
// Close database connection
$conn->close();
?>
