<?php
session_set_cookie_params(0);

$_SESSION = array();

// Start the session
session_start();


include_once 'db_conn.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $input_username = $_POST["username"];
    $input_password = $_POST["password"];

    // Query to check if the username and password match in the database
    $query = "SELECT * FROM customers WHERE Username=? AND Password=?";
    if ($stmt = $conn->prepare($query)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ss", $input_username, $input_password);
        
        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Store result
            $stmt->store_result();
            
            // Check if username and password exist, then fetch the user
            if ($stmt->num_rows == 1) {
                // Username and password are correct
                $_SESSION['logged_user'] = $input_username;
                $_SESSION['user_type'] = "customer";
                // Redirect to the staff dashboard
                header("Location: client_dash.php");
                exit();
            } 
            else {
                // Username or password is incorrect, show error message or redirect back to login page
                echo "Incorrect details, try again.";
                // exit();
            }
        } 
        else {
            echo "Oops! Something went wrong. Please try again later.";
        }
        
        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Login - ABank</title>
    <style>
        /* Basic CSS for styling */
        body {
            width: 100%;
            height: 100vh;
            margin: 0;
            background-color: #1b1b32;
            color: #f5f6f7;
            font-family: Tahoma;
            font-size: 16px;
        }

        h2,
        h1,
        p {
            margin: 1em auto;
            text-align: center;
        }

        form {
            width: 60vw;
            max-width: 500px;
            min-width: 300px;
            margin: 0 auto;
            padding-bottom: 2em;
        }

        fieldset {
            border: none;
            padding: 2rem 0;
            border-bottom: 3px solid #3b3b4f;
        }

        fieldset:last-of-type {
            border-bottom: none;
        }

        label {
            display: block;
            margin: 0.5rem 0;
        }

        input,
        textarea,
        select {
            margin: 10px 0 0 0;
            width: 100%;
            min-height: 2em;
        }

        input,
        textarea {
            background-color: #0a0a23;
            border: 1px solid #0a0a23;
            color: #ffffff;
        }

        .inline {
            width: unset;
            margin: 0 0.5em 0 0;
            vertical-align: middle;
        }

        input[type="submit"] {
            display: block;
            width: 60%;
            margin: 1em auto;
            height: 2em;
            font-size: 1.1rem;
            background-color: #3b3b4f;
            border-color: white;
            min-width: 300px;
        }

        .btn-submit {
            width: 60%;
            margin: 1em auto;
            /* Center align the button */
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        input[type="file"] {
            padding: 1px 2px;
        }

        .inline {
            display: inline;
        }

        .a {
            color: #dfdfe2;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Customer Login</h2>
        <form action="client.php" method="post">
            <div class="form-group">
                <label for="username">username <input id="username" name="username" type="text" required /></label>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-submit">Login</button>
        </form>
    </div>
</body>

</html>
