<?php
// Include the database connection file
include 'connect.php';

// Function to fetch all users from the database
function getAllUsers($con) {
    $sql = "SELECT * FROM user";
    $result = $con->query($sql);
    $users = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }
    return $users;
}

// Function to delete a user from the database
function deleteUser($con, $u_id) {
    $sql = "DELETE FROM user WHERE u_id='$u_id'";
    if ($con->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Check if delete request is received
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete']) && isset($_POST['u_id'])) {
    $u_id = $_POST['u_id'];
    if (deleteUser($con, $u_id)) {
        // Redirect to avoid form resubmission on page refresh after successful deletion
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error deleting record: " . $con->error;
    }
}

// Fetch all users
$users = getAllUsers($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Airline System</title>
    <style>
        /* CSS styles for table */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #ddd; /* Add border to the table */
        }

        th, td {
            border: 1px solid #ddd; /* Add border to table cells */
            padding: 10px;
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

        /* Button styles */
        .button {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Users</h1>
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through users and display each row -->
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['u_id']; ?></td>
                        <td><?php echo $user['u_name']; ?></td>
                        <td><?php echo $user['u_email']; ?></td>
                        <td><?php echo $user['u_phone']; ?></td>
                        <td><?php echo $user['u_address']; ?></td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="u_id" value="<?php echo $user['u_id']; ?>">
                                <button type="submit" name="delete" class="button">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
