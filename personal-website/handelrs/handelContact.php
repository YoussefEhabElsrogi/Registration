<?php

require '../core/functions.php';
require '../core/sessions.php';
require '../core/validations.php';

session_start();

$errors = [];

if (postMethod() && issetInput('name')) {
  // Loop through each POST variable and assign it to a corresponding variable
  foreach ($_POST as $key => $value) {
    $$key = reciveInput($value);
  }

  // Validate the 'name' field
  if (requireInput($name)) {
    $errors[] = 'The name field is required';
  } elseif (minInput($name, 6)) {
    $errors[] = 'The name must be at least 6 characters long';
  } elseif (maxInput($name, 15)) {
    $errors[] = 'The name must not exceed 15 characters';
  }

  // Validate the 'email' field
  if (requireInput($email)) {
    $errors[] = 'The email field is required';
  } elseif (emailInput($email)) {
    $errors[] = 'Invalid email format. Please enter a valid email address';
  }

  // Validate the 'phone' field
  if (requireInput($phone)) {
    $errors[] = 'The phone field is required';
  } elseif (checkMobilePhone($phone)) {
    $errors[] = 'Invalid mobile phone number';
  }

  // Validate the 'message' field
  if (requireInput($message)) {
    $errors[] = 'The message field is required';
  } elseif (minInput($message, 20)) {
    $errors[] = 'The message must be at least 20 characters long';
  } elseif (maxInput($message, 200)) {
    $errors[] = 'The message must not exceed 200 characters';
  }

  if (requireInput($errors)) {

    $fileName = '../json/dataContact.json';
    $fileContent = file_get_contents($fileName);

    if (!requireInput($fileContent)) {
      $currentData = json_decode($fileContent, true);
    } else {
      $currentData = [];
    }

    $newData = [
      'name' => $name,
      'email' => $email,
      'phone' => $phone,
      'message' => $message
    ];

    $currentData[] = $newData;

    $jsonData = json_encode($currentData);

    file_put_contents($fileName, $jsonData);

    $messageUser = 'Your data has been saved successfully.';

    sessionStore('success', $messageUser);

    redirectPage('../contact.php');

  } else {
    sessionStore('errors', $errors);
    redirectPage('../contact.php');
  }

} else {
  // If the form is not submitted via POST or 'name' field is not set, redirect back to the contact page
  redirectPage('../contact.php');
}
