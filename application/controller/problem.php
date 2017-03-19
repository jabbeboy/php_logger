<?php


class Problem extends Controller
{

    public function index()
    {
        // load views
        require APP . 'view/header.php';
        require APP . 'view/problem.php';
        require APP . 'view/footer.php';
    }
}
