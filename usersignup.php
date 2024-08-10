<?php
// Retrieve form data from URL parameters
$name = isset($_GET['name']) ? $_GET['name'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';
$phone = isset($_GET['phone']) ? $_GET['phone'] : '';
$address = isset($_GET['address']) ? $_GET['address'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Styles -->
</head>
<body>
    <div class="container">
        <div class="profile">
            <h1>User Profile</h1>
            <div class="info">
                <p><span class="label">Name:</span> <?php echo $name; ?></p>
                <p><span class="label">Email:</span> <?php echo $email; ?></p>
                <p><span class="label">Phone:</span> <?php echo $phone; ?></p>
                <p><span class="label">Address:</span> <?php echo $address; ?></p>
            </div>
            <!-- Additional Profile Information -->
        </div>
    </div>
</body>
</html>
