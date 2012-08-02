<?php

include_once realpath('../../../../Bootstrap.php');


use ZendService\LiveDocx\DemoHelper as Helper;
use ZendService\LiveDocx\MailMerge;

Helper::printLine(
    PHP_EOL . 'Deleting All Remotely Stored Templates' .
    PHP_EOL .
    PHP_EOL
);

$mailMerge = new MailMerge();

$mailMerge->setUsername(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_USERNAME)
          ->setPassword(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_PASSWORD)
          ->setService (MailMerge::SERVICE_FREE);

$counter = 1;
foreach ($mailMerge->listTemplates() as $result) {
    printf('%d) %s', $counter, $result['filename']);
    $mailMerge->deleteTemplate($result['filename']);
    print(' - DELETED.' . PHP_EOL);
    $counter++;
}

print(PHP_EOL);

unset($mailMerge);