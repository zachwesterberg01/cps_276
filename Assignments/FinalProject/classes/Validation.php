<?php
class Validation {
    private $errors = [];

    // Check format based on regex type and set custom error message if provided
    public function checkFormat($value, $type, $customErrorMsg = null) {
        $patterns = [
            'name'     => '/^[a-z\'\s-]{1,50}$/i',
            'phone'    => '/^\d{3}\.\d{3}\.\d{4}$/',
            'address'  => '/^\d+\s[a-zA-Z0-9\s,.\'-]+$/',
            'zip'      => '/^\d{5}(-\d{4})?$/',
            'email'    => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'dob'      => '/^(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])\/[0-9]{4}$/',
            'password' => '/^[\w\W]{1,}$/',
            'none'     => '/.*/'
        ];
            
        // Use a generic default pattern if the type is not defined
        $pattern = $patterns[$type] ?? '/.*/';

        if (!preg_match($pattern, $value)) {
            $errorMessage = $customErrorMsg ?? "Invalid $type format.";
            $this->errors[$type] = $errorMessage;
            return false;
        }
        return true;
    }

    // Get all validation errors
    public function getErrors() {
        return $this->errors;
    }

    // Check if there are any errors
    public function hasErrors() {
        return !empty($this->errors);
    }
}
?>
