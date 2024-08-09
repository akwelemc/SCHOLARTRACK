<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Grade Calculator</title>
    <link rel="stylesheet" href="../css/gpa_calc.css"> <!-- Link to your CSS file -->
    <script src="../js/course_grade_calculator.js" defer></script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../images/Byte_Me_Logo.png" alt="Logo" class="header-logo">
            <span>Student Portal</span>
        </div>
        <nav>
            <ul>
                <li><a href="../view/dashboard.php">Go back</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Course Grade Calculator</h1>
        
        <div>
            <h2>Calculate Grade for a Specific Course</h2>
            <form id="course-grade-form">
                <!-- Course Name Input -->
                <div class="form-group">
                    <label for="course-name">Course Name:</label>
                    <input type="text" id="course-name" name="course_name" placeholder="Enter Course Name" required>
                </div>
                
                <!-- Assignments Section -->
                <div id="assignments-container">
                    <div class="assignment">
                        <input type="text" name="assignment_name[]" placeholder="Assignment Name" required>
                        <input type="number" name="assignment_received[]" placeholder="Grade Received" min="0" max="100" required>
                        <input type="number" name="assignment_total[]" placeholder="Total Grade" min="0" max="100" required>
                        <input type="number" name="assignment_weight[]" placeholder="Weight (%)" min="0" max="100" required>
                        <button type="button" onclick="removeAssignment(this)">Remove</button>
                    </div>
                </div>
                
                <!-- Buttons -->
                <button type="button" onclick="addAssignment()">Add Another Assignment</button>
                <button type="submit">Calculate Course Grade</button>
            </form>
            
            <!-- Error Message Container -->
            <div id="error-message" style="color: red; display: none;">
                Total weights must add up to 100%.
            </div>
            
            <p id="course-grade">Course Grade: N/A</p>
        </div>
    </div>
</body>
</html>
