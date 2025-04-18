<?php
$conn = new mysqli("localhost", "root", "", "attendance_db");
if ($conn->connect_error) die("DB connection failed");

$result = $conn->query("SELECT * FROM attendance");

$events = [];
while ($row = $result->fetch_assoc()) {
    $color = match ($row['status']) {
        'Present' => 'green',
        'Absent' => 'red',
        'Casual Leave' => 'orange',
        'OnDuty' => 'blue',
        'Holiday' => 'purple',
        'Invalid Swipe' => 'gray',
        default => 'black'
    };

    $events[] = [
        'title' => " ({$row['status']})",
        'start' => $row['date'],
        'color' => $color
    ];
}

header('Content-Type: application/json');
echo json_encode($events);
?>
