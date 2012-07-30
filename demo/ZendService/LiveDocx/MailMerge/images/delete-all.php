<?php

require_once realpath('../../../../Bootstrap.php');


use ZendService\LiveDocx\DemoHelper as Helper;
use ZendService\LiveDocx\MailMerge;

Helper::printLine(
    PHP_EOL . 'Deleting All Remotely Stored Images' .
    PHP_EOL .
    PHP_EOL
);

$mailMerge = new MailMerge();

$mailMerge->setUsername(DEMOS_ZEND_SERVICE_LIVEDOCX_USERNAME)
          ->setPassword(DEMOS_ZEND_SERVICE_LIVEDOCX_PASSWORD);

$counter = 1;
foreach ($mailMerge->listImages() as $result) {
    printf('%d) %s', $counter, $result['filename']);
    $mailMerge->deleteImage($result['filename']);
    print(' - DELETED.' . PHP_EOL);
    $counter++;
}

print(PHP_EOL);

unset($mailMerge);
