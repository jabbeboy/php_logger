<div class="container">

    <h1>Login</h1>
    <p><i>To access the Log Manager you must log in first.</i></p>
    <div class="box">
        <form id="login-form" class="text-left" action="<?php echo URL ?>start/login" method="POST">

            <label>Username</label>
            <input type="text" id="lg_username" value="" name="lg_username" required>

            <label>Password</label>
            <input type="password" id="lg_password" value="" name="lg_password" required>

            <input type="submit" name="login_btn" value="Login">
        </form>
    </div>
</div>


