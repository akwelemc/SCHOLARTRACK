<?php
session_start();
include 'db_connection.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT day_of_week, time_slot, activity, time FROM user_activities WHERE user_id='$user_id'";
$result = $conn->query($sql);

$activities = array();
while($row = $result->fetch_assoc()) {
    $activities[] = $row;
}

echo json_encode($activities);
$conn->close();
?>
