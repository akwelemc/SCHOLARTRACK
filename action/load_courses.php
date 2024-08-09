<?php
session_start();
include '../settings/connection.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(403); // Forbidden
    echo 'Unauthorized';
    exit();
}

try {
    $sql = "SELECT * FROM courses";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($courses);
} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    echo 'Error: ' . $e->getMessage();
}
?>
