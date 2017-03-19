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
    public function logList()
    {
        $addresses = $this->dbModel->getAddresses();
        $sessions = $this->dbModel->getSessions();

        require APP . 'view/header.php';
        require APP . 'view/manager/loglist.php';
        require APP . 'view/footer.php';
    }



    public function logout()
    {
        $_SESSION = array();
        session_destroy();
        header('Location:' . URL . 'login');
    }
}