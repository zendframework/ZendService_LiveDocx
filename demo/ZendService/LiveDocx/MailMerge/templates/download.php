<?php

require_once realpath('../../../../Bootstrap.php');


use ZendService\LiveDocx\DemoHelper as Helper;
use ZendService\LiveDocx\MailMerge;

Helper::printLine(
    PHP_EOL . 'Downloading Remotely Stored Templates' .
    PHP_EOL .
    PHP_EOL
);

$mailMerge = new MailMerge();

$mailMerge->setUsername(DEMOS_ZEND_SERVICE_LIVEDOCX_USERNAME)
          ->setPassword(DEMOS_ZEND_SERVICE_LIVEDOCX_PASSWORD);

$counter = 1;
foreach ($mailMerge->listTemplates() as $result) {
    printf('%d) %s', $counter, $result['filename']);
    $template = $mailMerge->downloadTemplate($result['filename']);
    file_put_contents('downloaded-' . $result['filename'], $template);
    print(' - DOWNLOADED.' . PHP_EOL);
    $counter++;
}

print(PHP_EOL);

unset($mailMerge);
