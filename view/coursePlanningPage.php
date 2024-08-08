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
                        <?php echo getCourseList(); ?>
                    </ul>
                </div>
                <div class="selected-courses">
                    <h3>Selected Courses</h3>
                    <ul id="selectedCourses">
                        <!-- List selected courses here -->
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
