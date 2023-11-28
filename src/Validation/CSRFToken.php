<?php
namespace FormHandler\Security;

class CSRFToken {
    public function generateToken() {
        // Generate and return CSRF token
        return md5(uniqid(rand(), true));
    }

    public function validateToken($token) {
        // Implement token validation logic here (compare with stored token, etc.)
        // For demonstration purposes, let's assume the token is valid if it's present
        return !empty($token);
    }
}
?>
