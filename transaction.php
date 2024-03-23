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
    <title>Transaction Page</title>
    <link rel="stylesheet" href="dgin.css" />
    <style>
         h2 {
            margin: 1em auto;
             text-align: center;
        }
    </style>
</head>
<body>
    <h1>Transaction Page</h1>
    
    <!-- Deposit Form -->
    <h2>Deposit</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="hidden" name="action" value="deposit">
        <label for="deposit_account">Account ID:</label>
        <input type="text" id="deposit_account" name="account" required><br>
        <label for="deposit_amount">Amount:</label>
        <input type="number" id="deposit_amount" name="amount" required><br>
        <button type="submit" name="deposit">Deposit</button>
    </form>
    
    <!-- Withdraw Form -->
    <h2>Withdraw</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="hidden" name="action" value="withdraw">
        <label for="withdraw_account">Account ID:</label>
        <input type="text" id="withdraw_account" name="account" required><br>
        <label for="withdraw_amount">Amount:</label>
        <input type="number" id="withdraw_amount" name="amount" required><br>
        <button type="submit" name="withdraw">Withdraw</button>
    </form>

<?php
include 'db_conn.php';

if(isset($_POST['action'])) {
    $action = $_POST['action'];

    if($action === 'deposit') {
        $AccountID = $_POST['account'];
        $amount = $_POST['amount'];

        // Validate input (you can add more validation as needed)
        if(empty($AccountID) || empty($amount)) {
            $_SESSION['error'] = "Please fill in all fields.";
            header("location: {$_SERVER['PHP_SELF']}");
            exit();
        }

        // Check if account exists
        $sql = "SELECT * FROM accounts WHERE AccountID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $AccountID);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check for query execution errors
        if (!$result) {
            $_SESSION['error'] = "Query failed: " . $conn->error;
            header("location: {$_SERVER['PHP_SELF']}");
            exit();
        }

        // Check if any rows were returned
        if($result->num_rows == 0) {
            $_SESSION['error'] = "Account not found.";
            header("location: {$_SERVER['PHP_SELF']}");
            exit();
        }

        // Perform deposit
        $row = $result->fetch_assoc();
        $balance = $row['Balance'];
        $new_balance = $balance + $amount;

        // Update balance
        $update_sql = "UPDATE accounts SET Balance = ? WHERE AccountID = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("di", $new_balance, $AccountID);
        $stmt->execute();

        $_SESSION['success'] = "Deposit successful. New balance: $new_balance";
        header("location: {$_SERVER['PHP_SELF']}");
        exit();
        
    } elseif($action === 'withdraw') {
        $AccountID = $_POST['account'];
        $amount = $_POST['amount'];

        // Validate input (you can add more validation as needed)
        if(empty($AccountID) || empty($amount)) {
            $_SESSION['error'] = "Please fill in all fields.";
            header("location: {$_SERVER['PHP_SELF']}");
            exit();
        }

        // Check if account exists
        $sql = "SELECT * FROM accounts WHERE AccountID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $AccountID);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check for query execution errors
        if (!$result) {
            $_SESSION['error'] = "Query failed: " . $conn->error;
            header("location: {$_SERVER['PHP_SELF']}");
            exit();
        }

        // Check if any rows were returned
        if($result->num_rows == 0) {
            $_SESSION['error'] = "Account not found.";
            header("location: {$_SERVER['PHP_SELF']}");
            exit();
        }

        // Perform withdrawal
        $row = $result->fetch_assoc();
        $balance = $row['Balance'];
        if($balance < $amount) {
            $_SESSION['error'] = "Insufficient balance.";
            header("location: {$_SERVER['PHP_SELF']}");
            exit();
        }
        $new_balance = $balance - $amount;

        // Update balance
        $update_sql = "UPDATE accounts SET Balance = ? WHERE AccountID = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("di", $new_balance, $AccountID);
        $stmt->execute();

        $_SESSION['success'] = "Withdrawal successful. New balance: $new_balance";
        header("location: {$_SERVER['PHP_SELF']}");
        exit();
        
    } else {
        $_SESSION['error'] = "Invalid action.";
        header("location: {$_SERVER['PHP_SELF']}");
        exit();
    }
}
?>
</body>
</html>
