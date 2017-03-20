<div class="container">
    <a href="<?php echo URL . 'manager/logmenu' ?>">Go back</a>
    <h2>View Log</h2>
    <p><i>Session id: <?php echo $session_id; ?></i>
    <br>
        <i>Log id: <?php echo $id; ?></i>
    </p>

    <div class="htmlLogBox">
        <!-- Print out the selected log -->
        <?php echo $log->html; ?>
    </div>
</div>