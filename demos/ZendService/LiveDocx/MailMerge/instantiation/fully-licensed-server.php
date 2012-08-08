<?php

include_once realpath('../../../../Bootstrap.php');


use ZendService\LiveDocx\DemoHelper as Helper;
use ZendService\LiveDocx\MailMerge;

Helper::printLine(
    PHP_EOL . 'Using LiveDocx Fully Licensed' .
    PHP_EOL .
    PHP_EOL . 'This sample application illustrates how to use the Zend Framework LiveDocx component with the LiveDocx running in your own network.' .
    PHP_EOL .
    PHP_EOL
);

// -----------------------------------------------------------------------------

// Pass login credentials using set methods

$mailMerge = new MailMerge();

$mailMerge->setUsername('your-username')                                   // set your username here
          ->setPassword('your-password')                                   // set your password here
          ->setWsdl    ('http://api.example.com/2.1/mailmerge.asmx?wsdl'); // set the WSDL of your locally installed,
                                                                           // LiveDocx Fully Licensed server here
$mailMerge->getTemplateFormats(); // then call methods as usual

printf('Username : %s%sPassword : %s%s    WSDL : %s%s%s',
    $mailMerge->getUsername(),
    PHP_EOL,
    $mailMerge->getPassword(),
    PHP_EOL,
    $mailMerge->getWsdl(),
    PHP_EOL,
    PHP_EOL
);

unset($mailMerge);

// -----------------------------------------------------------------------------

// Pass login credentials using constructor

$mailMerge = new MailMerge();

$mailMerge = new MailMerge(array(
    'username' => 'your-username',                                         // set your username here
    'password' => 'your-password',                                         // set your password here
        'wsdl' => 'http://api.example.com/2.1/mailmerge.asmx?wsdl'));      // set the WSDL of your
                                                                           // LiveDocx Fully Licensed server here
$mailMerge->getTemplateFormats(); // then call methods as usual

printf('Username : %s%sPassword : %s%s    WSDL : %s%s%s',
    $mailMerge->getUsername(),
    PHP_EOL,
    $mailMerge->getPassword(),
    PHP_EOL,
    $mailMerge->getWsdl(),
    PHP_EOL,
    PHP_EOL
);

unset($mailMerge);

// -----------------------------------------------------------------------------