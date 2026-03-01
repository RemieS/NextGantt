<?php
/** @var array $_ */
/** @var \OCP\IL10N $l */
script('nextgantt', 'main');
style('nextgantt', 'main');
?>
<div id="nextgantt-app" data-tasks="<?php p(json_encode($_['tasks'])); ?>">
    <header class="nextgantt-header">
        <h2><?php p($l->t('NextGantt')); ?></h2>
        <p><?php p($l->t('Plan your project tasks on a simple timeline.')); ?></p>
    </header>

    <section class="nextgantt-board" aria-live="polite"></section>
</div>
