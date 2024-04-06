<?php

function requireInput($input)
{
  if (empty($input)) {
    return true;
  }
  return false;
}
function minInput($input, $length)
{
  if (strlen($input) < $length) {
    return true;
  }
  return false;
}
function maxInput($input, $length)
{
  if (strlen($input) > $length) {
    return true;
  }
  return false;
}
function emailInput($email)
{
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return true;
  }
  return false;
}
function checkMobilePhone($phone, $allow = "/^0(10|11|15)\d{8}$/")
{
  if (!preg_match($allow, $phone)) {
    return true;
  }
  return false;
}