<?php
include '../settings/connection.php';

header('Content-Type: application/json');

$sql = "SELECT * FROM courses"; // Modify based on your criteria
$stmt = $pdo->query($sql);

$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($courses);
?>
