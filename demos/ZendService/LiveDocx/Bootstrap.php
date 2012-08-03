<?php

// Set used namespaces
use Zend\Loader\StandardAutoloader;
use ZendServiceDemo\LiveDocx\Helper;

// Turn up error reporting
error_reporting(E_ALL | E_STRICT);

// Library base
$base = dirname(dirname(dirname(__DIR__)));

// Set up autoloader
include_once '_autoload.php';

// Include utility class
require_once "{$base}/demos/ZendService/LiveDocx/library/ZendServiceDemo/LiveDocx/Helper.php";

// Ensure LiveDocx credentials are available
if (false === Helper::credentialsAvailable()) {
    Helper::printLine(Helper::credentialsHowTo());
    exit();
}

unset($base);
