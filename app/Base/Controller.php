<?php

namespace Base;

use Service\User;

abstract class Controller
{
    protected $viewData = [];

    protected function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        /** @var User $user */
        $user = User::getInstance();
        $this->viewData['loggedIn'] = $user->isLoggedIn();
    }

    protected function view($viewName, $dataArray = null)
    {
        $dataArray = $dataArray ? $dataArray : $this->viewData;
        extract($dataArray, EXTR_PREFIX_ALL, 'view');

        if (is_file(__DIR__ . '/../View/' . $viewName . '.php')) {
            require_once(__DIR__ . '/../View/' . $viewName . '.php');
        }

        return;
    }

    public function isRequestAjax()
    {
        if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
            http_response_code(406);
            exit();
        }

        return true;
    }
}