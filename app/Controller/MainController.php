<?php

namespace Controller;

use Base\Controller;
use Service\User;

class MainController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        /** @var User $user */
        $user = User::getInstance();
        $this->viewData['users'] = $user->getUsers();

        return $this->view('main/index');
    }
}