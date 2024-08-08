<?php
include '../settings/connection.php';

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$status = $data['status'];
$completedWhen = $data['completedWhen'];
$grade = $data['grade'];

$sql = "UPDATE courses SET status = :status, completedWhen = :completedWhen, grade = :grade WHERE id = :id";
$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':id' => $id,
    ':status' => $status,
    ':completedWhen' => $completedWhen,
    ':grade' => $grade,
]);

echo json_encode(['success' => true]);
?>
