<?php

include_once realpath('../../../../Bootstrap.php');


use ZendService\LiveDocx\DemoHelper as Helper;
use ZendService\LiveDocx\MailMerge;

Helper::printLine(
    PHP_EOL . 'Downloading Remotely Stored Images' .
    PHP_EOL .
    PHP_EOL
);

$mailMerge = new MailMerge();

$mailMerge->setUsername(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_USERNAME)
          ->setPassword(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_PASSWORD)
          ->setService (MailMerge::SERVICE_FREE);  // for premium service, use MailMerge::SERVICE_PREMIUM

$counter = 1;
foreach ($mailMerge->listImages() as $result) {
    printf('%d) %s', $counter, $result['filename']);
    $image = $mailMerge->downloadImage($result['filename']);
    file_put_contents('downloaded-' . $result['filename'], $image);
    print(' - DOWNLOADED.' . PHP_EOL);
    $counter++;
}

print(PHP_EOL);

unset($mailMerge);