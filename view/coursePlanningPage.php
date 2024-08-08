<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Planning - ScholarTrack</title>
    <link rel="stylesheet" href="../css/coursePlanning.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="../images/scholaremoji.png" alt="ScholarTrack Logo">
            <span>ScholarTrack</span>
        </div>
        <nav>
            <ul>
                <li><a href="../view/dashboard.php">Return to Dashboard</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="course-planning">
            <h1>Course Planning</h1>
            <p>Select courses for the upcoming semester based on your degree requirements.</p>
            <div class="planning-container">
                <div class="course-list">
                    <h3>Available Courses</h3>
                    <ul id="availableCourses">
                        <li id="course1" data-credits="3.0" data-status="available" data-prerequisites="[]">Introduction to Programming (3.0 credits)</li>
                        <li id="course2" data-credits="4.0" data-status="available" data-prerequisites="[1]">Data Structures (4.0 credits)</li>
                        <li id="course3" data-credits="3.0" data-status="available" data-prerequisites="[1]">Algorithms (3.0 credits)</li>
                        <li id="course4" data-credits="2.5" data-status="available" data-prerequisites="[]">Discrete Mathematics (2.5 credits)</li>
                        <li id="course5" data-credits="3.5" data-status="available" data-prerequisites="[2, 3]">Operating Systems (3.5 credits)</li>
                    </ul>
                </div>
                <div class="selected-courses">
                    <h3>Selected Courses</h3>
                    <ul id="selectedCourses">
                    </ul>
                </div>
            </div>
            <button class="submit-btn" onclick="submitCoursePlan()">Submit Course Plan</button>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 ScholarTrack. All rights reserved.</p>
    </footer>

    <script src="../js/coursePlanning.js"></script>
</body>
</html>
