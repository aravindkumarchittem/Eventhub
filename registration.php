<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        .success-message {
            color: green;
            font-weight: bold;
        }
    </style>
      <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #1f1c2c 0%, #8B00FF 100%);
            /* Space Purple and Black Gradient */
            color: #e0e0e0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.1);
            /* Transparent white */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 800px;
            /* Increased width for the two-column layout */
            text-align: center;
            backdrop-filter: blur(10px);
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            margin-bottom: 20px;
            color: #fff;
            animation: slideInDown 1s ease;
        }

        @keyframes slideInDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        form {
            display: flex;
            flex-wrap: wrap;
            /* Allow wrapping of columns */
            justify-content: center;
            position: relative;
            animation: fadeIn 1s ease;
        }

        .form-column {
            flex: 1 1 45%;
            /* Each column takes 45% of the width */
            padding: 0 20px;
            /* Add some padding for spacing */
            max-width: 45%;
        }

        .divider {
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 34%;
            width: 2px;
            background-color: #fff;
            animation: grow 1s ease-out 0.5s forwards;
            opacity: 0;
        }

        @keyframes grow {
            from {
                height: 0;
                opacity: 0;
            }

            to {
                height: 65%;
                opacity: 1;
            }
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #fff;
            text-align: left;
            /* Align labels to the left */
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #6A00CC;
            /* Darker shade of Space Purple */
            border-radius: 4px;
            font-size: 14px;
            background-color: rgba(255, 255, 255, 0.3);
            /* Semi-transparent white */
            color: #fff;
            width: 100%;
            /* Full width of the column */
            opacity: 0;
            animation: fadeIn 1s ease forwards;
        }

        input[type="text"]::placeholder,
        input[type="email"]::placeholder,
        input[type="tel"]::placeholder,
        input[type="password"]::placeholder {
            color: #e0e0e0;
        }

        .form-center {
            flex-basis: 100%;
            /* Center section takes full width */
            text-align: center;
            margin: 20px 0;
            /* Add margin for spacing */
            width: 100%;
        }

        button {
            padding: 15px 30px;
            /* Extended button size */
            background-color: #8B00FF;
            /* Space Purple */
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button:hover {
            background-color: #6A00CC;
            /* Darker shade of Space Purple */
            transform: scale(1.05);
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            color: #fff;
        }

        .alert-danger {
            background-color: #dc3545;
        }

        .alert-success {
            background-color: #28a745;
        }

        a {
            color: #8B00FF;
            /* Space Purple */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .already-registered {
            color: #fff;
        }

        .background-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

    .background-square {
    width: 150px;
    height: 150px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    position: absolute;
    animation: float 10s infinite ease-in-out;
}

.background-square.square1 {
    width: 150px;
    height: 150px;
    top: 3%;
    left: -2%;
    animation-delay: 0s;
}

.background-square.square2 {
    width: 400px;
    height: 400px;
    top: 50%;
    left: 70%;
    animation-delay: 1s;
}

.background-square.square3 {
    width: 180px;
    height: 180px;
    top: 10%;
    left: 85%;
    animation-delay: 2s;
}

.background-square.square4 {
    width: 300px;
    height: 300px;
    top: 50%;
    left: 5%;
    animation-delay: 3s;
}

.background-square.square5 {
    width: 100px;
    height: 100px;
    top: 5%;
    left: 50%;
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }

    50% {
        transform: translateY(-20px) rotate(45deg);
    }
}

    </style>
</head>
<div class="background-shapes">
        <div class="background-square square1"></div>
        <div class="background-square square2"></div>
        <div class="background-square square3"></div>
        <div class="background-square square4"></div>
        <div class="background-square square5"></div>
    </div>
<body>
    <?php
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "login_register";

    // Flag to track registration success
    $registration_success = false;

    // Establishing a connection to MySQL
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Checking the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handling form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieving and sanitizing form data
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $registration_number = mysqli_real_escape_string($conn, $_POST['registration_number']);
        $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        
        // Hashing the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // SQL query to insert data into users table
        $sql = "INSERT INTO users (name, email, registration_number, phone_number, username, password)
                VALUES ('$name', '$email', '$registration_number', '$phone_number', '$username', '$hashed_password')";
        
        if ($conn->query($sql) === TRUE) {
            $registration_success = true;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Closing the database connection
    $conn->close();
    ?>

    <?php if ($registration_success): ?>
         <!-- JavaScript to show popup -->
         <script>
            window.onload = function() {
                // Show popup modal
                alert("Registration successful! Please login to continue.");
                // Redirect to login page
                window.location.href = "login.php";
            };
        </script>
        <!-- <div class="success-message">
            Registration successful! Please <a href="login.php">  login  </a> to continue.
        </div> -->
    <?php else: ?>
        <div class="container">
        <h2>Sign Up</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <!-- <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br><br>
            
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>
            
            <label for="registration_number">Registration Number:</label><br>
            <input type="text" id="registration_number" name="registration_number" required><br><br>
            
            <label for="phone_number">Phone Number:</label><br>
            <input type="text" id="phone_number" name="phone_number" required><br><br>
            
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br><br>
            
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            
            <input type="submit" value="Register"> -->
            
            <div class="form-column">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>

                <label for="mail">Email:</label>
                <input type="email" id="mail" name="email" placeholder="Enter your email" required>

                <label for="regno">Registration Number:</label>
                <input type="text" id="regno" name="registration_number" placeholder="Enter your registration number" required>
            </div>

            <div class="divider"></div>

            <div class="form-column">
                <label for="phno">Phone Number:</label>
                <input type="tel" id="phno" name="phone_number" placeholder="Enter your phone number" required>

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Choose a username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter a password" required>
            </div>

            <div class="form-center">
                <button type="submit" name="submit">Sign up</button>
                <div class="already-registered">
                    <p>Already Registered? <a href="login.php">Login Here</a></p>
                </div>
            </div>
        </form>
        </div>
    <?php endif; ?>
</body>
</html>
