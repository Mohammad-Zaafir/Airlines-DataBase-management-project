<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Booking</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #b1cbbb;
        }
        header {
            background-color: #618685;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            font-size: 28px;
            letter-spacing: 1px;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #77a8a8;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .flight-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-gap: 20px;
        }
        .flight-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            background-color: #b1cbbb;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .flight-card:hover {
            transform: translateY(-5px);
        }
        .flight-card h2 {
            margin-top: 0;
            font-size: 22px;
            color: #333;
            margin-bottom: 10px;
        }
        .flight-card p {
            margin: 0 0 10px;
            color: #666;
            font-size: 16px;
        }
        .flight-card .btn {
            background-color: #77a8a8; /* Updated color here */
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
            display: inline-block;
            font-size: 16px;
        }
        .flight-card .btn:hover {
            background-color: #618685; /* Darker shade on hover */
        }
    </style>
</head>
<body>
    <header>
        <h1>Popular Flights</h1>
    </header>
    <div class="container">
        <div class="flight-list">
            <div class="flight-card">
                <h2>Flight 1</h2>
                <p>Departure: Mangalore</p>
                <p>Destination: Delhi</p>
                <p>Price: Rs 6000</p>
                <a href="manageflights1.php" class="btn">Show Flights</a>
            </div>
            <div class="flight-card">
                <h2>Flight 2</h2>
                <p>Departure: Delhi</p>
                <p>Destination: China</p>
                <p>Price: Rs 32000</p>
                <a href="manageflights1.php" class="btn">Show Flights</a>
            </div>
            <div class="flight-card">
                <h2>Flight 3</h2>
                <p>Departure: Bangalore</p>
                <p>Destination: Dubai</p>
                <p>Price: Rs 38000</p>
                <a href="manageflights1.php" class="btn">Show Flights</a>
            </div>
            <!-- Additional flight cards can be added here -->
        </div>
    </div>
</body>
</html>
