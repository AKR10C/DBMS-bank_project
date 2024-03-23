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
    $dateOfBirth = isset($_POST['DateOfBirth']) ? $_POST['DateOfBirth'] : '';
    $address = isset($_POST['Address']) ? $_POST['Address'] : '';
    $phone = isset($_POST['Phone']) ? $_POST['Phone'] : '';
    $username = isset($_POST['Username']) ? $_POST['Username'] : '';
    $password = isset($_POST['new-password']) ? $_POST['new-password'] : '';
    

    // Validate data (Example validation, you should implement more robust validation)
    if (empty($firstname) || empty($lastname) || empty($dateOfBirth) || empty($address) || empty($phone) || empty($username) || empty($password) ) {
        // Handle validation error, redirect back to the registration form or display an error message
        echo "All fields are required.";
        exit;
    }

    // Hash the password (for security)
    $hashed_password = $password;

    // Insert data into the database
    $query = "INSERT INTO Customers (Firstname, Lastname, DateOfBirth, Address, Phone, Username, password ) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssss", $firstname, $lastname, $dateOfBirth, $address, $phone, $username, $hashed_password );
    $stmt->execute();


    // Fetch the CustomerID for the given username
    $sql = "SELECT CustomerID FROM customers WHERE Username = '$username'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $customerID = $row['CustomerID'];


    $query = "INSERT INTO ACCOUNTS (CustomerID, Balance) VALUES(?, 0)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $customerID);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows == 1) {
        // Registration successful, redirect the user to a success page or login page
        echo "Registration successful!";
        header("Location: staff_dash.php");
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
    <title>Registration Form</title>
    <link rel="stylesheet" href="dgin.css"/>
</head>
<body>
<h1>Create a New Account</h1>
<p>Please fill out this form with the required information</p>
<form method="post" action="">
    <fieldset>
        <label for="Firstnmae">Enter Your First Name: <input id="Firstnmae" name="Firstnmae" type="text"
                                                              required/></label>
        <label for="Lastname">Enter Your Last Name: <input id="Lastname" name="Lastname" type="text" required/></label>
        <label for="DateOfBirth">Enter Your Date of Birth <input id="DateOfBirth" name="DateOfBirth" type="date"
                                                                  required/></label>
        <label for="Address">Enter Your Address <input id="Address" name="Address" type="Address" required/></label>
        <label for="Phone">Enter Your Phone <input id="Phone" name="Phone" type="tel" required/></label>
        <label for="Username">Create a Username: <input id="Username" name="Username" type="Username" required/>
        </label>
        <label for="new-password">Create a New Password: <input id="new-password" name="new-password"
                                                                  type="password" required/></label>
        
    </fieldset>
    <label for="terms-and-conditions">
        <input class="inline" id="terms-and-conditions" type="checkbox" required name="terms-and-conditions"/> I
        accept the <a href="https://www.freecodecamp.org/news/terms-of-service/">terms and conditions</a>
    </label>
    <input type="submit" value="Submit"/>
</form>
</body>
</html>
