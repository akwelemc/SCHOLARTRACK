<?php
session_start();
include 'db_connection.php';

$user_id = $_SESSION['user_id'];
$day_of_week = $_POST['day_of_week'];
$time_slot = $_POST['time_slot'];
$activity = $_POST['activity'];
$time = $_POST['time'];

$sql = "INSERT INTO user_activities (user_id, day_of_week, time_slot, activity, time)
        VALUES ('$user_id', '$day_of_week', '$time_slot', '$activity', '$time')
        ON DUPLICATE KEY UPDATE activity='$activity', time='$time'";

if ($conn->query($sql) === TRUE) {
    echo "Activity saved successfully";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
