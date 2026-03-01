(function () {
    const root = document.getElementById('nextgantt-app');
    if (!root) {
        return;
    }

    const manualTasks = JSON.parse(root.dataset.manualTasks || '[]');
    const calendarTasks = JSON.parse(root.dataset.calendarTasks || '[]');

    const tasks = [...manualTasks, ...calendarTasks];
    const board = root.querySelector('.nextgantt-board');

    if (!tasks.length) {
        board.innerHTML = '<p class="empty">No tasks yet.</p>';
        return;
    }

    const parse = (isoDate) => new Date(`${isoDate}T00:00:00`);
    const dayMs = 24 * 60 * 60 * 1000;

    const starts = tasks.map((task) => parse(task.start).getTime());
    const ends = tasks.map((task) => parse(task.end).getTime());

    const minDate = Math.min(...starts);
    const maxDate = Math.max(...ends);
    const totalDays = Math.max(1, Math.ceil((maxDate - minDate) / dayMs));

    board.innerHTML = tasks.map((task) => {
        const startOffsetDays = Math.floor((parse(task.start).getTime() - minDate) / dayMs);
        const durationDays = Math.max(1, Math.ceil((parse(task.end).getTime() - parse(task.start).getTime()) / dayMs));

        const left = (startOffsetDays / totalDays) * 100;
        const width = (durationDays / totalDays) * 100;
        const sourceClass = task.source === 'calendar' ? 'is-calendar' : 'is-manual';
        const sourceLabel = task.source === 'calendar' ? 'Calendar' : 'Plan';

        return `
            <article class="row ${sourceClass}">
                <div class="meta">
                    <strong>${task.name}</strong>
                    <span>${task.start} → ${task.end}</span>
                </div>
                <div class="track">
                    <div class="bar" style="left: ${left}%; width: ${width}%">
                        <span style="width: ${task.progress}%"></span>
                    </div>
                    <small class="badge">${sourceLabel}</small>
                </div>
            </article>
        `;
    }).join('');
})();
