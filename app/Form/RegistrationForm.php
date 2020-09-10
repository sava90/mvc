<?php

namespace Form;

use Text;
use Base\Form;
use Service\Token;
use Service\User;

class RegistrationForm extends Form
{
    protected $formName = 'registration_form';

    protected function validate()
    {
        $this->isValid = true;
        /** @var Token $token */
        $token = Token::getInstance();

        if (!$token->checkToken($this->formData, $this->formName)) {
            $this->errors[] = [$this->formName.'_result', false, Text::$csrf];
            $this->isValid = false;
        }

        if (!isset($this->formData[$this->formName.'_email'])) {
            $this->errors[] = [$this->formName.'_email', false, Text::$email];
            $this->isValid = false;
        } elseif (!filter_var($this->formData[$this->formName.'_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = [$this->formName.'_email', false, Text::$emailCorrect];
            $this->isValid = false;
        }

        /** @var User $user */
        $user = User::getInstance();

        if($user->checkDuplicateEmail($this->formData[$this->formName.'_email'])) {
            $this->errors[] = [$this->formName.'_email', false, Text::$emailDuplicate];
            $this->isValid = false;
        }

        if (!isset($this->formData[$this->formName.'_password'])) {
            $this->errors[] = [$this->formName.'_password', false, Text::$password];
            $this->isValid = false;
        }

        if (!isset($this->formData[$this->formName.'_confirm_password'])) {
            $this->errors[] = [$this->formName.'_confirm_password', false, Text::$password];
            $this->isValid = false;
        }

        if ($this->formData[$this->formName.'_password'] != $this->formData[$this->formName.'_confirm_password']) {
            $this->errors[] = [$this->formName.'_confirm_password', false, Text::$confirmPassword];
            $this->isValid = false;
        }

        if ($this->isValid()) {
            $this->errors[] = [$this->formName.'_result', true, Text::$success];
        }

        return;
    }
}