<?php

namespace Service;

use Base\Service;

class Common extends Service
{
    public function __construct()
    {
    }

    public function getSiteUrl()
    {
        $s = empty($_SERVER["HTTPS"]) ? '' : (($_SERVER["HTTPS"] == 'on') ? 's' : '');
        $serverProtocol = strtolower($_SERVER["SERVER_PROTOCOL"]);
        $protocol = substr($serverProtocol, 0, strpos($serverProtocol, "/")).$s;

        return $protocol.'://'.$_SERVER['SERVER_NAME'];
    }
}
