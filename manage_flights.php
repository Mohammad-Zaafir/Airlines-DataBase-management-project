<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Flights</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa; /* Light gray background */
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 50px auto; /* Centering containers */
            padding: 30px;
            background: linear-gradient(to bottom right, #ffffff, #f0f0f0);
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1); /* Soft shadow */
            margin-bottom: 20px; /* Spacing between containers */
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #4e6bff; /* Blue color */
            text-transform: uppercase;
            font-size: 36px; /* Increase font size */
            letter-spacing: 1px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Soft shadow */
        }

        th, td {
            border: 1px solid #dee2e6; /* Lighter gray border */
            padding: 15px; /* Increase padding */
            text-align: left;
        }

        th {
            background-color: #4e6bff; /* Blue color */
            color: #fff;
            text-transform: uppercase;
            font-size: 14px;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa; /* Light gray background */
        }

        tr:hover {
            background-color: #e9ecef; /* Lighter hover color */
        }

        form {
            background: linear-gradient(to bottom right, #ffffff, #f0f0f0);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1); /* Soft shadow */
            margin-top: 20px; /* Spacing between form and table */
        }

        h2 {
            color: #4e6bff; /* Blue color */
            font-size: 28px; /* Increase font size */
            margin-bottom: 30px; /* Increase margin */
            text-align: center; /* Center align heading */
        }

        label {
            display: block;
            margin-bottom: 15px; /* Increase margin */
            color: #666; /* Dark gray color */
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        button {
            width: calc(100% - 30px); /* Subtract padding and border width */
            padding: 12px; /* Increase padding */
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 20px; /* Increase margin */
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="text"]:focus,
        input[type="date"]:focus,
        input[type="time"]:focus {
            outline: none;
            border-color: #4e6bff; /* Blue color */
        }

        button {
            background-color: #4e6bff; /* Blue color */
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #375aac; /* Darker blue color on hover */
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Flights</h1>

        <?php
        // Include the database connection file
        include 'connect.php';

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if the delete button is clicked
            if(isset($_POST["delete_flight"])) {
                $flight_id = $_POST["delete_flight"];
                // Delete the flight from the database
                $sql = "DELETE FROM manage_flight WHERE flight_id='$flight_id'";
                if ($con->query($sql) === TRUE) {
                    // After deleting the flight, redirect to the same page
                    header("Location: ".$_SERVER['PHP_SELF']);
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . $con->error;
                }
            } else {
                // Retrieve form data and perform basic validation
                $departure = isset($_POST["departure"]) ? $_POST["departure"] : "";
                $destination = isset($_POST["destination"]) ? $_POST["destination"] : "";
                $date = isset($_POST["date"]) ? $_POST["date"] : "";
                $departure_time = isset($_POST["departure_time"]) ? $_POST["departure_time"] : "";
                $arrival_time = isset($_POST["arrival_time"]) ? $_POST["arrival_time"] : "";

                // Combine date and time to form departure datetime
                $departure_datetime = $date . ' ' . $departure_time;

                // Set arrival time based on destination continent
                $arrivalDateTime = new DateTime($departure_time);

                switch ($destination) {
                    case 'India':
                        // Domestic flights within India arrive 1 hour after departure time
                        $arrivalDateTime->add(new DateInterval('PT1H'));
                        break;

                    case 'Asia':
                        // Flights within Asia arrive 4 hours after departure time
                        $arrivalDateTime->add(new DateInterval('PT4H'));
                        break;

                    case 'North America':
                    case 'South America':
                        // Flights to North/South America arrive 16 hours after departure time
                        $arrivalDateTime->add(new DateInterval('PT16H'));
                        break;

                    case 'Europe':
                        // Flights to Europe arrive 12 hours after departure time
                        $arrivalDateTime->add(new DateInterval('PT12H'));
                        break;

                    case 'Australia':
                        // Flights to Australia arrive 8 hours after departure time
                        $arrivalDateTime->add(new DateInterval('PT8H'));
                        break;

                    default:
                        // Default case, use 4 hours as a fallback
                        $arrivalDateTime->add(new DateInterval('PT4H'));
                        break;
                }

                $arrival_time = $arrivalDateTime->format('Y-m-d H:i:s');

                // Insert data into the database
                $sql = "INSERT INTO manage_flight (departure, destination, date, departure_time, arrival_time) 
                        VALUES ('$departure', '$destination', '$date', '$departure_datetime', '$arrival_time')";

                        if ($con->query($sql) === TRUE) {
                            // After processing the form, redirect to the same page
                            header("Location: ".$_SERVER['PHP_SELF']);
                            exit();
                        } else {
                            echo "Error: " . $sql . "<br>" . $con->error;
                        }
                    }
                }
            

            // Query to retrieve flights
            $sql = "SELECT * FROM manage_flight";
            $result = $con->query($sql);

            // Check for errors in the query execution
            if (!$result) {
                die("Error: " . $con->error);
            }
            ?>

            <?php
            // Display flights in a table
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Flight ID</th><th>Departure</th><th>Destination</th><th>Date</th><th>Departure Time</th><th>Arrival Time</th><th>Action</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    $flightId = isset($row["flight_id"]) ? $row["flight_id"] : "N/A";
                    echo "<tr><td>" . $flightId . "</td><td>" . $row["departure"] . "</td><td>" . $row["destination"] . "</td><td>" . $row["date"] . "</td><td>" . $row["departure_time"] . "</td><td>" . $row["arrival_time"] . "</td><td><form method='post'><button type='submit' name='delete_flight' value='".$flightId."'>Delete</button></form></td></tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
            ?>

        </div>

        <div class="container">
            <!-- Add this form below the table -->
            <form action="" method="post">
                <h2>Add New Flight</h2>
                <label for="departure">Departure:</label>
                <input type="text" name="departure" required>

                <label for="destination">Destination:</label>
                <input type="text" name="destination" required>

                <!-- Include date field for the form -->
                <label for="date">Date:</label>
                <input type="date" name="date" required>

                <!-- Allow users to input departure time -->
                <label for="departure_time">Departure Time:</label>
                <input type="time" name="departure_time" required>

                <!-- These fields will be automatically filled based on the PHP logic -->
                <input type="hidden" name="arrival_time" value="<?php echo date('Y-m-d H:i:s'); ?>" required>

                <button type="submit">Add Flight</button>
            </form>
        </div>
    </body>
</html>