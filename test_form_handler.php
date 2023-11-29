<?php

//if you use composer vendor then uncomment below line and comment of require_once lines

require_once 'vendor/autoload.php';
/*
require_once 'src/FormHandler/FormHandler.php';
require_once 'src/FormHandler/Validation/Validator.php';
require_once 'src/FormHandler/Security/CSRFToken.php';
*/
use FormHandler\FormHandler; // Import the FormHandler class

$formHandler = new FormHandler(); // Instantiate the FormHandler class

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

    // Access the sanitized form values
    $sanitizedData = $result['data'];

    // Access specific form values (example: name and email)
	echo '<br>';
    echo $name = $sanitizedData['name'];
	echo '<br>';
    echo  $email = $sanitizedData['email'];

    // Use the sanitized form values as needed
    // ...
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
