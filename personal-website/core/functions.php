<?php

function getRequestType()
{
  return $_SERVER['REQUEST_METHOD'];
}
function postMethod()
{
  if (getRequestType() === 'POST') {
    return true;
  }
  return false;
}
function reciveInput($input)
{
  return htmlspecialchars(htmlentities(stripcslashes(trim($input))));
}
function issetInput($input)
{
  return isset($input);
}
function sameInput($input1, $input2)
{
  if ($input1 === $input2) {
    return true;
  }
  return false;
}
function redirectPage($path)
{
  header("Location: $path");
  exit;
}
function checkItemInArray($input, $array)
{
  return in_array($input, $array, true);
}