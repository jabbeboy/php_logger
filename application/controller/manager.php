<?php

/**
 * The Manager controller
 * Is used for all manager actions like view logs, delete, logout.
 *
 * the actions(functions) is protected against un-authorized users.
 * Session will only be set if admin passes the login authentication
 */
class Manager extends CoreController
{
    /**
     * Index page for the Manager view
     */
    public function index()
    {
        require APP . 'view/header.php';
        require APP . 'view/manager/index.php';
        require APP . 'view/footer.php';

    }

    /**
     * Shows the log menu view.
     * The logmenu saves the ip addresses and session ids in arrays that the
     * view uses and prints out in tables.
     * If no session is set, redirects to login
     */
    public function menu()
    {
        if (isset($_SESSION['user']))
        {
            $sessions = $this->dbModel->getSessions();
            $addresses = $this->dbModel->getAddresses();

            require APP . 'view/header.php';
            require APP . 'view/manager/menu.php';
            require APP . 'view/footer.php';
        }
        else
        {
            header('Location:' . URL . 'login');
        }
    }

    /**
     * Gets all logs in the table and stores them in a array that is viewed
     * in the viewlogs view.
     * If no session is set, redirects to login
     */
    public function logs()
    {
        $allLogs = $this->dbModel->getLogFields();

        require APP . 'view/header.php';
        require APP . 'view/manager/alllogs.php';
        require APP . 'view/footer.php';

    }

    /**
     * Gets all logs by session id and stores in a array that is viewed
     * in the viewsession view.
     * @param $session_id
     */
    public function session($session_id)
    {
        if (isset($session_id))
        {
            var_dump($session_id);
            $logBySession = $this->dbModel->getLogsBySession($session_id);
        }
        require APP . 'view/header.php';
        require APP . 'view/manager/session.php';
        require APP . 'view/footer.php';
    }

    /**
     * Gets all logs by address and stores in a array that is viewed
     * in the viewaddress view.
     * If no session is set, redirects to login
     */
    public function address($address)
    {
        if (isset($_SESSION['user']))
        {
            if (isset($address))
            {
                $logsByAddress = $this->dbModel->getLogsByAddress($address);
            }
            require APP . 'view/header.php';
            require APP . 'view/manager/address.php';
            require APP . 'view/footer.php';
        }
        else
        {
            header('Location:' . URL . 'login');
        }
    }



    /**
     * Views the selected by getting the html blob from the database and printing
     * it out on the html
     * If no session is set, redirects to login
     * @param $param_id
     */
    public function viewlog($param_id)
    {
        if (isset($_SESSION['user']))
        {
            if (isset($param_id))
            {
                $session_id = strtok($param_id, '=');
                $id = substr($param_id, strpos($param_id, '=') + 1);

                $log = $this->dbModel->getLogHtml($session_id, $id);

                require APP . 'view/header.php';
                require APP . 'view/manager/viewlog.php';
                require APP . 'view/footer.php';
            }
        }
        else
        {
            header('Location:' . URL . 'login');
        }
    }

    /**
     * Deletes log file from database with help of sent $log_id
     * which basically is just the $session_id concatenated with a "=" delimiter
     * and $id of from the logfiles table.
     * If no session is set, redirects to login
     * @param $param_id string with session_id and id
     */
    public function deleteLog($param_id)
    {
        if (isset($_SESSION['user']))
        {
            if (isset($param_id))
            {
                $session_id = strtok($param_id, '=');
                $id = substr($param_id, strpos($param_id, '=') + 1);

                if ($this->dbModel->deleteLog($session_id, $id))
                {
                    header('Location:' . URL . 'manager/viewlogs');
                }
            }
        }
        else
        {
            header('Location:' . URL . 'login');
        }
    }

    /**
     * Destroys the session and refresh page.
     * If no session is set, redirects to login
     * Manager page should then not be possible to access due to session_destroyed.
     */
    public function logout()
    {
        if (isset($_SESSION['user']))
        {
            $_SESSION = array();
            session_destroy();
            header('Refresh:0');
        }
        else
        {
            header('Location:' . URL . 'start/manager');
        }
    }
}