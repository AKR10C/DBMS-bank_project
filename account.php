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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dgin.css"/>
    <title>Account Information</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        
        
    </style>
</head>
<body>

<h2>Enter Account ID to View Details</h2>

<form method="GET">
    <label for="account_id">Account ID:</label>
    <input type="text" id="account_id" name="account_id" required>
    <button type="submit">Show Details</button>
</form>

<?php
// Include the database connection file
include 'db_conn.php';

// Check if account ID is provided via URL parameter
if(isset($_GET['account_id'])) {
    $account_id = $_GET['account_id'];

    // Fetch account information for the specified account ID from the database
    $sql = "SELECT * FROM accounts WHERE AccountID = $account_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Display account information in a table
        echo "<h2>Account Details</h2>";
        echo "<table>";
        echo "<tr><th>AccountID</th><th>Balance</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["AccountID"] . "</td>";
            echo "<td>" . $row["Balance"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No account found with ID: $account_id</p>";
    }
}

// Close the database connection
mysqli_close($conn);
?>
<li><a href="client_dash.php">Back</a></li>
</body>
</html>
