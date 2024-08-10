<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve form data
    $adminId = isset($_GET["admin_id"]) ? $_GET["admin_id"] : "";
    $password = isset($_GET["password"]) ? $_GET["password"] : "";

    // Validate and process the login (you can add more validation as needed)
    $hashedPassword = password_hash("password123", PASSWORD_DEFAULT);

    if ($adminId === "mohammadzaafir123@gmail.com" && password_verify($password, $hashedPassword)) {
        // Valid credentials, set session variable and redirect to the admin dashboard
        $_SESSION["admin_id"] = $adminId;
        header("Location: admindashboard.php");
        exit();
    } else {
        // Invalid credentials, display an error message
        $loginError = "Invalid Admin ID or Password.";
    }
} else {
    // Handle other HTTP methods if necessary
    echo "Invalid request method.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(to bottom right, #a8c0ff, #ffa8e0);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #cef4f6;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form action="adminlogin.php" method="GET">
        <h2>Admin Login</h2>

        <label for="admin_id">Admin ID:</label>
        <input type="text" id="admin_id" name="admin_id" placeholder="Admin ID" required value="<?php echo $adminId; ?>">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>

        <?php
        // Display login error if any
        if (isset($loginError)) {
            echo "<p class='error'>$loginError</p>";
        }
        ?>
    </form>
</body>
</html>
