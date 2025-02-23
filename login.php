//login.php
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
$password = $_POST['password'] ?? '';

// Prepare SQL statement to fetch user details
$stmt = $conn->prepare("SELECT password FROM fix1 WHERE name = ?");
$stmt->bind_param("s", $name);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    // Verify the hashed password
    if (password_verify($password, $hashed_password)) {
        echo "Login successful!<br>";
        echo  header("Location:index.html");
    } else {
        echo header("Location:index.html");
    }
} else {
    echo header("Location:index.html");
}

$stmt->close();
$conn->close();

?>
