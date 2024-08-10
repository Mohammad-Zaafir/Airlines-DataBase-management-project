<?php
include "connect.php"; // Include your database connection file
session_start(); // Start the session

// Check if user is logged in
if (!isset($_SESSION["u_id"])) {
    // Redirect to the sign-in page if user is not logged in
    header("Location: signin.php");
    exit();
}

$user_id = $_SESSION["u_id"];

// Fetch user data
$sql = "SELECT * FROM user WHERE u_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// If user not found, redirect to sign-up page
if ($result->num_rows == 0) {
    header("Location: admindashboard.html");
    exit();
}

// User found, display profile information
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .profile {
            text-align: center;
        }

        h1 {
            margin-top: 0;
            font-size: 28px;
            color: #333;
        }

        p {
            margin: 5px 0;
            font-size: 16px;
            color: #666;
        }

        .info {
            margin-top: 20px;
            text-align: left;
        }

        .info p {
            margin: 10px 0;
        }

        .label {
            font-weight: bold;
            color: #333;
        }

        .contact {
            margin-top: 20px;
            text-align: center;
        }

        .contact a {
            display: inline-block;
            margin: 5px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .contact a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="profile">
        <h1>User Profile</h1>
        <div class="info">
            <p><span class="label">User ID:</span> #<?php echo $row["u_id"]; ?></p>
            <p><span class="label">Name:</span> <?php echo $row["u_name"]; ?></p>
            <p><span class="label">Email:</span> <?php echo $row["u_email"]; ?></p>
            <p><span class="label">Phone:</span> <?php echo $row["u_phone"]; ?></p>
            <p><span class="label">Address:</span> <?php echo $row["u_address"]; ?></p>
        </div>
        <div class="contact">
            <a href="mailto:<?php echo $row["u_email"]; ?>">Send Email</a>
            <a href="tel:<?php echo $row["u_phone"]; ?>">Call</a>
            <a href="userpage.php">Home Page</a>
        </div>
    </div>
</div>

</body>
</html>
