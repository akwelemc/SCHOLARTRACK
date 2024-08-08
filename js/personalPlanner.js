document.addEventListener('DOMContentLoaded', () => {
    const quotes = [
        "The only way to do great work is to love what you do. – Steve Jobs",
        "The best time to plant a tree was 20 years ago. The second best time is now.",
        "Your time is limited, don’t waste it living someone else’s life. – Steve Jobs",
        "The best revenge is massive success. – Frank Sinatra",
        "Don’t count the days, make the days count. – Muhammad Ali",
    ];

    function displayRandomQuote() {
        const randomIndex = Math.floor(Math.random() * quotes.length);
        document.getElementById('quote-text').textContent = quotes[randomIndex];
    }

    displayRandomQuote();  
});

document.addEventListener('DOMContentLoaded', () => {
    const activitySlots = document.querySelectorAll('.activity-slot');
    const timeSlots = document.querySelectorAll('.time-slot');

  
    fetch('../action/load_activities.php', {
        method: 'GET'
    })
    .then(response => response.json())
    .then(data => {
        data.forEach(activity => {
            const slot = document.querySelector(`.activity-slot[data-day="${activity.day_of_week}"][data-slot="${activity.time_slot}"]`);
            const timeSlot = slot.closest('tr').querySelector('.time-slot');
            
            if (slot) {
                slot.textContent = activity.activity;
                slot.style.backgroundColor = '#800020';
                slot.style.color = 'white';
            }
            
            if (timeSlot && activity.time) {
                timeSlot.textContent = activity.time;
            }
        });
    });

    activitySlots.forEach(slot => {
        slot.addEventListener('click', () => {
            const activity = prompt('Enter your activity:');
            if (activity) {
                slot.textContent = activity;
                slot.style.backgroundColor = '#800020';
                slot.style.color = 'white';

              
                const dayOfWeek = slot.getAttribute('data-day');
                const timeSlotNumber = slot.getAttribute('data-slot');
                const timeSlot = slot.closest('tr').querySelector('.time-slot').textContent;  // Get the time from the corresponding time slot

                fetch('../action/save_activity.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `day_of_week=${dayOfWeek}&time_slot=${timeSlotNumber}&activity=${encodeURIComponent(activity)}&time=${encodeURIComponent(timeSlot)}`
                });
            }
        });
    });

    timeSlots.forEach(slot => {
        slot.addEventListener('blur', () => {
            const time = slot.textContent;
            const timeSlotNumber = slot.closest('tr').querySelector('.activity-slot').getAttribute('data-slot');

            fetch('/saveTime.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `time_slot=${timeSlotNumber}&time=${encodeURIComponent(time)}`
            });
        });
    });
});
