<?php

namespace Controller;

use Base\Controller;
use Form\SettingsForm;
use Service\User;

class SettingsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        /** @var User $user */
        $user = User::getInstance();

        if (!$user->isLoggedIn()) {
            header('Location: /account/signin', true, 401);
        }
    }

    public function indexAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return $this->updateSettings($_POST);
        }

        /** @var User $user */
        $user = User::getInstance();
        $this->viewData['user'] = $user;
        $this->viewData['settingsForm'] = new SettingsForm();

        return $this->view('settings/index');
    }

    private function updateSettings($formData)
    {
        if (!$this->isRequestAjax()) {
            exit;
        }

        /** @var User $user */
        $user = User::getInstance();
        $result = $user->updateSettings($formData);
        echo json_encode($result);

        return;

    }
}