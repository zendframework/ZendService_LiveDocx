<?php

include_once realpath('../../../../Bootstrap.php');


use ZendService\LiveDocx\MailMerge;
use ZendService\LiveDocx\DemoHelper as Helper;

Helper::printLine(
    PHP_EOL . 'Document Access Options' .
    PHP_EOL .
    PHP_EOL . 'Documents can be protected using one or more document access option:' .
    PHP_EOL .
    PHP_EOL
);

$mailMerge = new MailMerge();

$mailMerge->setUsername(DEMOS_ZENDSERVICE_LIVEDOCX_PREMIUM_USERNAME)
          ->setPassword(DEMOS_ZENDSERVICE_LIVEDOCX_PREMIUM_PASSWORD)
          ->setService (MailMerge::SERVICE_PREMIUM);

Helper::printLine(
    implode(', ', $mailMerge->getDocumentAccessOptions()) . '.' .
    PHP_EOL .
    PHP_EOL
);

unset($mailMerge);