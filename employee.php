<?php
// Database connection and form handling logic
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the delete button is clicked
    if (isset($_POST['delete'])) {
        // Delete the employee record
        $emp_id = $_POST['emp_id'];
        $delete_sql = "DELETE FROM employee WHERE emp_id='$emp_id'";
        if ($con->query($delete_sql) === TRUE) {
            // Redirect to avoid form resubmission on page refresh after successful deletion
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error deleting record: " . $con->error;
        }
    } else {
        // Retrieve values from the form if they exist
        $emp_name = isset($_POST["emp_name"]) ? $_POST["emp_name"] : '';
        $emp_email = isset($_POST["emp_email"]) ? $_POST["emp_email"] : '';
        $e_phone = isset($_POST["e_phone"]) ? $_POST["e_phone"] : '';
        $e_address = isset($_POST["e_address"]) ? $_POST["e_address"] : '';
        $e_password = isset($_POST["e_password"]) ? $_POST["e_password"] : '';
        $role_name = isset($_POST["role_name"]) ? $_POST["role_name"] : '';

        // Insert values into the database
        $sql = "INSERT INTO employee (emp_name, emp_email, e_phone, e_address, e_password, role_name) VALUES ('$emp_name', '$emp_email', '$e_phone', '$e_address', '$e_password', '$role_name')";
        
        if ($con->query($sql) === TRUE) {
            // Redirect to avoid form resubmission on page refresh after successful insertion
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <style>
        /* Resetting default margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        /* Container styles */
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        /* Heading styles */
        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        /* Form styles */
        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        /* Button styles */
        .button {
            background-color: #008CBA;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #005f6b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Employee</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="emp_name">Name:</label><br>
            <input type="text" id="emp_name" name="emp_name" required><br>
            
            <label for="emp_email">Email:</label><br>
            <input type="email" id="emp_email" name="emp_email" required><br>
            
            <label for="e_phone">Phone:</label><br>
            <input type="tel" id="e_phone" name="e_phone" pattern="[0-9]{10}" required><br>
            
            <label for="e_address">Address:</label><br>
            <input type="text" id="e_address" name="e_address" required><br>
            
            <label for="e_password">Password:</label><br>
            <input type="password" id="e_password" name="e_password" required><br><br>

            <label for="role_name">Role:</label><br>
            <input type="text" id="role_name" name="role_name" required><br><br>
            
            <input type="submit" class="button" value="Add Employee">
        </form>

        <h2>Employee Details</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Role</th> <!-- Added Role column -->
                <th>Action</th>
            </tr>
            <?php
            // Retrieve and display employee details from database
            $sql = "SELECT * FROM employee";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['emp_id']."</td>";
                    echo "<td>".$row['emp_name']."</td>";
                    echo "<td>".$row['emp_email']."</td>";
                    echo "<td>".$row['e_phone']."</td>";
                    echo "<td>".$row['e_address']."</td>";
                    echo "<td>".$row['role_name']."</td>"; // Display role
                    echo "<td><form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'><input type='hidden' name='emp_id' value='".$row['emp_id']."'><input type='submit' name='delete' value='Delete' class='button'></form></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No employees found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
