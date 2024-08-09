document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('course-grade-form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        calculateCourseGrade();
    });
});

function addAssignment() {
    const container = document.getElementById('assignments-container');
    const newAssignment = document.createElement('div');
    newAssignment.classList.add('assignment');
    newAssignment.innerHTML = `
        <input type="text" name="assignment_name[]" placeholder="Assignment Name" required>
        <input type="number" name="assignment_grade[]" placeholder="Grade" min="0" max="100" required>
        <input type="number" name="assignment_weight[]" placeholder="Weight (%)" min="0" max="100" required>
        <button type="button" onclick="removeAssignment(this)">Remove</button>
    `;
    container.appendChild(newAssignment);
}

function removeAssignment(button) {
    button.parentElement.remove();
}

function calculateCourseGrade() {
    const names = document.querySelectorAll('input[name="assignment_name[]"]');
    const grades = document.querySelectorAll('input[name="assignment_grade[]"]');
    const weights = document.querySelectorAll('input[name="assignment_weight[]"]');
    
    let totalWeight = 0;
    let weightedSum = 0;

    names.forEach((name, index) => {
        const grade = parseFloat(grades[index].value);
        const weight = parseFloat(weights[index].value);

        if (weight > 0 && weight <= 100) {
            weightedSum += grade * (weight / 100);
            totalWeight += weight;
        }
    });

    const courseGrade = (totalWeight > 0) ? weightedSum.toFixed(2) : 'N/A';
    document.getElementById('course-grade').innerText = `Course Grade: ${courseGrade}`;
}
