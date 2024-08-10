<!DOCTYPE html>
<html>
<head>
    <title>Ticket Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ticket Information</h2>
        <?php
        // Include the database connection file
        include 'connect.php';

        // Check if the ticket number is provided in the URL
        if(isset($_GET['ticket_number'])) {
            // Retrieve ticket information from the database
            $ticket_number = $_GET['ticket_number'];
            $sql = "SELECT * FROM booking_process WHERE ticket_number = '$ticket_number'";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                // Ticket found, display ticket information
                $row = $result->fetch_assoc();
                $flight_id = $row['f_id'];
                $user_id = $row['u_id'];
                $passenger_name = $row['passenger_name'];
                $passenger_email = $row['passenger_email'];
                $seat_number = $row['seat_number'];
                $payment_amount = $row['payment_amount'];
        ?>
        <table>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Ticket Number</td>
                <td><?php echo $ticket_number; ?></td>
            </tr>
            <tr>
                <td>Flight ID</td>
                <td><?php echo $flight_id; ?></td>
            </tr>
            <tr>
                <td>User ID</td>
                <td><?php echo $user_id; ?></td>
            </tr>
            <tr>
                <td>Passenger Name</td>
                <td><?php echo $passenger_name; ?></td>
            </tr>
            <tr>
                <td>Passenger Email</td>
                <td><?php echo $passenger_email; ?></td>
            </tr>
            <tr>
                <td>Seat Number</td>
                <td><?php echo $seat_number; ?></td>
            </tr>
            <tr>
                <td>Payment Amount</td>
                <td><?php echo $payment_amount; ?></td>
            </tr>
        </table>

        <!-- Add a button to generate PDF -->
        <form action="generate_pdf.php" method="post" style="text-align: center;">
            <input type="hidden" name="ticket_number" value="<?php echo $ticket_number; ?>">
            <input type="submit" name="generate_pdf" value="Generate PDF">
        </form>
        <?php
                } else {
                    // Ticket not found
                    echo "<p style='text-align: center;'>Ticket not found.</p>";
                }
            } else {
                // Ticket number not provided in the URL
                echo "<p style='text-align: center;'>Ticket number not provided.</p>";
            }

            // Close the connection
            $con->close();
        ?>
    </div>
</body>
</html>
