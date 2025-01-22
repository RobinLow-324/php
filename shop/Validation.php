<?php
class Validation
{

    private $errors = array();

    public function validateRequired($value, $fieldName)
    {
        if (empty($value)) {
            $this->addError("The $fieldName field is required.");
        }
    }

    public function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->addError("The email address is not valid.");
        }
    }

    public function validatePasswordLength($password)
    {
        if (strlen($password) < 6) {
            $this->addError("Password must be at least 6 characters long.");
        }
    }

    private function addError($message)
    {
        $this->errors[] = $message;
    }

    public function isValid()
    {
        return empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
