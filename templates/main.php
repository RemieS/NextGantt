<?php
/** @var array $_ */
/** @var \OCP\IL10N $l */
script('nextgantt', 'main');
style('nextgantt', 'main');
?>
<div
    id="nextgantt-app"
    data-manual-tasks="<?php p(json_encode($_['manualTasks'])); ?>"
    data-calendar-tasks="<?php p(json_encode($_['calendarTasks'])); ?>"
>
    <header class="nextgantt-header">
        <h2><?php p($l->t('NextGantt')); ?></h2>
        <p><?php p($l->t('Plan your project tasks on a simple timeline.')); ?></p>
    </header>

    <p class="nextgantt-hint">
        <?php p($l->t('Calendar events from the next 60 days are shown as timeline items.')); ?>
    </p>

    <section class="nextgantt-board" aria-live="polite"></section>
</div>
