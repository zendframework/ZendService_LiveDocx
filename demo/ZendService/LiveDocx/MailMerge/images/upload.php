<?php

require_once realpath('../../../../Bootstrap.php');


use ZendService\LiveDocx\DemoHelper as Helper;
use ZendService\LiveDocx\MailMerge;

Helper::printLine(
    PHP_EOL . 'Uploading Locally Stored Images to Server' .
    PHP_EOL .
    PHP_EOL
);

$mailMerge = new MailMerge();

$mailMerge->setUsername(DEMOS_ZEND_SERVICE_LIVEDOCX_USERNAME)
          ->setPassword(DEMOS_ZEND_SERVICE_LIVEDOCX_PASSWORD);

print('Uploading image... ');
$mailMerge->uploadImage('image-01.png');
print('DONE.' . PHP_EOL);

print('Uploading image... ');
$mailMerge->uploadImage('image-02.png');
print('DONE.' . PHP_EOL);

print(PHP_EOL);

unset($mailMerge);