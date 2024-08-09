<?php
include 'db_connection.php'; // Include your database connection script

// Get user ID from session or request
$user_id = $_SESSION['user_id']; // or $_GET['user_id'] if passed as a query parameter

// Fetch completed courses for the user
$query = "
    SELECT c.credits, c.grade
    FROM courses c
    JOIN course_plan_courses cpc ON c.id = cpc.course_id
    JOIN course_plans cp ON cpc.plan_id = cp.plan_id
    WHERE cp.user_id = ? AND c.status = 'Completed'
";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$grades = [];
while ($row = $result->fetch_assoc()) {
    $grades[] = $row;
}

header('Content-Type: application/json');
echo json_encode($grades);

$stmt->close();
$conn->close();
?>
