<?php
error_reporting(-1);
require 'vendor/autoload.php';
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/4/2016
 * Time: 9:53 AM
 */
//unset($_SESSION);
session_destroy();
header('Location: http://localhost/maternal/login.php');