<div class="container">
    <h1>Login</h1>
    <p><i>To access the Log Manager, you need to log in.</i></p>
    <div class="box">
        <form id="login-form" class="text-left" action="<?php echo URL ?>start/login" method="POST">

            <label>Username</label>
            <input type="text" id="login_username" value="" name="login_username" required>

            <label>Password</label>
            <input type="password" id="login_password" value="" name="login_password" required>

            <input type="submit" name="login_submit" class="login-button" value="Login">
        </form>
        <div>
        </div>
    </div>
</div>


