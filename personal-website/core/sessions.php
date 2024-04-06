<?php

function sessionStore($key, $value)
{
  $_SESSION[$key] = $value;
}
function issetSession($key)
{
  if (isset($_SESSION[$key])) {
    return true;
  }
  return false;
}
function removeSession($key)
{
  unset($_SESSION[$key]);
}