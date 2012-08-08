<?php

include_once realpath('../../../../Bootstrap.php');


use ZendService\LiveDocx\DemoHelper as Helper;
use ZendService\LiveDocx\MailMerge;

Helper::printLine(
    PHP_EOL . 'Checking For Remotely Stored Images' .
    PHP_EOL .
    PHP_EOL
);

$mailMerge = new MailMerge();

$mailMerge->setUsername(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_USERNAME)
          ->setPassword(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_PASSWORD)
          ->setService (MailMerge::SERVICE_FREE);  // for premium service, use MailMerge::SERVICE_PREMIUM

print('Checking whether an image is available... ');
if (true === $mailMerge->imageExists('image-01.png')) {
    print('EXISTS. ');
} else {
    print('DOES NOT EXIST. ');
}
print('DONE' . PHP_EOL);

print(PHP_EOL);

unset($mailMerge);