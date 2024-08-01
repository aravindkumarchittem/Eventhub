<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$userEmail = $_SESSION["user"];

// Database credentials
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

if (isset($_POST['upload'])) {
    $target_dir = "uploads/";
    
    // Check if uploads directory exists, if not, create it
    if (!file_exists($target_dir)) {
        if (!mkdir($target_dir, 0777, true)) {
            die("Failed to create directory: " . $target_dir);
        }
    }

    $target_file = $target_dir . basename($_FILES["profile_photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["profile_photo"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["profile_photo"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file)) {
            $stmt = $conn->prepare("UPDATE users SET profile_photo = ? WHERE email = ?");
            $stmt->bind_param("ss", $target_file, $userEmail);
            $stmt->execute();
            $stmt->close();

            header("Location: profile.php");
        } else {
            echo "Sorry, there was an error uploading your file.";
            echo "Error details: " . print_r(error_get_last(), true); // Debugging line to print the last error
        }
    }
}

$conn->close();
?>
