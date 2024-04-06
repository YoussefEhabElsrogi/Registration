<?php

require './core/functions.php';

session_start();

session_destroy();

redirectPage("index.php");