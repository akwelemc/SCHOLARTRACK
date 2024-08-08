// Function to handle course selection
function selectCourse(courseID, courseName, credits) {
    const availableCoursesList = document.getElementById('availableCourses');
    const selectedCoursesList = document.getElementById('selectedCourses');
    const selectedCourses = selectedCoursesList.querySelectorAll('li');
    
    // Check if the selected course exceeds the credit limit
    let totalCredits = 0;
    selectedCourses.forEach(course => {
        const creditText = course.textContent.match(/\(([^)]+)\)/);
        if (creditText) {
            totalCredits += parseFloat(creditText[1]);
        }
    });

    if (totalCredits + parseFloat(credits) > 4.5) {
        alert('You cannot select more than 4.5 credits.');
        return;
    }

    // Get the course element
    const courseElement = document.getElementById(courseID);
    const status = courseElement.dataset.status;
    const prerequisites = JSON.parse(courseElement.dataset.prerequisites);

    // Check if prerequisites are completed
    const prerequisitesCompleted = prerequisites.every(prerequisiteID => {
        const prerequisiteElement = document.getElementById(prerequisiteID);
        return prerequisiteElement && prerequisiteElement.dataset.status === 'completed';
    });

    if (!prerequisitesCompleted) {
        alert('You must complete all prerequisite courses before selecting this course.');
        return;
    }

    // Move course to selected courses
    const li = document.createElement('li');
    li.id = courseID; // Set the ID for removal purposes
    li.textContent = courseName + ' (' + credits + ' credits)';
    const removeBtn = document.createElement('button');
    removeBtn.textContent = 'Remove';
    removeBtn.onclick = function() { removeCourse(courseID, courseName, credits); };
    li.appendChild(removeBtn);
    selectedCoursesList.appendChild(li);

    // Hide the course in the available list
    courseElement.style.display = 'none';
}

// Function to handle course removal
function removeCourse(courseID, courseName, credits) {
    const selectedCoursesList = document.getElementById('selectedCourses');
    const courseToRemove = Array.from(selectedCoursesList.querySelectorAll('li')).find(li => li.id === courseID);

    if (courseToRemove) {
        selectedCoursesList.removeChild(courseToRemove);

        // Show the course back in the available list
        const courseElement = document.getElementById(courseID);
        if (courseElement) {
            courseElement.style.display = '';
        }
    }
}

// Function to handle course plan submission
function submitCoursePlan() {
    const selectedCourses = document.querySelectorAll('#selectedCourses li');
    const coursePlan = [];

    selectedCourses.forEach(course => {
        const courseID = course.id;
        const credits = course.textContent.match(/\(([^)]+)\)/)[1];
        coursePlan.push({ courseID, credits });
    });

    const data = {
        user_id: 101, // This should be dynamically set based on user session
        courses: coursePlan
    };

    fetch('../action/submit_course_plan.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(result => {
        if (result.success) {
            alert('Course plan submitted successfully!');
        } else {
            alert('Failed to submit course plan: ' + result.error);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred: ' + error.message);
    });
}
