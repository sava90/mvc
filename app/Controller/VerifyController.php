<?php

namespace Controller;

use Base\Controller;
use Service\User;

class VerifyController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $userId = !empty($_GET['uid']) ? (int) $_GET['uid'] : 0;
        $key = !empty($_GET['key']) ? $_GET['key'] : '';

        if (!$userId || !$key) {
            header('Location: /');
            exit();
        }

        /** @var User $user */
        $user = User::getInstance();
        $result = $user->verifyAccount($userId, $key);

        $this->viewData['result'] = $result;

        return $this->view('verify/index');
    }
}