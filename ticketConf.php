<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Confirmation</title>
    <link rel="stylesheet" href="ticket.css" />
</head>
<body>
    <div class="ticketConf">
        <div class="ticket">
            <h1 class="ticket-heading">Flight Ticket</h1>
            <div class="ticket-details">
                <table class="ticket-table">
                    <thead>
                        <tr>
                            <th>Flight ID</th>
                            <th>Departure</th>
                            <th>Destination</th>
                            <th>Departure Time</th>
                            <th>Arrival Time</th>
                        </tr>
                    </thead>
                    
                    <tbody id="ticket-details">
                        <?php
                        // Include the database connection file
                        include 'connect.php';

                        // Query to fetch flight details
                        $sql = "SELECT * FROM manage_flights";
                        $result = $con->query($sql);

                        // Check if there are any flights
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["flight_id"] . "</td>";
                                echo "<td>" . $row["departure"] . "</td>";
                                echo "<td>" . $row["destination"] . "</td>";
                                echo "<td>" . $row["departure_time"] . "</td>";
                                echo "<td>" . $row["arrival_time"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No flights found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
