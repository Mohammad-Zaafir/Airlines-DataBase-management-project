<?php
// Include the database connection file
include 'connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book_flight'])) {
    // Retrieve form data
    $flight_id = isset($_POST["flight_id"]) ? $_POST["flight_id"] : "";
    $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : "";
    $passenger_name = isset($_POST["passenger_name"]) ? $_POST["passenger_name"] : "";
    $passenger_email = isset($_POST["passenger_email"]) ? $_POST["passenger_email"] : "";
    $seat_number = isset($_POST["seat_number"]) ? $_POST["seat_number"] : "";
    $payment_amount = isset($_POST["payment_amount"]) ? $_POST["payment_amount"] : "";

    // Generate a unique ticket number only if the form is submitted
    $ticket_number = 'TKT-' . uniqid();

    // Insert data into the database
    $sql = "INSERT INTO booking_process (f_id, u_id, passenger_name, passenger_email, seat_number, payment_amount, ticket_number) 
            VALUES ('$flight_id', '$user_id', '$passenger_name', '$passenger_email', '$seat_number', '$payment_amount', '$ticket_number')";

    // Debugging: Print out the SQL query
    echo "SQL Query: $sql<br>";

    if ($con->query($sql) === TRUE) {
        // Redirect to ticket.php
        header("Location: ticket.php?ticket_number=$ticket_number");
        exit();
    } else {
        // Display error message if the query fails
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

// Close the connection
$con->close();
?>





<!DOCTYPE html>
<html>
<head>
    <title>Airline Reservation System</title>
    <style>
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
            <h1>Book Flight</h1>
        </div>
        <div class="form-group">
            <form id="bookingForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="flight_id">Flight ID:</label><br>
                <input type="text" name="flight_id" id="flight_id" required><br><br
                <label for="user_id">User ID:</label><br>
                <input type="text" name="user_id" id="user_id" required><br><br>
                <label for="passenger_name">Passenger Name:</label><br>
                <input type="text" name="passenger_name" id="passenger_name" required><br><br>
                <label for="passenger_email">Passenger Email:</label><br>
                <input type="email" name="passenger_email" id="passenger_email" required><br><br>
                <label for="seat_number">Seat Number:</label><br>
                <input type="text" name="seat_number" id="seat_number" required><br><br>
                <label for="payment_amount">Payment Amount:</label><br>
                <input type="text" name="payment_amount" id="payment_amount" required><br><br>
                <input type="submit" name="book_flight" value="Book Flight"><br>
            </form>
        </div>
        <div class="signup-link">
            <a href="signup.php">Don't have an account? Sign Up here</a>
        </div>
    </div>
</body>
</html>
