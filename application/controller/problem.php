<?php

/**
 * The problem controller
 * Is mostly used when a bad request occur by the users.
 */
class Problem extends CoreController
{
    /**
     * Problem index view
     * This method handles the error page that will be shown when a page or action is not found.
     */
    public function index()
    {
        // Load views
        require APP . 'view/header.php';
        require APP . 'view/problem/index.php';
        require APP . 'view/footer.php';
    }
}
