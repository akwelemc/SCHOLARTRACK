<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS Degree Audit</title>
    <link rel="stylesheet" href="../css/degree_audit.css">
</head>
<body>
    <div class="container">
        <h1>Computer Science Degree Audit</h1>

        <!-- Return to Dashboard Button -->
        <div class="return-dashboard">
            <a href="../view/dashboard.php" class="btn">Return to Dashboard</a>
        </div
        
        <div class="credit-summary">
            <p>Total Credits Taken: <span id="totalCredits">0</span></p>
            <p>Percentage Completed: <span id="percentCompleted">0%</span></p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Course Name</th>
                    <th>Credits</th>
                    <th>Status</th>
                    <th>Completed When</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody id="courseTable">
                <!-- Dynamic content will be inserted here by JavaScript -->
            </tbody>
        </table>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>
