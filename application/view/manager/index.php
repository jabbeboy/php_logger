<!-- Manager Home -->
<div class="container">
    <a href="<?php echo URL; ?>authentication/logout"><i>Logout</i></a>
    <h2>Log Manager</h2>
    <h3>Welcome <?php echo $_SESSION['user'] ?></h3>
    <div class="box">
        <p><a href="<?php echo URL; ?>manager/menu">Log Menu</a></p>
    </div>
</div>