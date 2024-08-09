let totalCredits = 0; // Declare totalCredits in the global scope

document.addEventListener('DOMContentLoaded', () => {
    // Fetch available courses and populate the list
    fetch('../action/load_courses.php')
        .then(response => response.json())
        .then(data => {
            console.log('Available courses:', data);
            const availableCourses = document.getElementById('availableCourses');

            // Filter out completed courses
            const filteredCourses = data.filter(course => course.status !== 'Completed');

            filteredCourses.forEach(course => {
                const li = document.createElement('li');
                li.textContent = `${course.name} (${course.credits} credits)`;
                li.dataset.courseId = course.id;
                li.dataset.courseCredits = course.credits;

                // Create select button
                const selectBtn = document.createElement('button');
                selectBtn.textContent = 'Select';
                selectBtn.addEventListener('click', () => {
                    const courseCredits = parseFloat(course.credits);
                    if (totalCredits + courseCredits <= 4.5) {
                        addToSelectedCourses(course.id, course.name, courseCredits, li);
                        li.style.display = 'none'; // Hide from available courses
                        totalCredits += courseCredits; // Update the total credits
                    } else {
                        alert('You cannot select more than 4.5 credits.');
                    }
                });

                li.appendChild(selectBtn);
                availableCourses.appendChild(li);
            });
        })
        .catch(error => console.error('Error loading courses:', error));
});

function addToSelectedCourses(courseId, courseName, courseCredits, availableCourseElement) {
    const selectedCourses = document.getElementById('selectedCourses');
    const li = document.createElement('li');
    li.textContent = `${courseName} (${courseCredits} credits)`;
    li.dataset.courseId = courseId;
    li.dataset.courseCredits = courseCredits;

    // Create remove button
    const removeBtn = document.createElement('button');
    removeBtn.textContent = 'Remove';
    removeBtn.addEventListener('click', () => {
        removeFromSelectedCourses(courseId, courseCredits, li, availableCourseElement);
    });

    li.appendChild(removeBtn);
    selectedCourses.appendChild(li);
}

function removeFromSelectedCourses(courseId, courseCredits, liElement, availableCourseElement) {
    // Remove the course from the selected list
    liElement.remove();

    // Unhide the corresponding course in the available courses
    availableCourseElement.style.display = 'block';

    // Deduct the course credits from the total
    totalCredits -= courseCredits;
}

function submitCoursePlan() {
    const selectedCourses = document.getElementById('selectedCourses').querySelectorAll('li');
    const courseIds = Array.from(selectedCourses).map(li => li.dataset.courseId);

    fetch('../action/save_course_plan.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `course_ids=${JSON.stringify(courseIds)}`
    })
    .then(response => response.text())
    .then(text => {
        if (text.trim() === 'Course plan submitted successfully.') {
            alert('Course plan submitted successfully!');
        } else {
            alert('Error submitting course plan.');
        }
    })
    .catch(error => console.error('Error submitting course plan:', error));
}
