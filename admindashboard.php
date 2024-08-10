<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airline Database Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(to bottom right, #a8c0ff, #ffa8e0);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 350px;
            height: 400px;
            padding: 20px;
            background-color: #cef4f6;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
        }

        h2 {
            color: #555;
            margin-bottom: 15px;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .button {
            max-width: 200px;
            background-color: #008CBA;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin: 0 auto;
            margin-bottom: 10px;
            display: block;
        }

        .button:hover {
            background-color: #ff3b3b;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Admin Dashboard</h1>

    <div class="button-container">
        <div>
            <a href="manage_flights.php" class="button">Manage Flights</a>
        </div>
        <br>
        <br>
        <div>
            <a href="manage_passengers.php" class="button">Manage Users</a>
        </div>
        <br>
        <br>
        <div>
            <a href="manage_bookings.php" class="button">Manage Bookings</a>
        </div>
        <br>
        <br>
        <div>
            <a href="employee.php" class="button">Manage Employees</a>
        </div>
    </div>
</div>

</body>
</html>
