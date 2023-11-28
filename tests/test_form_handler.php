<?php
require_once __DIR__ . '/../vendor/autoload.php';

use FormHandler\FormHandler;

$formHandler = new FormHandler\FormHandler();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postData = $_POST;

    // Filter the form input data
    foreach ($postData as $key => $value) {
        $postData[$key] = $formHandler->sanitizeInput($value);
    }

    // Handle the form submission
    $result = $formHandler->handleForm($postData);

    if ($result['success']) {
        // Form submitted successfully
        echo $result['message'];
    } else {
        // Form submission failed
        echo $result['message'];
    }
}
?>
<!-- HTML form to submit data -->
<form method="post" action="">
    <input type="text" name="name" placeholder="Name">
    <br>
    <input type="text" name="email" placeholder="Email">
    <br>
    <!-- Include CSRF token in the form -->
    <input type="hidden" name="_token" value="<?php echo $formHandler->getCSRFToken(); ?>">
    <br>
    <input type="submit" value="Submit">
</form>
