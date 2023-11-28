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

        // Validate form data
        $validationResult = $this->validator->validateFormData($postData);

        if ($validationResult['success']) {
            // Form data is valid, process it further
            // Implement your form handling logic here
            return ['success' => true, 'message' => 'Form submitted successfully.'];
        } else {
            return ['success' => false, 'message' => $validationResult['message']];
        }
    }
}
?>
