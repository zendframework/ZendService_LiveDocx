<?php

include_once realpath('../../../../Bootstrap.php');


use ZendService\LiveDocx\DemoHelper as Helper;
use ZendService\LiveDocx\MailMerge;

Helper::printLine(
    PHP_EOL . 'Using LiveDocx Free' .
    PHP_EOL .
    PHP_EOL . 'This sample application illustrates how to use the Zend Framework LiveDocx component with the LiveDocx Free.' .
    PHP_EOL .
    PHP_EOL
);

// -----------------------------------------------------------------------------

// Pass login credentials using set methods

$mailMerge = new MailMerge();

$mailMerge->setUsername(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_USERNAME)
          ->setPassword(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_PASSWORD)
          ->setService (MailMerge::SERVICE_FREE);  // for LiveDocx Premium, use MailMerge::SERVICE_PREMIUM

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
    'username' => DEMOS_ZENDSERVICE_LIVEDOCX_FREE_USERNAME,
    'password' => DEMOS_ZENDSERVICE_LIVEDOCX_FREE_PASSWORD,
     'service' => MailMerge::SERVICE_FREE));  // for LiveDocx Premium, use MailMerge::SERVICE_PREMIUM

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