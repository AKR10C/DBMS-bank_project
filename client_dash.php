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
    <title> Customer Dashboard</title>
    <link rel="stylesheet" href="dgin.css" />
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
        <h1>Welcome to the Bank Customer Dashboard</h1>
        <div class="menu">
            <ul>
                <li><a href="account.php">Accounts</a></li>
                <li><a href="?section=transactions">Transactions</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <?php
        include_once 'db_conn.php';
        // Handle sections
        if (isset($_GET['section'])) {
            $section = $_GET['section'];
            switch ($section) {
                case 'accounts':
                    echo "<div id='accounts' class='content'>
                            <h2>Accounts</h2>
                            <p>List of your accounts goes here...</p>
                        </div>";
                    break;
                case 'transactions':
                    echo "<div id='transactions' class='content'>
                            <h2>Transactions</h2>
                            <p>List of your transactions goes here...</p>
                        </div>";
                    break;
                case 'profile':
                    echo "<div id='profile' class='content'>
                            <h2>Profile</h2>
                                </form>
                            </div>
                        </div>";
                    break;
                case 'logout':
                    echo "<div id='logout' class='content'>
                            <h2>Logout</h2>
                            <p>Logout link or button goes here...</p>
                        </div>";
                    break;
                default:
                    echo "<p>Invalid section.</p>";
                    break;
            }
        }
        ?>
    </div>
</body>
</html>
