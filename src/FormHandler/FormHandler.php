<?php
namespace FormHandler;

use FormHandler\Security\CSRFToken;
use FormHandler\Validation\Validator;

class FormHandler {
    private $validator;
    private $csrfToken;

    public function __construct() {
        $this->validator = new Validator();
        $this->csrfToken = new CSRFToken();
    }

  public function handleForm($postData) {
    // Validate CSRF token
    if (!$this->csrfToken->validateToken($postData['_token'])) {
        return ['success' => false, 'message' => 'CSRF token validation failed.'];
    }

    // Sanitize the form input data
    $sanitizedData = [];
    foreach ($postData as $key => $value) {
        $sanitizedData[$key] = $this->sanitizeInput($value);
    }

    // Validate form data
    $validationResult = $this->validator->validateFormData($sanitizedData);

    if ($validationResult['success']) {
        // Form data is valid, return sanitized data and success message
        return ['success' => true, 'message' => 'Form submitted successfully.', 'data' => $sanitizedData];
    } else {
        return ['success' => false, 'message' => $validationResult['message']];
    }
}


    public function sanitizeInput($input) {
        // Implement your input sanitization logic here
        // For example, you can use htmlspecialchars to prevent XSS attacks
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }

    public function getCSRFToken() {
        return $this->csrfToken->generateToken();
    }
}
?>