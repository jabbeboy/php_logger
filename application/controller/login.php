<?php

/**
 * Created by PhpStorm.
 * User: JakobW
 * Date: 2017-03-07
 * Time: 12:50
 */
class Login extends Controller
{

	public function index()
	{
        if (!isset($_SESSION['user_session']))
        {
            require APP . 'view/header.php';
            require APP . 'view/login/index.php';
            require APP . 'view/footer.php';
        }
        else
        {
            header('Location:' . URL . 'home');
        }
	}

	public function dologin()
	{
		if (isset($_POST['login_submit']))
		{
			$user = $this->model->getUser($_POST['lg_username']);
			$auth = $this->authenticate($user, $_POST['lg_password']);
			if ($auth)
			{
				$_SESSION['user_session'] = $user['username'];
				header('Location:' . URL . 'home');
			}
			else
            {
            	exit();
            }
		}

	}

	private function authenticate($user, $password)
	{
		if ($user) {

			$hashed_pass = hash('sha256', $password . $user['salt']);

			for ($round = 0; $round < 65536; $round++) {
				$hashed_pass = hash('sha256', $hashed_pass . $user['salt']);
			}

			if ($hashed_pass === $user['password']) {
				return true;
			} else {
				return false;
			}
		}
		return false;
	}
}
