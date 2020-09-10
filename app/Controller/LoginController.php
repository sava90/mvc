<?php

namespace Controller;

use Base\Controller;
use Form\LoginForm;
use Service\User;

class LoginController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        /** @var User $user */
        $user = User::getInstance();

        if ($user->isLoggedIn()) {
            header('Location: /');
            exit;
        }
    }

    public function indexAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return $this->login($_POST);
        }

        $this->viewData['loginForm'] = new LoginForm();

        return $this->view('login/index');
    }

    private function login($formData)
    {
        if (!$this->isRequestAjax()) {
            exit;
        }

        /** @var User $user */
        $user = User::getInstance();
        $result = $user->login($formData);
        echo json_encode($result);

        return;
    }
}