<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Start extends Controller
{
    /**
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // load views
        require APP . 'view/header.php';
        require APP . 'view/start/index.php';
        require APP . 'view/footer.php';
    }

    public function manager()
    {
        require APP . 'view/header.php';
        require APP . 'view/start/login.php';
        require APP . 'view/footer.php';
    }

    public function login()
    {
        var_dump($_GET);

        if (isset($_POST['login_btn']))
        {
            try
            {
                $username = trim(stripslashes(htmlspecialchars($_POST['lg_username'])));
                $password = trim(stripslashes(htmlspecialchars($_POST['lg_password'])));

                $user = $this->dbModel->getUser($username);
                if ($this->authenticate($user, $password))
                {
                    // It should be enough to regenerate the session id to mitigate attacks
                    session_regenerate_id();

                    // Set user session and redirect
                    $_SESSION['user'] = $user['username'];

                    // Unset credentials from database request and $_POST
                    unset($user['salt']);
                    unset($user['password']);
                    unset($_POST);

                    // Redirects to manager: http://domain.com/manager
                    header('location:' . URL . 'manager');
                }
            }
            catch (Exception $exception)
            {
                $this->logModel->logException('Login failed', $exception);
                header('location:' . URL . 'problem');
            }
        }
    }

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

    public function process()
    {

    }
}
