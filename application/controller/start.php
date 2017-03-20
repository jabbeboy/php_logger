<?php

/**
 * The start controller
 * Handles the processing of the answers and login to the manager zone.
 */
class Start extends CoreController
{
    /**
     * Index page for start
     */
    public function index()
    {
        require APP . 'view/header.php';
        require APP . 'view/start/index.php';
        require APP . 'view/footer.php';
    }

    /**
     * Login page for manager
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
                header('location:' . URL . 'problem');
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
     * Processes the answers the user submitted.
     * If correct, success view will be showned, else the
     * invalid input will be logged.
     */
    public function submit()
    {
        if (isset($_POST['submit']))
        {
            $answerOne = $_POST['question_one'];
            $answerTwo = $_POST['question_two'];

            try {
                $this->validateInput($answerOne, $answerTwo);
                header('location:' . URL . 'start/success');
            }
            catch (Exception $exception)
            {
                $this->logModel->logException('Wrong input', $exception);
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
    private function validateInput($result, $name)
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
