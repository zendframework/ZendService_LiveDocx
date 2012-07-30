<?php

require_once realpath('../../../../Bootstrap.php');


use ZendService\LiveDocx\DemoHelper as Helper;
use ZendService\LiveDocx\MailMerge;

Helper::printLine(
    PHP_EOL . 'Remotely Stored Templates' .
    PHP_EOL . 
    PHP_EOL . 'The following templates are currently stored on the LiveDocx server:' .
    PHP_EOL .
    PHP_EOL
);

$mailMerge = new MailMerge();

$mailMerge->setUsername(DEMOS_ZEND_SERVICE_LIVEDOCX_USERNAME)
          ->setPassword(DEMOS_ZEND_SERVICE_LIVEDOCX_PASSWORD);

print(Helper::listDecorator($mailMerge->listTemplates()));

unset($mailMerge);
