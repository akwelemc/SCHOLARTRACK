// Function to add a new assignment input form
function addAssignment() {
    const container = document.getElementById('assignments-container');
    const newAssignment = document.createElement('div');
    newAssignment.className = 'assignment';
    newAssignment.innerHTML = `
        <input type="text" name="assignment_name[]" placeholder="Assignment Name" required>
        <input type="number" name="assignment_received[]" placeholder="Grade Received" min="0" max="100" required>
        <input type="number" name="assignment_total[]" placeholder="Total Grade" min="0" max="100" required>
        <input type="number" name="assignment_weight[]" placeholder="Weight (%)" min="0" max="100" required>
        <button type="button" onclick="removeAssignment(this)">Remove</button>
    `;
    container.appendChild(newAssignment);
}

// Function to remove an assignment input form
function removeAssignment(button) {
    button.parentElement.remove();
}

// Function to validate that assignment names are unique
function checkForDuplicateNames() {
    const nameInputs = document.querySelectorAll('input[name="assignment_name[]"]');
    const names = Array.from(nameInputs).map(input => input.value.trim().toLowerCase());
    const uniqueNames = new Set(names);

    if (uniqueNames.size !== names.length) {
        return "Assignment names must be unique.";
    }

    return null;
}

// Function to calculate the course grade based on the form inputs
document.getElementById('course-grade-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting

    const receivedGrades = document.querySelectorAll('input[name="assignment_received[]"]');
    const totalGrades = document.querySelectorAll('input[name="assignment_total[]"]');
    const weights = document.querySelectorAll('input[name="assignment_weight[]"]');

    let totalWeightedGrade = 0;
    let totalWeight = 0;
    let errorMessage = '';

    // Check for duplicate assignment names
    errorMessage = checkForDuplicateNames();
    if (errorMessage) {
        document.getElementById('error-message').textContent = errorMessage;
        document.getElementById('error-message').style.display = 'block';
        document.getElementById('course-grade').textContent = 'Course Grade: N/A';
        return;
    }

    // Validate total grade vs. received grade and calculate the total weight
    receivedGrades.forEach((gradeInput, index) => {
        const receivedGrade = parseFloat(gradeInput.value) || 0;
        const totalGrade = parseFloat(totalGrades[index].value) || 0;
        const weight = parseFloat(weights[index].value) || 0;

        if (totalGrade < receivedGrade) {
            errorMessage = `Total grade for assignment "${document.querySelectorAll('input[name="assignment_name[]"]')[index].value}" cannot be less than received grade.`;
            return;
        }
    });

    // Calculate the total weight
    weights.forEach(weightInput => {
        totalWeight += parseFloat(weightInput.value) || 0;
    });

    // Check if weights add up to 100%
    if (totalWeight !== 100) {
        errorMessage = 'Weights must add up to 100%.';
    }

    if (errorMessage) {
        document.getElementById('error-message').textContent = errorMessage;
        document.getElementById('error-message').style.display = 'block';
        document.getElementById('course-grade').textContent = 'Course Grade: N/A';
        return;
    } else {
        document.getElementById('error-message').style.display = 'none';
    }

    // Calculate the weighted grade
    receivedGrades.forEach((gradeInput, index) => {
        const receivedGrade = parseFloat(gradeInput.value) || 0;
        const totalGrade = parseFloat(totalGrades[index].value) || 0;
        const weight = parseFloat(weights[index].value) || 0;

        if (totalGrade > 0) {
            const percentage = (receivedGrade / totalGrade) * 100;
            const weightedGrade = (percentage * weight) / 100;
            totalWeightedGrade += weightedGrade;
        }
    });

    const finalGrade = totalWeightedGrade;
    document.getElementById('course-grade').textContent = `Course Grade: ${finalGrade.toFixed(2)}%`;
});
