<?php

include_once realpath('../../../../Bootstrap.php');


use ZendService\LiveDocx\DemoHelper as Helper;
use ZendService\LiveDocx\MailMerge;

Helper::printLine(
    PHP_EOL . 'Checking For Remotely Stored Templates' .
    PHP_EOL .
    PHP_EOL
);

$mailMerge = new MailMerge();

$mailMerge->setUsername(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_USERNAME)
          ->setPassword(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_PASSWORD)
          ->setService (MailMerge::SERVICE_FREE);  // for premium service, use MailMerge::SERVICE_PREMIUM

print('Checking whether a template is available... ');
if (true === $mailMerge->templateExists('template-1.docx')) {
    print('EXISTS. ');
} else {
    print('DOES NOT EXIST. ');
}
print('DONE' . PHP_EOL);

print(PHP_EOL);

unset($mailMerge);