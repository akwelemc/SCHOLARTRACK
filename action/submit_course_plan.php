<?php
require_once("../settings/connection.php");

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Retrieve POST data
    $data = json_decode(file_get_contents('php://input'), true);

    // Collect data from JSON
    $user_id = isset($data['user_id']) ? $data['user_id'] : null;
    $courses = isset($data['courses']) ? $data['courses'] : [];

    if ($user_id === null || empty($courses)) {
        echo json_encode(['success' => false, 'error' => 'Invalid input data']);
        exit;
    }

    try {
        $pdo->beginTransaction();

        // Insert into `course_plans` table
        $stmt = $pdo->prepare("INSERT INTO course_plans (user_id) VALUES (?)");
        $stmt->execute([$user_id]);
        $plan_id = $pdo->lastInsertId(); // Get the last inserted plan_id

        // Insert into `course_plan_courses` table
        $stmt = $pdo->prepare("INSERT INTO course_plan_courses (plan_id, course_id) VALUES (?, ?)");

        foreach ($courses as $course) {
            $course_id = $course['courseID'];
            $stmt->execute([$plan_id, $course_id]);
        }

        $pdo->commit();

        echo json_encode(['success' => true]);

    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    // Not a POST request
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
