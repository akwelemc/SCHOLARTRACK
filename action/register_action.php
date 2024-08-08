<?php
include '../settings/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $student_id = $_POST['student_id'];
    $class = $_POST['class'];
    $major = 'Computer Science'; // Default major
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    try {
        $sql = "INSERT INTO students (first_name, last_name, student_id, class, major, gender, dob, email, password)
                VALUES (:first_name, :last_name, :student_id, :class, :major, :gender, :dob, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':student_id' => $student_id,
            ':class' => $class,
            ':major' => $major,
            ':gender' => $gender,
            ':dob' => $dob,
            ':email' => $email,
            ':password' => $password,
        ]);

        // Redirect to login page after successful registration
        header('Location: ../login/login.php');
        exit(); // Ensure no further code is executed
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "Error: The student ID or email is already registered.";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
