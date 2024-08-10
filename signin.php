<?php
include 'connect.php'; // Include your database connection file

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signin"])) {
    // Check if email and password are set in the form submission
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        // Retrieve form data
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Prepare and execute SQL statement to check if user exists
        $sql = "SELECT * FROM user WHERE u_email = ? AND u_password = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists in database
        if ($result->num_rows > 0) {
            // User exists, retrieve user ID and store in session
            $user = $result->fetch_assoc();
            session_start();
            $_SESSION["u_id"] = $user["u_id"];
            // Redirect to the user profile page
            header("Location: userprofile.php");
            exit();
        } else {
            // User does not exist or credentials are incorrect, show an error message
            echo "<script>alert('Invalid email or password. Please try again.');</script>";
        }
    } else {
        // Handle the case where email or password is not set in the form submission
        echo "<script>alert('Please enter both email and password.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Airline Reservation System</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(to bottom right, #a8c0ff, #ffa8e0);
            padding: 20px;
            margin: 0; /* Remove margin to make the container take up the full width */
        }

        .container 
        {
            max-width: 400px; /* Reduce container width for better readability */
            margin: 50px auto; /* Center the container vertically */
            background-color: #cef4f6;
            padding: 40px; /* Increase padding for better spacing */
            border-radius: 10px; /* Increase border radius for smoother edges */
            box-shadow: 0px 0px 20px rgba(0,0,0,0.2); /* Add a subtle shadow effect */
        }

        .header 
        {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #ccc; /* Add bottom border */
            padding-bottom: 10px; /* Add padding to bottom border */
        }

        .header h1 {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            color: #4CAF50;
        }
        .form-group 
        {
            margin-bottom: 20px;
        }

        input[type="text"], input[type="password"], input[type="email"], input[type="submit"] {
            width: 100%;
            padding: 15px; /* Match padding to input fields for consistent size */
            border-radius: 8px; /* Increase border radius for smoother edges */
            border: 1px solid #ccc;
            background-color: #f5f5f5; /* Light gray background color */
            transition: border-color 0.3s ease; /* Smooth transition on focus */
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
        }

        input[type="text"]:focus, input[type="password"]:focus, input[type="email"]:focus {
            border-color: #4CAF50; /* Change border color on focus */
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            margin-bottom: 20px; /* Add margin to separate the form and the signup link */
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
        a {
            color:#45a049;
     text-decoration: none;
    }
        .signup-link 
        {
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            color: #4CAF50;
            text-decoration: none;
            display: block;
        }
        .signup-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Sign In</h1>
        </div>
        <div class="form-group">
            <form id="signinForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="email">Email or Phone:</label><br>
                <input type="text" name="email" id="email" required><br><br>
                <label for="password">Password:</label><br>
                <input type="password" name="password" id="password" required><br><br><br>
                <input type="submit" name="signin" value="Sign In"><br>
            </form>
        </div>
        <div class="signup-link"><a href="signup.php">
            Don't have an account? Sign Up here</a>
        </div>
    </div>
    <script>
        // JavaScript code goes here
    </script>
</body>
</html>
