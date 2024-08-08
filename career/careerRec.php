<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Recommendation System</title>
    <link rel="stylesheet" href="../css/careerRec.css">
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
    <div class="container">
        <h1>Career Recommendations</h1>
        <section class="chatbox">
            <div id="conversation" class="conversation"></div>
            <input type="text" id="answer" placeholder="Type your answer here...">
            <button id="submit">Submit</button>
        </section>
    </div>
    <script src="../js/chat.js"></script>
</body>
</html>
