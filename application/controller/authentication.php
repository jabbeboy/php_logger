<?php

/**
 * The Authentication controller.
 * Handles the login, logout, but could also be renamed
 * for account controller if registration existed
 */
class Authentication extends CoreController
{
    /**
	 * Get the requested user from the database and authenticates by username and password
	 * Catches exceptions if the authentication fails
	 * Redirects to problem view if any error occurs.
	 */
	public function login()
	{
		if (isset($_POST['login_submit']))
		{
			$username = trim(stripslashes(htmlspecialchars($_POST['login_username'])));
			$password = trim(stripslashes(htmlspecialchars($_POST['login_password'])));

			try
			{
				$user = $this->dbModel->getUser($username);

				// Authenticated user has correct username and password
				if ($this->authenticate($user, $password))
				{
					// It should be enough to regenerate the session id to mitigate attacks against sessions
					session_regenerate_id();

					// Set user session and redirect
					$_SESSION['user'] = $user['username'];

					// Unset credentials from the db request and $_POST and redirect
					unset($user['salt']);
					unset($user['password']);
					unset($_POST);

					header('location:' . URL . 'manager');
				}
			}
			catch (Exception $exception)
			{
				$this->logModel->logException('Login failed', $exception);
				header('location:' . URL . 'message');
			}
		}
	}

	/**
	 * Authenticates the user with the requested username from the database.
	 * If not correct, exceptions will be thrown.
	 * @param $user
	 * @param $password
	 * @return bool
	 * @throws Exception
	 */
	private function authenticate($user, $password)
	{
		if (!$user) {
			throw new Exception('Incorrect username');
		}

		$hashed_pass = hash('sha256', $password . $user['salt']);
		for ($round = 0; $round < 65536; $round++)
		{
			$hashed_pass = hash('sha256', $hashed_pass . $user['salt']);
		}

		if ($hashed_pass !== $user['password'])
		{
			throw new Exception('Incorrect password.');
		}
		return true;
	}

	/**
	 * Destroys the session and refresh page.
	 * If no session is set, redirects to problem controller
	 * Manager page should then not be possible to access due to session_destroyed.
	 */
	public function logout()
	{
		if (isset($_SESSION['user']))
		{
			$_SESSION = array();
			session_destroy();
			header('location:' .URL . 'start/manager');
		}
		else
		{
			header('location:' . URL . 'message/unauthorized');
		}
	}
}