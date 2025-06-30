<?php
header("Content-Type: application/json");
$conn = new mysqli("localhost", "root", "", "sust_canteen");

$data = json_decode(file_get_contents("php://input"), true);
$studentId = $data['studentId'];
$orderItems = $data['order'];

$result = $conn->query("SELECT * FROM students WHERE student_id='$studentId'");
if ($result->num_rows == 0) {
    echo json_encode(["success" => false, "message" => "Student ID not found."]);
    exit();
}

$student = $result->fetch_assoc();
$total = array_sum(array_column($orderItems, "price"));

if ($student['balance'] < $total) {
    echo json_encode(["success" => false, "message" => "Insufficient balance."]);
    exit();
}

// Deduct balance
$conn->query("UPDATE students SET balance = balance - $total WHERE student_id='$studentId'");

// Store orders
foreach ($orderItems as $item) {
    $name = $item['name'];
    $price = $item['price'];
    $conn->query("INSERT INTO orders (student_id, item_name, price) VALUES ('$studentId', '$name', $price)");
}

echo json_encode(["success" => true]);
?>
