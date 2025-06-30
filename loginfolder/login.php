<?php
session_start();
$conn = new mysqli("localhost", "root", "", "sust_portal");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $_SESSION['email'] = $email;
    echo "<script>alert('Login successful!'); window.location.href='dashboard.html';</script>";
} else {
    echo "<script>alert('Invalid email or password.'); window.location.href='login.html';</script>";
}
?>
