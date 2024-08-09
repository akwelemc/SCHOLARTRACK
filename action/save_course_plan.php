<?php
// Include database connection file
include '../settings/connection.php';

// Ensure error reporting is enabled for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Get the user ID from the session or request (simulate for testing)
session_start();
$userId = $_SESSION['user_id'] ?? 1; // Adjust this as needed

// Get the course IDs from the POST request
if (isset($_POST['course_ids']) && is_array(json_decode($_POST['course_ids'], true))) {
    $courseIds = json_decode($_POST['course_ids'], true);
} else {
    echo 'Invalid course IDs.';
    exit;
}

if (empty($courseIds)) {
    echo 'No courses selected.';
    exit;
}

try {
    // Start a transaction
    $pdo->beginTransaction();

    // Insert a new course plan record
    $stmt = $pdo->prepare("INSERT INTO course_plans (user_id) VALUES (?)");
    $stmt->execute([$userId]);
    $planId = $pdo->lastInsertId();

    // Insert each selected course into the course_plan_courses table
    $stmt = $pdo->prepare("INSERT INTO course_plan_courses (plan_id, course_id) VALUES (?, ?)");
    foreach ($courseIds as $courseId) {
        $stmt->execute([$planId, $courseId]);
    }

    // Commit the transaction
    $pdo->commit();
    echo 'Course plan submitted successfully.';
} catch (Exception $e) {
    // Rollback the transaction in case of error
    $pdo->rollBack();
    echo 'Error submitting course plan: ' . $e->getMessage();
}
?>


