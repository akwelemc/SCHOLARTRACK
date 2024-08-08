DROP DATABASE IF EXISTS degree_audit;
CREATE DATABASE degree_audit;
USE degree_audit;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    student_id VARCHAR(20) NOT NULL UNIQUE,
    class VARCHAR(50),
    major VARCHAR(100) DEFAULT 'Computer Science',
    gender ENUM('Male', 'Female', 'Other'),
    dob DATE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(255),
    name VARCHAR(255),
    credits DECIMAL(5,2),
    status ENUM('Completed', 'Enrolled', 'Not Yet Completed'),
    completedWhen VARCHAR(255),
    grade ENUM('A+', 'A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D+', 'D', 'E', 'F')
);

INSERT INTO courses (category, name, credits, status, completedWhen, grade) VALUES
('Humanities & Social Sciences', 'Written and Oral Communication', 0.5, 'Not Yet Completed', '', 'E'),
('Humanities & Social Sciences', 'Text & Meaning', 0.5, 'Not Yet Completed', '', 'E'),
('Humanities & Social Sciences', 'Leadership I', 0.5, 'Not Yet Completed', '', 'E'),
('Humanities & Social Sciences', 'Leadership II', 0.5, 'Not Yet Completed', '', 'E'),
('Humanities & Social Sciences', 'Leadership III', 0.5, 'Not Yet Completed', '', 'E'),
('Humanities & Social Sciences', 'Leadership IV', 0.5, 'Not Yet Completed', '', 'E'),
('Humanities & Social Sciences', 'Principles of Economics', 0.5, 'Not Yet Completed', '', 'E'),
('Business', 'Foundations of Design & Entrepreneurship I', 1.0, 'Not Yet Completed', '', 'E'),
('Business', 'Foundations of Design & Entrepreneurship II', 1.0, 'Not Yet Completed', '', 'E'),
('Business', 'Finance for Non-finance Majors', 1.0, 'Not Yet Completed', '', 'E'),
('Mathematics & Quantitative', 'Pre-Calculus I / Calculus I', 1.0, 'Not Yet Completed', '', 'E'),
('Mathematics & Quantitative', 'Pre-Calculus II / Calculus II', 1.0, 'Not Yet Completed', '', 'E'),
('Mathematics & Quantitative', 'Applied Calculus', 1.0, 'Not Yet Completed', '', 'E'),
('Mathematics & Quantitative', 'Statistics with Probability', 1.0, 'Not Yet Completed', '', 'E'),
('Mathematics & Quantitative', 'Linear Algebra', 1.0, 'Not Yet Completed', '', 'E'),
('Computing', 'Intro to Computing & IS', 1.0, 'Not Yet Completed', '', 'E'),
('Research Prep', 'Research Methods', 1.0, 'Not Yet Completed', '', 'E'),
('Non-major and Free Electives', 'Non-Major Elective Course 1', 1.0, 'Not Yet Completed', '', 'E'),
('Non-major and Free Electives', 'Non-Major Elective Course 2', 1.0, 'Not Yet Completed', '', 'E'),
('Major Required Courses', 'Computer Programming for CS', 1.0, 'Not Yet Completed', '', 'E'),
('Major Required Courses', 'Object Oriented Programming', 1.0, 'Not Yet Completed', '', 'E'),
('Major Required Courses', 'Discrete Structures and Theory', 1.0, 'Not Yet Completed', '', 'E'),
('Major Required Courses', 'Data Structures and Algorithms', 1.0, 'Not Yet Completed', '', 'E'),
('Major Required Courses', 'Database Systems', 1.0, 'Not Yet Completed', '', 'E'),
('Major Required Courses', 'Intermediate Computer Programming', 1.0, 'Not Yet Completed', '', 'E'),
('Major Required Courses', 'Introduction to AI', 1.0, 'Not Yet Completed', '', 'E'),
('Major Required Courses', 'Hardware and Systems Fundamentals', 0.5, 'Not Yet Completed', '', 'E'),
('Major Required Courses', 'Computer Organization and Architecture', 1.0, 'Not Yet Completed', '', 'E'),
('Major Required Courses', 'Algorithms Design and Analysis', 1.0, 'Not Yet Completed', '', 'E'),
('Major Required Courses', 'Software Engineering', 1.0, 'Not Yet Completed', '', 'E'),
('Major Required Courses', 'Web Technologies', 1.0, 'Not Yet Completed', '', 'E'),
('Major Required Courses', 'Introduction to Modelling and Simulation', 0.5, 'Not Yet Completed', '', 'E'),
('Major Required Courses', 'Networks and Data Communication', 1.0, 'Not Yet Completed', '', 'E'),
('Major Required Courses', 'Operating Systems', 1.0, 'Not Yet Completed', '', 'E'),
('Major Electives', 'Major Elective 1', 1.0, 'Not Yet Completed', '', 'E'),
('Major Electives', 'Major Elective 2', 1.0, 'Not Yet Completed', '', 'E'),
('Capstone', 'Capstone 1', 1.0, 'Not Yet Completed', '', 'E'),
('Capstone', 'Capstone 2', 1.0, 'Not Yet Completed', '', 'E');

/* Create the prerequisites table */
CREATE TABLE course_prerequisites (
    course_id INT,
    prerequisite_id INT,
    PRIMARY KEY (course_id, prerequisite_id),
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    FOREIGN KEY (prerequisite_id) REFERENCES courses(id) ON DELETE CASCADE
);

/* Course Plan table */
CREATE TABLE course_plans (
    plan_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES students(id) ON DELETE CASCADE
);

/* Table to store the specific courses selected for each plan */
CREATE TABLE course_plan_courses (
    plan_course_id INT AUTO_INCREMENT PRIMARY KEY,
    plan_id INT,
    course_id INT,
    FOREIGN KEY (plan_id) REFERENCES course_plans(plan_id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

CREATE TABLE user_activities (
    activity_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    day_of_week ENUM('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday') NOT NULL,
    time_slot INT NOT NULL,  /*Assume you have multiple slots per day; this can represent the time slot number*/
    activity VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES students(id) ON DELETE CASCADE
);

/* Insert prerequisites for Leadership courses */
INSERT INTO course_prerequisites (course_id, prerequisite_id) VALUES
(4, 3),  /* Leadership II requires Leadership I */
(5, 4),  /* Leadership III requires Leadership II */
(6, 5);  /* Leadership IV requires Leadership III */
