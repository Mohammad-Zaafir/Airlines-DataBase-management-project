<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            animation: fadeIn ease 0.5s; /* Fade-in animation */
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff; /* Blue color */
            text-transform: uppercase;
            font-size: 28px;
            letter-spacing: 1px;
        }

        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: slideIn ease 0.5s; /* Slide-in animation */
        }

        @keyframes slideIn {
            0% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0);
            }
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
            text-transform: uppercase;
            font-size: 14px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e9ecef; /* Lighter hover color */
        }

        /* Responsive styles */
        @media only screen and (max-width: 600px) {
            table {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <h1>Manage Bookings</h1>
    
    <?php
    // Include the database connection file
    include 'connect.php';

    // Check if the connection is successful
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Query to retrieve bookings
    $sql = "SELECT * FROM booking_process";
    $result = $con->query($sql);

    // Display bookings in a table
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Flight ID</th><th>User ID</th><th>Passenger Name</th><th>Passenger Email</th><th>Seat Number</th><th>Payment Amount</th><th>Ticket Number</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["f_id"] . "</td><td>" . $row["u_id"] . "</td><td>" . $row["passenger_name"] . "</td><td>" . $row["passenger_email"] . "</td><td>" . $row["seat_number"] . "</td><td>" . $row["payment_amount"] . "</td><td>" . $row["ticket_number"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    // Close the database connection
    $con->close();
    ?>

</body>
</html>
