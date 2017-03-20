<?php

/**
 * The problem controller
 * Is mostly used when a bad request occur by the users.
 */
class Message extends CoreController
{
    /**
     * Problem index view
     * This method handles the error page that will be shown when a page or action is not found.
     */
    public function index()
    {
        require APP . 'view/header.php';
        require APP . 'view/message/index.php';
        require APP . 'view/footer.php';
    }

    public function success()
    {
        require APP . 'view/header.php';
        require APP . 'view/message/success.php';
        require APP . 'view/footer.php';
    }
}
