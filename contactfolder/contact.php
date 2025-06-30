
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sust_contact";  // ✅ Correct database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$sql = "INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $subject, $message);

if ($stmt->execute()) {
    echo "✅ Message sent successfully!";
} else {
    echo "❌ Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>
