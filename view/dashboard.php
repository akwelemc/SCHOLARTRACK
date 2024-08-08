<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/login.php');
    exit();
}

include '../settings/connection.php';

try {
    $sql = "SELECT first_name, last_name, student_id, class, dob, email FROM students WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':user_id' => $_SESSION['user_id']]);
    $user = $stmt->fetch();

    if ($user) {
        $name = $user['first_name'] . ' ' . $user['last_name'];
        $student_id = $user['student_id'];
        $class = $user['class'];
        $email = $user['email'];
        $graduation_year = "July " . intval($class);
    } else {
        echo "User not found.";
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="../images/Byte_Me_Logo.png" alt="Logo" class="header-logo">
            <span>Student Portal</span>
        </div>
        <nav>
            <ul>
                <li><a href="../view/degree_audit.php">Degree Audit</a></li>
                <li><a href="../career/careerRec.php">Career Recommendations</a></li>
                <li><a href="../view/coursePlanningPage.php">Course Planning</a></li>
                <li><a href="../view/personalPlanner.php">Personal Planner</a></li>
                <li><a href="../action/logout.php" class="donate-btn">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="hero">
        <h1>Welcome, <?php echo htmlspecialchars($name); ?>!</h1>
        <p>Student ID: <?php echo htmlspecialchars($student_id); ?></p>
        <p>Class Year: <?php echo htmlspecialchars($class); ?></p>
        <p>Expected Graduation Year: <?php echo htmlspecialchars($graduation_year); ?></p>
        <p>Your email: <?php echo htmlspecialchars($email); ?></p>
    </div>

    <footer>
        <p>&copy; 2024 Scholar Track. All rights reserved.</p>
    </footer>
</body>
</html>
