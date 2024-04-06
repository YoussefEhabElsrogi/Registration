<?php

require '../core/functions.php';
require '../core/sessions.php';
require '../core/validations.php';

session_start();

$errors = [];

if (postMethod() && issetInput('name')) {
  foreach ($_POST as $key => $value):

    $$key = reciveInput($value);

  endforeach;

  // Validate the 'name' field
  if (requireInput($name)) {
    $errors[] = 'The name field is required';
  } elseif (minInput($name, 6)) {
    $errors[] = 'The name must be at least 6 characters long';
  } elseif (maxInput($name, 15)) {
    $errors[] = 'The name must not exceed 15 characters';
  }

  // Validate the 'description' field
  if (requireInput($des)) {
    $errors[] = 'The description field is required';
  } elseif (minInput($des, 100)) {
    $errors[] = 'The description must be at least 100 characters long';
  } elseif (maxInput($des, 800)) {
    $errors[] = 'The description must not exceed 800 characters';
  }

  // Validate the 'image' field
  $file = $_FILES['file'];
  $name_image = $file['name'];
  $size_image = $file['size'];
  $tmp_name = $file['tmp_name'];

  if (!requireInput($name_image)) {
    $ext = pathinfo($name_image);
    $originalName = $ext['filename'];
    $originalExtension = strtolower($ext['extension']);

    $allowedExtensions = ['gif', 'png', 'jpg', 'pdf', 'webp'];
    if (checkItemInArray($originalExtension, $allowedExtensions)) {
      if ($error == UPLOAD_ERR_OK) {
        $maxFileSize = 40000;
        if ($size_image < $maxFileSize) {
          $newName = uniqid('', true) . '.' . $originalExtension;
          $destination = '../images/' . $newName;
          if (!move_uploaded_file($tmp_name, $destination)) {
            $errors[] = 'Failed to move the uploaded file';
          }
        } else {
          $errors[] = 'Your file exceeds the maximum allowed size';
        }
      } else {
        $errors[] = 'There was an error uploading your file';
      }
    } else {
      $errors[] = 'The file type is not allowed';
    }
  } else {
    $errors[] = 'Please choose an image';
  }

  if (requireInput($errors)) {
    $fileName = '../json/dataProject.json';
    $fileContent = file_get_contents($fileName);
    if (!empty($fileContent)) {
      $currentData = json_decode($fileContent, true);
    } else {
      $currentData = [];
    }

    $newData = [
      'name' => $name,
      'description' => $des,
      'nameImage' => $newName
    ];
    $currentData[] = $newData;

    $jsonData = json_encode($currentData);
    file_put_contents($fileName, $jsonData);

    sessionStore('auth', 'Your data is uploaded');

    redirectPage('../projects.php');
  } else {
    sessionStore('errors', $errors);
    redirectPage('../project.php');
  }
} else {
  redirectPage('../project.php');
}

