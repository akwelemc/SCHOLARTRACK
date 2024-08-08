document.addEventListener('DOMContentLoaded', () => {
    const totalCreditsRequired = 120; // Example value for the total credits required for graduation

    const courseTable = document.getElementById('courseTable');
    const totalCreditsElement = document.getElementById('totalCredits');
    const percentCompletedElement = document.getElementById('percentCompleted');

    let totalCreditsTaken = 0;

    function updateCredits() {
        totalCreditsTaken = Array.from(courseTable.querySelectorAll('tr'))
            .filter(row => row.querySelector('.status-select').value === 'Completed')
            .reduce((sum, row) => sum + parseFloat(row.cells[2].textContent), 0);

        const percentCompleted = ((totalCreditsTaken / totalCreditsRequired) * 100).toFixed(2);

        totalCreditsElement.textContent = totalCreditsTaken;
        percentCompletedElement.textContent = percentCompleted + '%';
    }

    function loadCourses() {
        fetch('../action/get_courses.php')
            .then(response => response.json())
            .then(courses => {
                courses.forEach(course => {
                    const row = document.createElement('tr');
                    row.setAttribute('data-id', course.id);

                    const gradeDropdown = ['A+', 'A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'F'].map(grade =>
                        `<option value="${grade}" ${course.grade === grade ? 'selected' : ''}>${grade}</option>`
                    ).join('');

                    row.innerHTML = `
                        <td>${course.category}</td>
                        <td>${course.name}</td>
                        <td>${course.credits}</td>
                        <td>
                            <select class="status-select">
                                <option value="Completed" ${course.status === 'Completed' ? 'selected' : ''}>Completed</option>
                                <option value="Enrolled" ${course.status === 'Enrolled' ? 'selected' : ''}>Enrolled</option>
                                <option value="Not Yet Completed" ${course.status === 'Not Yet Completed' ? 'selected' : ''}>Not Yet Completed</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" value="${course.completedWhen}" placeholder="e.g. Year 1 Sem1">
                        </td>
                        <td>
                            <select class="grade-select">
                                ${gradeDropdown}
                            </select>
                        </td>
                    `;

                    courseTable.appendChild(row);
                });

                updateCredits();
            });
    }

    function updateCourse(row) {
        const id = row.getAttribute('data-id');
        const status = row.querySelector('.status-select').value;
        const completedWhen = row.querySelector('input').value;
        const grade = row.querySelector('.grade-select').value;

        fetch('../action/update_course.php', {
            method: 'POST',
            body: JSON.stringify({ id, status, completedWhen, grade }),
            headers: { 'Content-Type': 'application/json' }
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                updateCredits();
            }
        });
    }

    loadCourses();

    document.addEventListener('change', event => {
        if (event.target.classList.contains('status-select') || event.target.classList.contains('grade-select') || event.target.tagName === 'INPUT') {
            const row = event.target.closest('tr');
            updateCourse(row);
        }
    });
});
