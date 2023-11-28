<?php
namespace FormHandler\Validation;

class Validator {
    public function validateFormData($data) {
        // Implement your form validation logic here
        // Example validation
        if (empty($data['name']) || empty($data['email'])) {
            return ['success' => false, 'message' => 'Name and Email are required.'];
        }

        // Additional validation rules can be added here

        return ['success' => true, 'message' => 'Form data is valid.'];
    }
}
?>
