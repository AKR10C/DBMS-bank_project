<?php
// Assuming you have already connected to your database using mysqli or PDO

// Collect form data
$firstname = isset($_POST['Firstname']) ? $_POST['Firstname'] : '';
$lastname = isset($_POST['Lastname']) ? $_POST['Lastname'] : '';
$dateOfBirth = isset($_POST['DateOfBirth']) ? $_POST['DateOfBirth'] : '';
$address = isset($_POST['Address']) ? $_POST['Address'] : '';
$username = isset($_POST['Username']) ? $_POST['Username'] : '';
$password = isset($_POST['Password']) ? $_POST['Password'] : '';

// Add more fields as needed

// Validate data (Example validation, you should implement more robust validation)
if (empty($Firstname) || empty($Lastname) || empty($DateOfBirth) || empty($Address) || empty($Phone) || empty($Username) || empty($Password)) {
    // Hande validation error, redirect back to the registration form or display an error message
    echo "All fields are required.";
    exit;
}

// Hash the password (for security)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert data into the database
$query = "INSERT INTO Customers (Firstname, Lastname, DateOfBirth, Address, Phone, Username, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($quey);
$stmt->bind_param("sss", $Firstname, $Lastname, $DateOfBirth, $Address, $Phone, $Username, $hashed_password);
$stmt->execute();

// Check if the insertion was successful
if ($stmt->affected_rows == 1) {
    // Registration successful, redirect the user to a success page or login page
    echo "Registration successful!";
} else {
    // Handle insertion error
    echo "Error occurred while registering. Please try again.";
}

// Close statement and connection
$stmt->close();
$mysqli->close();