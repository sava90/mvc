<?php

namespace Base;

use Service\Token;

abstract class Form
{
    protected $formName = '';
    protected $formData;
    protected $isValid = false;
    protected $errors = [];

    public function __construct($formData = null)
    {
        $this->formData = $formData;

        if ($this->formData) {
            $this->validate();
        }
    }

    protected function validate()
    {
    }

    public function isValid()
    {
        return $this->isValid;
    }

    public function __get($field)
    {
        if (is_array($this->formData) && isset($this->formData[$field])) {
            return $this->formData[$field];
        }

        return null;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function setError($field, $notError, $errorText = '')
    {
        $error = [$field, $notError, $errorText];
        if (!$notError) {
            $this->isValid = false;
        }

        foreach ($this->errors as $key => $existError)
        {
            if ($existError[0] == $field) {
                $this->errors[$key] = $error;
                return;
            }
        }
        $this->errors[] = $error;
    }

    public function getName()
    {
        return $this->formName;
    }

    public function getFormData()
    {
        return $this->formData;
    }

    public function getToken()
    {
        /** @var Token $token */
        $token = Token::getInstance();
        return $token->getToken($this->formName);
    }
}