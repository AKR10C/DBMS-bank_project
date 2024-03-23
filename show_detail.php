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
include 'db_conn.php';

// Step 2: Execute queries
$sql_customer = "SELECT CustomerID, FirstName, LastName, DateOfBirth, Address, Phone, UserName FROM Customers";
$result_customer = mysqli_query($conn, $sql_customer);

$sql_account = "SELECT AccountID FROM Accounts";
$result_account = mysqli_query($conn, $sql_account);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Display Data from Database</title>
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
            <th>AcoountID</th>
            <th>FirstName</th>
            <th>LastName</th>
            <!--<th>Balance</th>-->
            <th>Date of Birth</th>
            <th>Address</th>
            <th>Phone</th>
            <th>UserName</th>
        </tr>
        <?php
        // Step 3: Process the retrieved data
        if ($result_customer && $result_account) {
            // Loop through each row of data
            while ($row_customer = mysqli_fetch_assoc($result_customer)) {
                // Fetch corresponding account ID from the second query result
                $row_account = mysqli_fetch_assoc($result_account);

                // Display each row in a table row
                echo "<tr>";
                echo "<td>" . $row_customer["CustomerID"] . "</td>";
                echo "<td>" . $row_account["AccountID"] . "</td>";
                echo "<td>" . $row_customer["FirstName"] . "</td>";
                echo "<td>" . $row_customer["LastName"] . "</td>";
                echo "<td>" . $row_customer["DateOfBirth"] . "</td>";
                echo "<td>" . $row_customer["Address"] . "</td>";
                echo "<td>" . $row_customer["Phone"] . "</td>";
                echo "<td>" . $row_customer["UserName"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Error executing query: " . mysqli_error($conn) . "</td></tr>";
        }
        ?>
    </table>

    <?php
    // Close the connection
    mysqli_close($conn);
    ?>

    </table> 

</body>

</html>