<?php
$input = json_decode(file_get_contents("php://input"), true);

$conn = new mysqli("localhost", "root", "", "attendance_db");
if ($conn->connect_error) die("DB connection failed");

$date = $conn->real_escape_string($input['date']);
$status = $conn->real_escape_string($input['status']);

$sql = "INSERT INTO attendance (date, status) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $date, $status);
$stmt->execute();

echo json_encode(["success" => true]);
?>
