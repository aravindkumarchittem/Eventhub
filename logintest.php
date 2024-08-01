<?php
session_start();

// Redirect if user is already logged in
if (isset($_SESSION["user"])) {
    header("Location: index2.html");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Database connection parameters
    $servername = "localhost";
    $username = "aravind";
    $password_db = "aravind@mysql";
    $dbname = "login_register"; // Change to your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch user based on email
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user["password"])) {
                // Password is correct, start session
                $_SESSION["user"] = $user["email"];
                header("Location: index2.html");
                exit();
            } else {
                $error_message = "Password does not match.";
            }
        } else {
            $error_message = "Email not found.";
        }

        $stmt->close();
    } else {
        $error_message = "Database error: failed to prepare statement.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            background: linear-gradient(135deg, #1f1c2c 0%, #8B00FF 100%);
            /* Space Purple and Black Gradient */
            color: #e0e0e0;
            overflow: hidden;
            /* Prevent scrolling */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 90%;
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
            backdrop-filter: blur(10px);
            text-align: center;
            animation: fadeIn 2s ease-in-out;
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
        }

        .form-group {
            margin-bottom: 15px;
            position: relative;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.3);
            border: none;
            color: #fff;
            padding: 10px 10px 10px;
            /* Adjusted padding for icon */
            caret-color: #8B00FF;
            /* Color of the text cursor */
        }

        .form-control::placeholder {
            color: #e0e0e0;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.5);
            color: #fff;
            outline: none;
            box-shadow: 0 0 5px rgba(139, 0, 255, 0.5);
        }

        .form-group i {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: #e0e0e0;
        }

        .btn-primary {
            background-color: #8B00FF;
            /* Space Purple */
            border: none;
            width: 100%;
            padding: 10px;
            font-size: 1.2rem;
            transition: background-color 0.3s ease, transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            background-color: #6A00CC;
            /* Darker shade of Space Purple */
            transform: scale(1.05);
            /* Scale up on hover */
        }

        .btn-primary:active {
            background-color: #5A009A;
            /* Even darker shade of Space Purple */
            transform: scale(0.95);
            /* Scale down on click */
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: transform 0.3s ease;
        }

        .btn-primary:active::before {
            transform: translate(-50%, -50%) scale(1);
            transition: transform 0s;
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

        .background-shape {
            position: absolute;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            box-shadow: inset -2px -2px 10px rgba(255, 255, 255, 0.2), inset 2px 2px 10px rgba(0, 0, 0, 0.2);
            animation: float 20s infinite ease-in-out;
        }

        .background-shape.shape1 {
            width: 200px;
            height: 200px;
            top: -10px;
            left: -10px;
            animation-delay: 0s;
        }

        .background-shape.shape2 {
            width: 400px;
            height: 400px;
            bottom: -50px;
            right: -100px;
            animation-delay: 2s;
        }

        .background-shape.shape3 {
            width: 150px;
            height: 150px;
            right: 40%;
            bottom: 70%;
            animation-delay: 4s;
        }

        .background-shape.shape4 {
            width: 350px;
            height: 350px;
            top: 40%;
            left: 10%;
            animation-delay: 6s;
        }

        .background-shape.shape5 {
            width: 200px;
            height: 200px;
            top: -10px;
            right: -10px;
            animation-delay: 0s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-40px) rotate(45deg);
            }
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 1.5rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            .form-control {
                font-size: 0.9rem;
                padding: 8px 8px 8px 35px;
                /* Adjusted padding for icon */
            }

            .btn-primary {
                font-size: 1rem;
                padding: 8px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 1rem;
            }

            h2 {
                font-size: 1.2rem;
            }

            .form-control {
                font-size: 0.8rem;
                padding: 7px 7px 7px 30px;
                /* Adjusted padding for icon */
            }

            .btn-primary {
                font-size: 0.9rem;
                padding: 7px;
            }
        }
    </style>
</head>

<body>
    <div class="background-shapes">
        <div class="background-shape shape1"></div>
        <div class="background-shape shape2"></div>
        <div class="background-shape shape3"></div>
        <div class="background-shape shape4"></div>
        <div class="background-shape shape5"></div>
    </div>
    <div class="container">
        <h2>Login</h2>
        <div class="container">
            <?php if (isset($error_message)) : ?>
            <div class="alert alert-danger">
                <?php echo $error_message; ?>
            </div>
            <?php endif; ?>

            <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]); ?>" method="post">
                <form action="login.php" method="post">
                    <div class="form-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Enter Email:" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Enter Password:" name="password" class="form-control"
                            required>
                    </div>
                    <div class="form-btn">
                        <input type="submit" value="Login" name="login" class="btn btn-primary">
                    </div>
                </form>
                <div>
                    <p>Not registered yet? <a href="registration.php">Register Here</a></p>
                </div>
        </div>
</body>

</html>