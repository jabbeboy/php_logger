<?php

/**
 *
 * @author jakobwango
 * @date 2017-03-08
 */
class Manager extends Controller
{
    public function index()
    {
        require APP . 'view/header.php';
        require APP . 'view/manager/index.php';
        require APP . 'view/footer.php';
    }

    /**
     * Shows the logmenu view.
     * The logmenu saves the ip addresses and session ids in arrays that the
     * view uses and prints out in tables.
     * If no session is set, redirects to login
     */
    public function menu()
    {
        $addresses = $this->dbModel->getAddresses();
        $sessions = $this->dbModel->getSessions();

        require APP . 'view/header.php';
        require APP . 'view/manager/menu.php';
        require APP . 'view/footer.php';
    }

    public function logs()
    {
        $logInfo = $this->dbModel->getLogInfoFields();

        require APP . 'view/header.php';
        require APP . 'view/manager/logs.php';
        require APP . 'view/footer.php';

    }

    public function session()
    {
        if (isset($session_id))
        {
            $sessions = $this->dbModel->getLogsBySession($session_id);

            var_dump($sessions);
        }
        #require APP . 'view/header.php';
        #require APP . 'view/manager/log_session.php';
        #require APP . 'view/footer.php';
    }

    public function address()
    {
        if (isset($address))
        {
            $addresses = $this->dbModel->getLogsByAddress($address);
        }
        require APP . 'view/header.php';
        require APP . 'view/manager/log_address.php';
        require APP . 'view/footer.php';
    }

    public function logout()
    {
        $_SESSION = array();
        session_destroy();
        header('location:' . URL . 'start/manager');
    }
}