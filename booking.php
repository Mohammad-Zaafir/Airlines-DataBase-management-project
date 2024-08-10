<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Booking</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #e6e6e6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            box-sizing: border-box;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        h2 {
            font-size: 36px;
            color: #333;
            margin-bottom: 20px;
            text-transform: uppercase;
            font-weight: 700;
        }
        form {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
            font-size: 18px;
            font-weight: 600;
        }
        input[type="text"],
        input[type="date"],
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: 600;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
            font-size: 16px;
            color: #333;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .no-flights {
            text-align: center;
            color: #666;
            margin-top: 20px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Flight Booking</h2>
        </div>
        <form id="flightForm" method="POST" action="booking.php">
            <label for="departure">Departure Location:</label>
            <input type="text" name="departure" id="departure" required>
            
            <label for="destination">Destination:</label>
            <input type="text" name="destination" id="destination" required>
            
            <label for="date">Date:</label>
            <input type="date" name="date" id="date" required>
            
            <input type="submit" name="submit" value="Search Flights">
        </form>

        <?php
        if(isset($_POST['submit'])) {
            // Include database connection
            include 'connect.php';

            // Get user inputs
            $departure = $_POST['departure'];
            $destination = $_POST['destination'];
            $date = isset($_POST['date']) ? $_POST['date'] : '';

            // Construct SQL query
            $sql = "SELECT * FROM manage_flight WHERE departure = '$departure' AND destination = '$destination' AND date = '$date' ";
            $result = mysqli_query($con, $sql);

            // Check if any flights found
            if (mysqli_num_rows($result) > 0) {
                echo "<h3>Available Flights:</h3>";
                echo "<table>";
                echo "<tr><th>Flight ID</th><th>Departure Time</th><th>Arrival Time</th><th>Action</th></tr>";
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>{$row['flight_id']}</td><td>{$row['departure_time']}</td><td>{$row['arrival_time']}</td><td><form method='POST' action='booking_process.php'><input type='hidden' name='flight_id' value='{$row['flight_id']}'><input type='submit' name='book' value='Book'></form></td></tr>";
                }
                echo "</table>";
            } else {
                echo "<p class='no-flights'>No flights found.</p>";
            }

            // Close connection
            mysqli_close($con);
        }
        ?>
    </div>
</body>
</html>
