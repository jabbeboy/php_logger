<?php

/**
 * The Start controller
 * Handles the processing of the answers and login to the manager zone.
 */
class Start extends CoreController
{
    /**
     * Index page for start view
     */
    public function index()
    {
        require APP . 'view/header.php';
        require APP . 'view/start/index.php';
        require APP . 'view/footer.php';
    }

    /**
     * Login page for manager.
     * If user session already is set,
     * then redirect to manager index instead.
     */
    public function manager()
    {
        if (isset($_SESSION['user']))
        {
            header('location:' . URL . 'manager');
        }
        else
        {
            require APP . 'view/header.php';
            require APP . 'view/start/login.php';
            require APP . 'view/footer.php';
        }
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
            try {
                $this->validateInput($_POST['question_one'], $_POST['question_two']);
                header('location:' . URL . 'message/success');
            }
            catch (Exception $exception)
            {
                $this->logModel->logException('Wrong input', $exception);
                header('location:' . URL . 'message');
            }
        }
    }

    /**
     * Validates the user input answers and throws exception if not valid.
     * @param $result string from user input
     * @param $name string from user input
     * @throws Exception
     * @return true
     */
    private function validateInput($result, $name)
    {
        $result = (int)$result;

        if (!filter_var($result, FILTER_VALIDATE_INT) === true)
        {
            throw new Exception('Is not a integer');
        }

        if ($result !== 3)
        {
            throw new Exception('Wrong number');
        }

        if ($name !== "Obama")
        {
            throw new Exception('Wrong name');
        }
        return true;
    }
}
