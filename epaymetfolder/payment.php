<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sust_epayment";

// Connect to DB
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get and sanitize form data
$name = htmlspecialchars($_POST['student_name']);
$student_id = htmlspecialchars($_POST['student_id']);
$amount = floatval($_POST['amount']);
$method = htmlspecialchars($_POST['method']);
$transaction_id = htmlspecialchars($_POST['transaction_id']);
// Insert into table
$sql = "INSERT INTO payments (student_name, student_id, amount, method, transaction_id) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdss", $name, $student_id, $amount, $method, $transaction_id);

if ($stmt->execute()) {
    echo "✅ Payment received successfully!";
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
