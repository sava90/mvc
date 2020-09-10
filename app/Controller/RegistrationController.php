<?php

namespace Controller;

use Base\Controller;
use Form\RegistrationForm;
use Service\User;

class RegistrationController extends Controller
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
            return $this->registration($_POST);
        }

        $this->viewData['registrationForm'] = new RegistrationForm();

        return $this->view('registration/index');
    }

    private function registration($formData)
    {
        if (!$this->isRequestAjax()) {
            exit;
        }
        /** @var User $user */
        $user = User::getInstance();
        $result = $user->createAccount($formData);
        echo json_encode($result);

        return;
    }
}