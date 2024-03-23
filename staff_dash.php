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
    <title>Bank Staff Dashboard</title>
    <style>
       body {
    font-family: Arial, sans-serif;
    background-color: #1b1b32;
    margin: 0;
    padding: 0;
    color: #f0f0f0;
}

.container {
    width: 80%;
    margin: 0 auto;
    text-align: center;
    background-color: #1b1b32; /* Same background color as body */
    color: #f0f0f0; /* Text color */
    padding: 20px; /* Adding padding to separate content from edges */
}

h1 {
    margin-top: 50px;
}

.menu {
    margin-top: 50px;
}

.menu ul {
    list-style-type: none;
    padding: 0;
}

.menu ul li {
    display: inline-block;
    margin-right: 20px;
    color:#f0f0f0;
}

.menu ul li a {
    text-decoration: none;
    color: #ccc;
    padding: 5px 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.menu ul li a:hover {
    background-color: #f0f0f0;
}

.content {
    margin-top: 50px;
    text-align: left;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Bank Staff Dashboard</h1>
        <div class="menu">
            <ul>
                <li><a href="transaction.php">Transactions</a></li>
                <li><a href="op_acc.php">Open New Account</a></li>
                <li><a href="show_detail.php">Show Account Info</a></li>
                <li><a href="account.php">Show Account Balance </a></li>
                <li><a href="delete.php">Delete Account</a></li>
                <li><a href="addstaff.php">Add Staff Account</a></li>
                <li><a href="logout.php">Logout</a></li> <!-- Assuming the logout page is named logout.php -->
            </ul>
        </div>

        <?php
        if (isset($_GET['section'])) {
            $section = $_GET['section'];
            switch ($section) {
                case 'transactions':
                    echo "<div class='content'>
                            <h2>Transactions</h2>
                            <p>View and manage transactions here.</p>
                        </div>";
                    break;
                case 'open_account':
                    echo "<div class='content'>
                            <h2>Open New Account</h2>
                            <p>Open a new account for a customer.</p>
                        </div>";
                    break;
                case 'edit_account':
                    echo "<div class='content'>
                            <h2>Edit Account Info</h2>
                            <p>Edit account information for customers.</p>
                        </div>";
                    break;
                case 'delete_account':
                    echo "<div class='content'>
                            <h2>Delete Account</h2>
                            <p>Delete accounts of customers.</p>
                        </div>";
                    break;
                default:
                    echo "<div class='content'>
                            <p>Invalid section.</p>
                        </div>";
                    break;
            }
        }
        ?>
    </div>
</body>
</html>
