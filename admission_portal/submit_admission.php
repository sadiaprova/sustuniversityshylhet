<?php
// Show all errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "sust_admission");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form values
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$department = $_POST['department'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$address = $_POST['address'];

// Insert into database
$sql = "INSERT INTO students (full_name, email, phone, department, dob, gender, address)
        VALUES ('$full_name', '$email', '$phone', '$department', '$dob', '$gender', '$address')";

if ($conn->query($sql) === TRUE) {
    echo "<h2 style='color: green; text-align: center;'>✔️ Admission Submitted Successfully!</h2>";
} else {
    echo "<h2 style='color: red; text-align: center;'>❌ Error: " . $conn->error . "</h2>";
}

$conn->close();
?>
