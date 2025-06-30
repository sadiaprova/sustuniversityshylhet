<?php
session_start();
$conn = new mysqli("localhost", "root", "", "sust_faculty_portal");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$emailOrId = $_POST['email'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM faculty_users WHERE (email='$emailOrId' OR faculty_id='$emailOrId') AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $_SESSION['faculty'] = $emailOrId;
    echo "<script>alert('Login successful!'); window.location.href='faculty_dashboard.html';</script>";
} else {
    echo "<script>alert('Invalid credentials.'); window.location.href='faculty_login.html';</script>";
}
?>
