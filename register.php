<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "radio";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'] ?? '';  
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$password = $_POST['password'] ?? '';

// Hash the password before storing it
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO fix1 (name, email, phone, password) VALUES (?, ?, ?, ?)");

if ($stmt) {
    $stmt->bind_param("ssss", $name, $email, $phone, $hashed_password); // Bind parameters correctly

    if ($stmt->execute()) {
        echo "Data inserted successfully!<br>";
        echo header("Location:login.html");
    } else {
        echo "Error executing statement: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

$conn->close();
?>