<div class="container">

    <h1>Login</h1>
    <div class="box">
        <form id="login-form" class="text-left" action="<?php echo URL ?>login/dologin" method="POST">

            <label>Username</label>
            <input type="text" id="lg_username" value="" name="lg_username" required>

            <label>Password</label>
            <input type="password" id="lg_password" value="" name="lg_password" required>

            <input type="submit" name="login_submit" class="login-button" value="Login">
        </form>
        <div>
		    <?php echo $login_msg; ?>
        </div>
    </div>
</div>


