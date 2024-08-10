<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Flights</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            display: block;
            margin: 0 auto;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="header">Manage Flights</h1>

        <?php
        // Include the database connection file
        include 'connect.php';

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
            echo "<tr><th>Flight ID</th><th>Departure</th><th>Destination</th><th>Date</th><th>Departure Time</th><th>Arrival Time</th></tr>";
            while ($row = $result->fetch_assoc()) {
                // Check if "flight_id" key exists in the $row array
                $flightId = isset($row["flight_id"]) ? $row["flight_id"] : "N/A";
                echo "<tr><td>" . $flightId . "</td><td>" . $row["departure"] . "</td><td>" . $row["destination"] . "</td><td>" . $row["date"] . "</td><td>" . $row["departure_time"] . "</td><td>" . $row["arrival_time"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        ?>

        <?php
        // Close the connection
        $con->close();
        ?>

        <button class="btn">Add New Flight</button>
    </div>
</body>
</html>