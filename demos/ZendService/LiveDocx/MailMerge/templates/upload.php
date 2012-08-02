<?php

include_once realpath('../../../../Bootstrap.php');


use ZendService\LiveDocx\DemoHelper as Helper;
use ZendService\LiveDocx\MailMerge;

Helper::printLine(
    PHP_EOL . 'Uploading Locally Stored Templates to Server' .
    PHP_EOL .
    PHP_EOL
);

$mailMerge = new MailMerge();

$mailMerge->setUsername(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_USERNAME)
          ->setPassword(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_PASSWORD)
          ->setService (MailMerge::SERVICE_FREE);

print('Uploading template... ');
$mailMerge->uploadTemplate('template-1.docx');
print('DONE.' . PHP_EOL);

print('Uploading template... ');
$mailMerge->uploadTemplate('template-2.docx');
print('DONE.' . PHP_EOL);

print(PHP_EOL);

unset($mailMerge);