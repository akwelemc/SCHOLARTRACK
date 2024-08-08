<?php
require_once("../settings/connection.php");

function getCourseOptions() {
    global $pdo; // Use the PDO instance defined in the required file

    $sql = "SELECT name FROM courses";
    $stmt = $pdo->query($sql);

    if (!$stmt) {
        die("Error fetching courses: " . $pdo->errorInfo()[2]);
    }

    $dropdown_options = "";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $name = $row["name"];
        $dropdown_options .= "<option value='$name'>$name</option>";
    }

    return $dropdown_options;
}

function getCourseList() {
    global $pdo;

    $sql = "
        SELECT c.id, c.name, c.credits, c.status, 
               GROUP_CONCAT(p.prerequisite_id) AS prerequisites
        FROM courses c
        LEFT JOIN course_prerequisites p ON c.id = p.course_id
        GROUP BY c.id
    ";
    $stmt = $pdo->query($sql);

    if (!$stmt) {
        die("Error fetching course list: " . $pdo->errorInfo()[2]);
    }

    $courseListItems = "";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $courseID = $row['id'];
        $courseName = $row['name'];
        $credits = $row['credits'];
        $status = $row['status'];
        $prerequisites = $row['prerequisites'] ? explode(',', $row['prerequisites']) : [];

        // Generate the HTML for each course item
        $courseListItems .= "
            <li id='$courseID' data-status='$status' data-prerequisites='" . json_encode($prerequisites) . "'>
                <label>$courseName ($credits credits)</label>
                <button onclick=\"selectCourse('$courseID', '$courseName', '$credits')\">Select</button>
            </li>";
    }

    return $courseListItems;
}
?>
