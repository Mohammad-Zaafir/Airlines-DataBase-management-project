<?php
include 'connect.php'; // Include your database connection file

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    // Validate password confirmation
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match.');</script>";
    } else {
        // Prepare and execute SQL statement to insert user data into database
        $sql = "INSERT INTO user (u_name, u_email, u_phone, u_address, u_password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password
        $stmt->bind_param("sssss", $name, $email, $phone, $address, $hashedPassword);

        if ($stmt->execute()) {
            // Redirect to usersignup.php with form data as URL parameters
            header("Location: usersignup.php?name=$name&email=$email&phone=$phone&address=$address");
            exit();
        } else {
            echo "<script>alert('Error signing up: " . $stmt->error . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>MNZ Horizon - Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(to bottom right, #a8c0ff, #ffa8e0);
            padding: 20px;
            margin: 0; /* Remove margin to make the container take up the full width */
        }

        .container {
            max-width: 400px;
            margin: 20px auto;
            background-color: #cef4f6;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0,0,0,0.1);
            overflow: hidden; /* Added to prevent layout issues with the dropdown */
            text-align: center; /* Align content to center */
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #ccc; /* Add bottom border */
            padding-bottom: 10px; /* Add padding to bottom border */
        }

        .header h1 {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            color: #42ca59; /* Blue color for the heading */
        }

        .form-group {
            margin-bottom: 20px;
        }

        input[type="text"], input[type="password"], input[type="email"], input[type="submit"] {
            width: calc(100% - 20px); /* Subtract padding from width */
            padding: 15px;
            border-radius: 10px; /* Make border radius round */
            border: 2px solid #ccc; /* Add border */
            background-color: #f5f5f5; /* Light gray background color */
            transition: border-color 0.3s ease; /* Smooth transition */
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
            font-size: 16px;
            display: block;
            margin: 0 auto; /* Center horizontally */
            margin-bottom: 20px; /* Add margin to separate the form and the signup link */
        }

        input[type="text"]:focus, input[type="password"]:focus, input[type="email"]:focus, input[type="submit"]:hover {
            border-color: #4CAF50; /* Change border color on focus */
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        .signup-link {
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
            <h1>Sign Up</h1> 
        </div> 
        
        <form id="signupForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <input type="text" name="name" id="name" placeholder="Name" required>
            </div>
            
            <div class="form-group">
                <input type="email" name="email" id="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <input type="text" name="phone" id="phone" placeholder="Phone" required>
            </div>

            <div class="form-group">
                <input type="text" name="address" id="address" placeholder="Address" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" required>
            </div>
            <input type="submit" value="Sign Up">
        </form>
        <a href="signin.html" class="signup-link">Already have an account? Sign In</a>
    </div>

    <script>
    document.getElementById('signupForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally
        
        // Get form inputs
        var nameInput = document.getElementById('name').value;
        var phoneInput = document.getElementById('phone').value;
        var emailInput = document.getElementById('email').value;
        var addressInput = document.getElementById('address').value;
        var passwordInput = document.getElementById('password').value;
        var confirmPasswordInput = document.getElementById('confirmPassword').value;

        // Regular expression for validating phone number (10 digits)
        var phoneRegex = /^\d{10}$/;
        
        // Check if all fields are filled and passwords match
        if (nameInput === "" || phoneInput === "" || emailInput === "" || addressInput === "" || passwordInput === "" || confirmPasswordInput === "") {
            alert("Please fill in all fields.");
        } else if (passwordInput !== confirmPasswordInput) {
            alert("Passwords do not match.");
        } else {
            // Redirect to usersignup.php with form data as URL parameters
            window.location.href = 'usersignup.php?name=' + encodeURIComponent(nameInput) +
                                   '&email=' + encodeURIComponent(emailInput) +
                                   '&phone=' + encodeURIComponent(phoneInput) +
                                   '&address=' + encodeURIComponent(addressInput);
        }
    });
</script>


</body>
</html>
