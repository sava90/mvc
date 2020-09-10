<?php

namespace Service;

use Base\Service;

class Token extends Service
{
    const LENGTH_RANDOM_BYTES = 32;
    const SALT = '3x%%$bf83#dls2qgdf';

    protected function __construct()
    {
        if (!isset($_SESSION['tokens'])) {
            $_SESSION['tokens'] = [];
        }
    }

    public function generateToken()
    {
        if (function_exists('random_bytes')) {
            return bin2hex(random_bytes(self::LENGTH_RANDOM_BYTES));
        }

        return md5(time().self::SALT);
    }

    public function getToken($name = '')
    {
        if (!empty($_SESSION['tokens'][$name])) {
            return (object) $_SESSION['tokens'][$name];
        }

        $tokenValue = $this->generateToken();
        $tokenName = $this->generateToken();
        $_SESSION['tokens'][$name] = ['name' => $tokenName, 'value' => $tokenValue];

        return (object) $_SESSION['tokens'][$name];
    }

    public function checkToken(array $data = [], $name = '')
    {
        foreach ($data as $key => $value) {
            if (isset($_SESSION['tokens'][$name]) && $_SESSION['tokens'][$name]['name'] == $key && $_SESSION['tokens'][$name]['value'] == $value) {
                return true;
            }
        }

        return false;
    }
}
