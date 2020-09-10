<?php

namespace Service;

use Base\{Service, Template};

class Notifier extends Service
{
    use Template;

    public function sendVerifyAccount($userId, $email, $verifyKey)
    {
        $subject = 'Verify Your Account';
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html;' . "\r\n";

        /** @var Common $common */
        $common = Common::getInstance();
        $this->viewData['siteName'] = $common->getSiteUrl();
        $this->viewData['userId'] = $userId;
        $this->viewData['verifyKey'] = $verifyKey;

        $body = $this->fetch('email/confirmRegistration', $this->viewData);

        $result = mail($email, $subject, $body, $headers);

        return $result;
    }
}
