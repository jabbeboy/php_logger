<?php

/**
 * Start controller
 * This can be the websites absolute start page.
 * In my example, it is only a simple answer submit to demonstrate the logging system.
 */
class Start extends Controller
{
    /**
     * Index view for start page
     */
    public function index()
    {
        // Load views
        require APP . 'view/header.php';
        require APP . 'view/start/index.php';
        require APP . 'view/footer.php';
    }

    /**
     * Index view for login page
     */
    public function manager()
    {
        require APP . 'view/header.php';
        require APP . 'view/start/login.php';
        require APP . 'view/footer.php';
    }

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

                    // Unset credentials from db request and $_POST variable and redirect
                    unset($user['salt']);
                    unset($user['password']);
                    unset($_POST);

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

    /**
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
     * Handles the user input answers and log any exceptions that is throwned when validating the answers.
     */
    public function process()
    {
        if (isset($_POST['submit']))
        {
            try {
                $this->validate($_POST['question_one'], $_POST['question_two']);
                header('Location:' . URL . 'start/success');
            }
            catch (Exception $exception)
            {
                $this->logModel->logException($exception, $exception);
                header('location:' . URL . 'problem');
            }
        }
    }

    /**
     * Validates the user input answers and throws exception if not valid.
     * @param $result string from user input
     * @param $name string from user input
     * @throws Exception
     */
    public function validate($result, $name)
    {
        $result = (int)$result;

        if (!filter_var($result, FILTER_VALIDATE_INT) === true)
        {
            throw new Exception('Input is not a integer');
        }

        if ($result !== 250)
        {
            throw new Exception('Wrong answer');
        }

        if ($name !== "Barack Obama")
        {
            throw new Exception('Wrong answer');
        }
    }
}
