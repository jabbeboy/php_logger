<?php

/**
 * The manager controller
 * Is used for all manager actions like view logs, delete, logout and etc.
 * The functions (actions) should be protected against un-authorized users
 * because the session is only set by the server itself if successfully
 * authentication occur.
 */
class Manager extends CoreController
{
    /**
     * Index page for the Manager view
     */
    public function index()
    {
        if (isset($_SESSION['user']))
        {
            require APP . 'view/header.php';
            require APP . 'view/manager/index.php';
            require APP . 'view/footer.php';
        }
        else
        {
            header('location:' . URL . 'message');
        }
    }

    /**
     * Shows the menu view.
     * The logmenu saves the ip addresses and session ids in arrays that the
     * view uses and prints out in tables.
     * If no session is set, redirects to problem controller
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
            header('location:' . URL . 'message');
        }
    }

    /**
     * Gets all logs in the table and stores them in a array that is viewed
     * in the viewlogs view.
     * If no session is set, redirects to login
     */
    public function logs()
    {
        if (isset($_SESSION['user']))
        {
            $logs = $this->dbModel->getLogFields();

            require APP . 'view/header.php';
            require APP . 'view/manager/alllogs.php';
            require APP . 'view/footer.php';
        }
        else
        {
            header('location:' . URL . 'message');
        }
    }

    /**
     * Gets all logs by session id and stores in a array that is viewed
     * in the session view.
     * @param $session_id
     */
    public function session($session_id)
    {
        if (isset($session_id))
        {
            $logs = $this->dbModel->getLogsBySession($session_id);
        }
        require APP . 'view/header.php';
        require APP . 'view/manager/session.php';
        require APP . 'view/footer.php';
    }

    /**
     * Gets all logs by address and stores in a array that is viewed
     * in the viewaddress view.
     * If no session is set, redirects to problem controller
     * @param $address
     */
    public function address($address)
    {
        if (isset($_SESSION['user']))
        {
            if (isset($address))
            {
                $logs = $this->dbModel->getLogsByAddress($address);
            }
            require APP . 'view/header.php';
            require APP . 'view/manager/address.php';
            require APP . 'view/footer.php';
        }
        else
        {
            header('location:' . URL . 'message');
        }
    }



    /**
     * Views the selected by getting the html blob from the database and printing
     * it out on the html
     * If no session is set, redirects to problem controller
     * @param $sessionAndId
     */
    public function viewlog($sessionAndId)
    {
        if (isset($_SESSION['user']))
        {
            if (isset($sessionAndId))
            {
                $session_id = strtok($sessionAndId, '=');
                $id = substr($sessionAndId, strpos($sessionAndId, '=') + 1);
            }
            $log = $this->dbModel->getLogHtml($session_id, $id);

            require APP . 'view/header.php';
            require APP . 'view/manager/viewlog.php';
            require APP . 'view/footer.php';
        }
        else
        {
            header('location:' . URL . 'message');
        }
    }

    /**
     * Deletes log file from database with help of sent $log_id
     * which basically is just the $session_id concatenated with a "=" delimiter
     * and $id of from the logfiles table.
     * If no session is set, redirects to problem controller
     * @param $sessionAndId string with session_id and id
     */
    public function deleteLog($sessionAndId)
    {
        if (isset($_SESSION['user']))
        {
            if (isset($sessionAndId))
            {
                // Get the session id
                $session_id = strtok($sessionAndId, '=');

                // Get the log id
                $id = substr($sessionAndId, strpos($sessionAndId, '=') + 1);

                if ($this->dbModel->deleteLog($session_id, $id))
                {
                    header('location:' . $_SERVER['HTTP_REFERER']);
                }
            }
        }
        else
        {
            header('location:' . URL . 'message');
        }
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
            header('location:' . URL . 'message');
        }
    }
}