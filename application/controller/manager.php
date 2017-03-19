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
        if (!isset($_SESSION['user_session']))
        {
            header('Location:' . URL . 'login');
        }
        else
        {
            require APP . 'view/header.php';
            require APP . 'view/home/index.php';
            require APP . 'view/footer.php';
        }
    }

    public function logout()
    {
        $_SESSION = array();
        session_destroy();
        header('Location:' . URL . 'login');
    }
}