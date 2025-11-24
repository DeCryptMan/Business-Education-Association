<?php 
use Core\Url; 
use Core\Lang;
?>

<style>
    /* Custom Calendar Styles */
    .nf-calendar-wrapper { background: #fff; border-radius: 20px; padding: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.05); }
    .calendar-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 10px; text-align: center; }
    .calendar-day-name { font-weight: 700; color: #94a3b8; padding: 10px; text-transform: uppercase; font-size: 0.8rem; }
    
    .calendar-day { 
        height: 100px; border-radius: 12px; border: 1px solid #f1f5f9; 
        display: flex; flex-direction: column; align-items: center; justify-content: flex-start; 
        padding: 10px; cursor: default; transition: all 0.2s; position: relative;
    }
    .calendar-day:hover { background: #f8fafc; }
    .calendar-day.empty { background: transparent; border: none; cursor: default; }
    .calendar-day.has-event { 
        background: #ecfdf5; border-color: #10b981; cursor: pointer;
    }
    .calendar-day.has-event:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(16, 185, 129, 0.2); }
    
    .day-number { font-weight: 700; font-size: 1.1rem; margin-bottom: 5px; }
    .event-dot { width: 6px; height: 6px; background: #10b981; border-radius: 50%; margin-top: 4px; }
    
    .event-tooltip {
        position: absolute; bottom: 100%; left: 50%; transform: translateX(-50%);
        background: #1e293b; color: #fff; padding: 8px 12px; border-radius: 8px;
        font-size: 0.8rem; width: 200px; z-index: 10; display: none; pointer-events: none;
        text-align: left; box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    .calendar-day:hover .event-tooltip { display: block; }
</style>

<section class="nf-section pt-5">
    <div class="container-lg">
        <div class="text-center mb-5">
            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">CALENDAR</span>
            <h1 class="display-4 fw-bold"><?= __('nav.events', 'Սպասվող Միջոցառումներ') ?></h1>
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="nf-calendar-wrapper">
                    <div class="calendar-header">
                        <button class="btn btn-light rounded-circle" onclick="changeMonth(-1)">‹</button>
                        <h3 class="mb-0 fw-bold" id="monthYear"></h3>
                        <button class="btn btn-light rounded-circle" onclick="changeMonth(1)">›</button>
                    </div>
                    
                    <div class="calendar-grid" id="calendarGrid">
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const eventsData = <?= json_encode($calendarData) ?>; 
    const lang = "<?= Lang::current() ?>";
    let currentDate = new Date();

    function renderCalendar() {
        const grid = document.getElementById('calendarGrid');
        const monthYear = document.getElementById('monthYear');
        grid.innerHTML = '';

        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();
        const months = lang === 'hy' 
            ? ['Հունվար', 'Փետրվար', 'Մարտ', 'Ապրիլ', 'Մայիս', 'Հունիս', 'Հուլիս', 'Օգոստոս', 'Սեպտեմբեր', 'Հոկտեմբեր', 'Նոյեմբեր', 'Դեկտեմբեր']
            : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        
        const daysHeader = lang === 'hy'
            ? ['Կիր', 'Երկ', 'Երք', 'Չոր', 'Հին', 'Ուր', 'Շաբ']
            : ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        monthYear.textContent = `${months[month]} ${year}`;
        daysHeader.forEach(day => {
            const div = document.createElement('div');
            div.className = 'calendar-day-name';
            div.textContent = day;
            grid.appendChild(div);
        });

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        for (let i = 0; i < firstDay; i++) {
            const div = document.createElement('div');
            div.className = 'calendar-day empty';
            grid.appendChild(div);
        }
        for (let i = 1; i <= daysInMonth; i++) {
            const div = document.createElement('div');
            div.className = 'calendar-day';
            const dateKey = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
            const dayEvents = eventsData[dateKey];

            let content = `<div class="day-number">${i}</div>`;

            if (dayEvents && dayEvents.length > 0) {
                div.classList.add('has-event');
                div.onclick = () => {
                    if (dayEvents.length === 1) {
                        window.location.href = `<?= Url::to('events/') ?>` + dayEvents[0].id;
                    } else {
                        window.location.href = `<?= Url::to('events/') ?>` + dayEvents[0].id;
                    }
                };

                content += `<div class="event-dot"></div>`;
                const title = lang === 'hy' ? dayEvents[0].title_hy : (dayEvents[0].title_en || dayEvents[0].title_hy);
                content += `
                    <div class="event-tooltip">
                        <strong>${dayEvents[0].time}</strong><br>
                        ${title}
                        ${dayEvents.length > 1 ? `<br><small>+ ${dayEvents.length - 1} more</small>` : ''}
                    </div>
                `;
            }

            div.innerHTML = content;
            grid.appendChild(div);
        }
    }

    function changeMonth(step) {
        currentDate.setMonth(currentDate.getMonth() + step);
        renderCalendar();
    }
    document.addEventListener('DOMContentLoaded', renderCalendar);
</script>