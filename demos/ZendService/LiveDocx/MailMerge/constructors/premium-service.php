<?php

include_once realpath('../../../../Bootstrap.php');


use ZendService\LiveDocx\DemoHelper as Helper;
use ZendService\LiveDocx\MailMerge;

Helper::printLine(
    PHP_EOL . 'Using LiveDocx Premium Service' .
    PHP_EOL .
    PHP_EOL . 'This sample application illustrates how to use the Zend Framework LiveDocx component with the LiveDocx premium service.' .
    PHP_EOL .
    PHP_EOL
);

$mailMerge = new MailMerge();

$mailMerge->setWsdl    (DEMOS_ZEND_SERVICE_LIVEDOCX_PREMIUM_WSDL)
          ->setUsername(DEMOS_ZEND_SERVICE_LIVEDOCX_PREMIUM_USERNAME)
          ->setPassword(DEMOS_ZEND_SERVICE_LIVEDOCX_PREMIUM_PASSWORD);

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