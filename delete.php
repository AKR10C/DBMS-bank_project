<?php
// Start the session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['logged_user'])) {
    // Redirect to the login page
    header("Location: index.php");
    exit();
}
?>

<?php
include "db_conn.php";
// Step 2: Execute a query to fetch data
$sql = "SELECT CustomerID, FirstName, LastName, DateOfBirth, Address, Phone, UserName FROM Customers";
$result = mysqli_query($conn, $sql);

// Step 5: Handle delete request
if (isset($_POST['delete'])) {
    $id_to_delete = $_POST['id_to_delete'];
    $sql_delete = "DELETE FROM Customers WHERE CustomerID = $id_to_delete";
    if (mysqli_query($conn, $sql_delete)) {
        echo "Record deleted successfully";
        // Redirect to prevent form resubmission
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Display and Delete Data from Database</title>
    <style>
         table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;}
        body {
            width: 100%;
            height: 100vh;
            margin: 0;
            background-color: #1b1b32;
            color: #f5f6f7;
            font-family: Tahoma;
            font-size: 16px;
        }
    </style>
</head>
<body>

<h2>Customer Data</h2>

<!-- Step 4: Display the data on the webpage -->
<table>
    <tr>
        <th>ID</th>
        <th>FirstName</th>
        <th>LastName</th>
        <th>Date of Birth</th>
        <th>Address</th>
        <th>Phone</th>
        <th>UserName</th>
        <th>Action</th>
    </tr>
    <?php
    if ($result && mysqli_num_rows($result) > 0) {
        // Step 3: Process the retrieved data
        // Loop through each row of data
        while($row = mysqli_fetch_assoc($result)) {
            // Display each row in a table row
            echo "<tr>";
            echo "<td>" . $row["CustomerID"] . "</td>";
            echo "<td>" . $row["FirstName"] . "</td>";
            echo "<td>" . $row["LastName"] . "</td>";
            echo "<td>" . $row["DateOfBirth"] . "</td>";
            echo "<td>" . $row["Address"] . "</td>";
            echo "<td>" . $row["Phone"] . "</td>";
            echo "<td>" . $row["UserName"] . "</td>";
            // Delete button
            echo "<td>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='id_to_delete' value='" . $row["CustomerID"] . "'>";
            echo "<button type='submit' name='delete'>Delete</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No records found</td></tr>";
    }
    ?>
</table>

<?php
// Close the connection
mysqli_close($conn);
?>

</body>
</html>
