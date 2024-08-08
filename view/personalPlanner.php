<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Planner - ScholarTrack</title>
    
    <link rel="stylesheet" href="../css/personalPlanner.css">
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
        <div class="quotes-box">
            <p id="quote-text">Your motivational quote will appear here...</p>
        </div>
    
        <section class="planner">
            <h1>Personal Planner</h1>
            <div class="timetable">
                <table>
                    <thead>
                        <tr>
                            <th>Time</th> 
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                            <th>Saturday</th>
                            <th>Sunday</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <tr>
                            <td contenteditable="true" class="time-slot"></td> 
                            <td class="activity-slot" data-day="Monday" data-slot="1"></td>
                            <td class="activity-slot" data-day="Tuesday" data-slot="1"></td>
                            <td class="activity-slot" data-day="Wednesday" data-slot="1"></td>
                            <td class="activity-slot" data-day="Thursday" data-slot="1"></td>
                            <td class="activity-slot" data-day="Friday" data-slot="1"></td>
                            <td class="activity-slot" data-day="Saturday" data-slot="1"></td>
                            <td class="activity-slot" data-day="Sunday" data-slot="1"></td>
                        </tr>
                        <tr>
                            <td contenteditable="true" class="time-slot"></td>
                            <td class="activity-slot" data-day="Monday" data-slot="2"></td>
                            <td class="activity-slot" data-day="Tuesday" data-slot="2"></td>
                            <td class="activity-slot" data-day="Wednesday" data-slot="2"></td>
                            <td class="activity-slot" data-day="Thursday" data-slot="2"></td>
                            <td class="activity-slot" data-day="Friday" data-slot="2"></td>
                            <td class="activity-slot" data-day="Saturday" data-slot="2"></td>
                            <td class="activity-slot" data-day="Sunday" data-slot="2"></td>
                        </tr>
                        <tr>
                            <td contenteditable="true" class="time-slot"></td>
                            <td class="activity-slot" data-day="Monday" data-slot="3"></td>
                            <td class="activity-slot" data-day="Tuesday" data-slot="3"></td>
                            <td class="activity-slot" data-day="Wednesday" data-slot="3"></td>
                            <td class="activity-slot" data-day="Thursday" data-slot="3"></td>
                            <td class="activity-slot" data-day="Friday" data-slot="3"></td>
                            <td class="activity-slot" data-day="Saturday" data-slot="3"></td>
                            <td class="activity-slot" data-day="Sunday" data-slot="3"></td>
                        </tr>
                        <tr>
                            <td contenteditable="true" class="time-slot"></td>
                            <td class="activity-slot" data-day="Monday" data-slot="4"></td>
                            <td class="activity-slot" data-day="Tuesday" data-slot="4"></td>
                            <td class="activity-slot" data-day="Wednesday" data-slot="4"></td>
                            <td class="activity-slot" data-day="Thursday" data-slot="4"></td>
                            <td class="activity-slot" data-day="Friday" data-slot="4"></td>
                            <td class="activity-slot" data-day="Saturday" data-slot="4"></td>
                            <td class="activity-slot" data-day="Sunday" data-slot="4"></td>
                        </tr>
                        <tr>
                            <td contenteditable="true" class="time-slot"></td>
                            <td class="activity-slot" data-day="Monday" data-slot="5"></td>
                            <td class="activity-slot" data-day="Tuesday" data-slot="5"></td>
                            <td class="activity-slot" data-day="Wednesday" data-slot="5"></td>
                            <td class="activity-slot" data-day="Thursday" data-slot="5"></td>
                            <td class="activity-slot" data-day="Friday" data-slot="5"></td>
                            <td class="activity-slot" data-day="Saturday" data-slot="5"></td>
                            <td class="activity-slot" data-day="Sunday" data-slot="5"></td>
                        </tr>
                        <tr>
                            <td contenteditable="true" class="time-slot"></td>
                            <td class="activity-slot" data-day="Monday" data-slot="6"></td>
                            <td class="activity-slot" data-day="Tuesday" data-slot="6"></td>
                            <td class="activity-slot" data-day="Wednesday" data-slot="6"></td>
                            <td class="activity-slot" data-day="Thursday" data-slot="6"></td>
                            <td class="activity-slot" data-day="Friday" data-slot="6"></td>
                            <td class="activity-slot" data-day="Saturday" data-slot="6"></td>
                            <td class="activity-slot" data-day="Sunday" data-slot="6"></td>
                        </tr>
                        <tr>
                            <td contenteditable="true" class="time-slot"></td>
                            <td class="activity-slot" data-day="Monday" data-slot="7"></td>
                            <td class="activity-slot" data-day="Tuesday" data-slot="7"></td>
                            <td class="activity-slot" data-day="Wednesday" data-slot="7"></td>
                            <td class="activity-slot" data-day="Thursday" data-slot="7"></td>
                            <td class="activity-slot" data-day="Friday" data-slot="7"></td>
                            <td class="activity-slot" data-day="Saturday" data-slot="7"></td>
                            <td class="activity-slot" data-day="Sunday" data-slot="7"></td>
                        </tr>
                        <tr>
                            <td contenteditable="true" class="time-slot"></td>
                            <td class="activity-slot" data-day="Monday" data-slot="8"></td>
                            <td class="activity-slot" data-day="Tuesday" data-slot="8"></td>
                            <td class="activity-slot" data-day="Wednesday" data-slot="8"></td>
                            <td class="activity-slot" data-day="Thursday" data-slot="8"></td>
                            <td class="activity-slot" data-day="Friday" data-slot="8"></td>
                            <td class="activity-slot" data-day="Saturday" data-slot="8"></td>
                            <td class="activity-slot" data-day="Sunday" data-slot="8"></td>
                        </tr>
                        <tr>
                            <td contenteditable="true" class="time-slot"></td>
                            <td class="activity-slot" data-day="Monday" data-slot="9"></td>
                            <td class="activity-slot" data-day="Tuesday" data-slot="9"></td>
                            <td class="activity-slot" data-day="Wednesday" data-slot="9"></td>
                            <td class="activity-slot" data-day="Thursday" data-slot="9"></td>
                            <td class="activity-slot" data-day="Friday" data-slot="9"></td>
                            <td class="activity-slot" data-day="Saturday" data-slot="9"></td>
                            <td class="activity-slot" data-day="Sunday" data-slot="9"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 ScholarTrack. All rights reserved.</p>
    </footer>
    <script src="../js/personalPlanner.js"></script>
</body>
</html>
