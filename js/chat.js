const courses = {
    "data scientist": ["Data Structures and Algorithms", "Database Systems", "Machine Learning", "Data Science"],
    "software engineer": ["Introduction to Computer Science", "Data Structures and Algorithms", "Software Engineering", "Operating Systems"],
    "ai researcher": ["Introduction to AI", "Machine Learning", "Natural Language Processing", "Computer Vision"],
    "cybersecurity specialist": ["Applied Cryptography & Computer Security", "Information & System Security", "Networks & Data Communication", "Cloud Computing"],
    "web developer": ["Computer Programming for CS", "Web Development", "Database Systems", "Human Computer Interaction"],
    "mobile app developer": ["Mobile App Development", "Object Oriented Programming", "Software Engineering", "Human Computer Interaction"],
    "game developer": ["Computer Game Development", "Computer Graphics", "Algorithms", "Data Structures and Algorithms"],
    "systems analyst": ["Systems Analysis and Design", "Database Systems", "Information Technology Audit", "Information & System Security"],
    "network engineer": ["Networks & Data Communication", "Operating Systems", "Cloud Computing", "Internet of Things"],
    "data analyst": ["Statistics with Probability", "Data Science", "Database Systems", "Advanced Database Systems", "Research Methods"],
    "embedded systems engineer": ["Embedded Systems", "Hardware and Systems Fundamentals", "Internet of Things", "Functional Programming"],
    "project manager": ["Leadership 1", "Leadership 2", "Leadership 3", "Leadership 4", "Research Methods"],
    "entrepreneur": ["Entrepreneurship 1", "Entrepreneurship 2", "Foundations of Design & Entrepreneurship 1", "FDE","Foundations of Design & Entrepreneurship 2"],
    "it consultant": ["Information Technology Audit", "Systems Analysis and Design", "Cloud Computing", "Database Systems"],
    "ux/ui designer": ["Human Computer Interaction", "Web Development", "Design Principles", "Mobile App Development"],
    "robotics engineer": ["Introduction to AI Robotics", "Machine Learning", "Embedded Systems", "Systems Dependability Analysis"],
    "blockchain developer": ["Applied Cryptography & Computer Security", "Database Systems", "Internet of Things", "Advanced Database"],
    "bioinformatics specialist": ["Introduction to AI", "Data Science", "Statistics with Probability", "Machine Learning"],
    "quantitative analyst": ["Statistics with Probability", "Data Science", "Applied Calculus", "Finance for Non-Finance Majors"],
    "cloud architect": ["Cloud Computing", "Networks & Data Communication", "Operating Systems", "Internet of Things"]
};

let state = 'yearGroup';

function addMessageToConversation(message, sender) {
    const conversation = document.getElementById('conversation');
    const messageElement = document.createElement('p');
    messageElement.innerText = message;
    messageElement.classList.add(sender);
    messageElement.innerHTML = message;
    conversation.appendChild(messageElement);
    conversation.scrollTop = conversation.scrollHeight;
}

function welcomeMessage() {
    addMessageToConversation("Welcome to Ashesi University! What year group are you in (senior, junior, sophomore, freshman)?", 'bot');
}

function askMajor() {
    addMessageToConversation("What major are you pursuing?", 'bot');
    state = 'major';
}

function askCurrentCourses() {
    addMessageToConversation("What courses or electives have you taken so far? <a href='../view/courses.php' target='_blank'>here!", 'bot');
    state = 'currentCourses';
}

function askMoreCourses() {
    addMessageToConversation("Any other courses you would like to see careers in?", 'bot');
    state = 'moreCourses';
}

function recommendCareerAndCourses(electives) {
    const recommendedCareers = [];
    const lowerCaseElectives = electives.toLowerCase();
    for (const career in courses) {
        if (courses[career].some(course => lowerCaseElectives.includes(course.toLowerCase()))) {
            recommendedCareers.push(career);
        }
    }
    return recommendedCareers;
}

document.getElementById('submit').addEventListener('click', () => {
    const answer = document.getElementById('answer').value.trim();
    if (!answer) return;

    addMessageToConversation(answer, 'user');

    if (state === 'yearGroup') {
        if (['senior', 'junior', 'sophomore', 'freshman'].includes(answer.toLowerCase())) {
            if (answer.toLowerCase() === 'senior') {
                addMessageToConversation("Great! You're graduating soon! So proud of you!", 'bot');
            } else {
                addMessageToConversation("Keep going! You will reach the finish line soon!", 'bot');
            }
            askMajor();
        } else {
            addMessageToConversation("Invalid year group. Please enter senior, junior, sophomore, or freshman.", 'bot');
        }
    } else if (state === 'major') {
        if (answer.toLowerCase().includes('computer science')) {
            askCurrentCourses();
        } else {
            addMessageToConversation("Great major choice! Best of luck with your future!", 'bot');
            state = 'done';
        }
    } else if (state === 'currentCourses') {
        const recommendedCareers = recommendCareerAndCourses(answer);
        addMessageToConversation(
            recommendedCareers.length
                ? `Based on your courses, you might also consider a career as a ${recommendedCareers.join(', ')}.`
                : 'No specific career found based on your courses.',
            'bot'
        );
        askMoreCourses();
    } else if (state === 'moreCourses') {
        if (['no', "i don't think so", 'nothing more', "that's all", 'bye', 'no thank you', 'thank you'].some(phrase => answer.toLowerCase().includes(phrase))) {
            addMessageToConversation("Thank you for chatting! All the best! Already proud of you!", 'bot');
            state = 'done';
        } else {
            const recommendedCareers = recommendCareerAndCourses(answer);
            addMessageToConversation(
                recommendedCareers.length
                    ? `Based on your input, you might also consider a career as a ${recommendedCareers.join(', ')}.`
                    : 'No new specific career found based on your input. Feel free to ask about other electives or type "Bye" to exit.',
                'bot'
            );
            askMoreCourses();
        }
    }

    document.getElementById('answer').value = '';
});

welcomeMessage();
