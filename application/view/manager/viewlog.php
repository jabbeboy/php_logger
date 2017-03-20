<!-- Shows single log -->
<div class="container">
    <a href="<?php echo URL . 'manager/menu' ?>"><i>Go back</i></a>
    <h2>View Log</h2>
    <p><i>Session: <?php echo $session_id; ?></i>
    <br>
        <i>Log id: <?php echo $id; ?></i>
    </p>

    <div class="htmlLogBox">
        <!-- Print out the selected log -->
        <?php echo $log->html; ?>
    </div>
</div>