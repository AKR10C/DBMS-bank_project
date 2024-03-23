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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $firstname = isset($_POST['Firstnmae']) ? $_POST['Firstnmae'] : '';
    $lastname = isset($_POST['Lastname']) ? $_POST['Lastname'] : '';
    $Position = isset($_POST['Position']) ? $_POST['Position'] : '';
    $username = isset($_POST['Username']) ? $_POST['Username'] : '';
    $password = isset($_POST['new-password']) ? $_POST['new-password'] : '';

    // Validate data (Example validation, you should implement more robust validation)
    if (empty($firstname) || empty($lastname) || empty($Position) ||  empty($username) || empty($password)) {
        // Handle validation error, redirect back to the registration form or display an error message
        echo "All fields are required.";
        exit;
    }

    // Insert data into the database
    $query = "INSERT INTO bankstaff (Firstname, Lastname, Position,  Username, password) VALUES (?, ?, ?,  ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $firstname, $lastname, $Position,  $username, $password); // Inserting password as plaintext
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows == 1) {
        // Registration successful, redirect the user to a success page or login page
        echo "Registration successful!";
        header("Location: staff_dash.php");
        exit();
    } else {
        // Handle insertion error
        echo "Error occurred while registering. Please try again.";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>create a new staff</title>
    <link rel="stylesheet" href="dgin.css"/>
</head>
<body>
<h1>Add a New Staffid</h1>
<p>Please fill out this form with the required information</p>
<form method="post" action="">
    <fieldset>
        <label for="Firstnmae">Enter Your First Name: <input id="Firstnmae" name="Firstnmae" type="text"
                                                              required/></label>
        <label for="Lastname">Enter Your Last Name: <input id="Lastname" name="Lastname" type="text" required/></label>
        <label for="Position">Enter Your Position <input id="Position" name="Position" type="text"
                                                                  required/></label>
        

        <label for="Username">Create a Username: <input id="Username" name="Username" type="Username" required/>
        </label>
        <label for="new-password">Create a New Password: <input id="new-password" name="new-password"
                                                                  type="password" required/></label>
    </fieldset>
    <input type="submit" value="Submit"/>
</form>
</body>
</html>
