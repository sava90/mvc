<?php

namespace Controller;

use Base\Controller;

class LogoutController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        session_destroy();
        header('Location: /');
        exit;
    }
}