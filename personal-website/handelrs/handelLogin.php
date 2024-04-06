<?php

require '../core/functions.php';
require '../core/sessions.php';
require '../core/validations.php';

session_start();

$errors = [];

$email_admin = 'youssefelsrogi@gmail.com';
$password_admin = sha1('youssefehab');

if (postMethod() && issetInput('name')):

  foreach ($_POST as $key => $value):

    $$key = reciveInput($value);

  endforeach;
  if (requireInput($email)):
    $errors[] = 'The email field is required';
  elseif (emailInput($email)):
    $errors[] = 'Invalid email format. Please enter a valid email address';
  endif;

  if (requireInput($password)):
    $errors[] = 'This password is required';
  elseif (minInput($password, 6)):
    $errors[] = 'The password must be at least 6 characters long';
  elseif (maxInput($password, 15)):
    $errors[] = 'The  password must not exceed 15 characters';
  endif;

  if (requireInput($errors)):
    if (sameInput($email_admin, $email) && sameInput($password_admin, sha1($password))):
      sessionStore('email', $email);
      sessionStore('admin', 'is_admin');
      redirectPage('../index.php');
    else:
      redirectPage('../login.php');
    endif;
  else:
    sessionStore('errors', $errors);
    redirectPage('../login.php');
  endif;

else:
  redirectPage('../login.php');
endif;