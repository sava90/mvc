<?php

namespace Service;

use Form\SettingsForm;
use Text;
use Base\Service;
use Form\LoginForm;
use Form\RegistrationForm;
use Model\UserModel;

class User extends Service
{
    protected function __construct()
    {
        $userId = isset($_SESSION['userId']) ? (int)$_SESSION['userId'] : 0;
        $this->model = new UserModel($userId);
    }

    public function getUsers()
    {
        return $this->model->getUsers();
    }

    public function isLoggedIn()
    {
        return $this->model->userId ? (int)$this->model->userId : false;
    }

    public function checkDuplicateEmail($email)
    {
        return $this->model->checkDuplicateEmail($email);
    }

    public function createAccount(array $formData = [])
    {
        $registrationForm = new RegistrationForm($formData);

        if (!$registrationForm->isValid()) {
            return $registrationForm->getErrors();
        }

        $email = $formData[$registrationForm->getName().'_email'];
        $password = password_hash($formData[$registrationForm->getName().'_password'], PASSWORD_BCRYPT);
        $date = date('Y-m-d H:i:s', time());
        $verifyKey = sha1('verification email '.$date.$email);

        $lastInsertId = $this->model->createAccount($email, $password, $date, $verifyKey);

        if ($lastInsertId) {
            /** @var Notifier $notifier */
            $notifier = Notifier::getInstance();
            $notifier->sendVerifyAccount($lastInsertId, $email, $verifyKey);
            $registrationForm->setError($registrationForm->getName().'_result', true, Text::$confirmRegistration);

            return $registrationForm->getErrors();
        }

        $registrationForm->setError($registrationForm->getName().'_result', false, Text::$error);

        return $registrationForm->getErrors();
    }

    public function login(array $formData = [])
    {
        $loginForm = new LoginForm($formData);

        if (!$loginForm->isValid()) {
            return $loginForm->getErrors();
        }

        $email = $formData[$loginForm->getName().'_email'];
        $password = $formData[$loginForm->getName().'_password'];

        $userData = $this->model->getUserByEmail($email);

        if (!$userData->active) {
            $loginForm->setError($loginForm->getName().'_result', false, Text::$error);

            return $loginForm->getErrors();
        }

        if (password_verify($password, $userData->password)) {
            $loginForm->setError($loginForm->getName().'_result', true, Text::$success);
            $_SESSION['userId'] = $userData->userId;
            return $loginForm->getErrors();
        }

        $loginForm->setError($loginForm->getName().'_result', false, Text::$error);

        return $loginForm->getErrors();
    }

    public function verifyAccount($userId, $key)
    {
        $this->model = new UserModel($userId);
        $verifyKey = sha1('verification email '.$this->createDate.$this->email);

        if ($verifyKey == $key) {
            return $this->model->verifyAccount($userId);
        }

        return false;
    }

    public function updateSettings(array $formData = [])
    {
        $settingsForm = new SettingsForm($formData);

        if (!$settingsForm->isValid()) {
            return $settingsForm->getErrors();
        }

        $firstName = $formData[$settingsForm->getName().'_first_name'];
        $lastName = $formData[$settingsForm->getName().'_last_name'];
        $subscribe = isset($formData[$settingsForm->getName().'_subscribe']) ? 1 : 0;

        $result = $this->model->updateSettings($this->userId, $firstName, $lastName, $subscribe);

        if ($result) {
            $settingsForm->setError($settingsForm->getName().'_result', true, Text::$success);

            return $settingsForm->getErrors();
        }

        $settingsForm->setError($settingsForm->getName().'_result', false, Text::$error);

        return $settingsForm->getErrors();
    }
}