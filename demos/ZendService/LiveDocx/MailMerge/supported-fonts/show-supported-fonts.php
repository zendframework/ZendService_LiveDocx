<?php

include_once realpath('../../../../Bootstrap.php');


use ZendService\LiveDocx\DemoHelper as Helper;
use ZendService\LiveDocx\MailMerge;

$mailMerge = new MailMerge();

$mailMerge->setUsername(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_USERNAME)
          ->setPassword(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_PASSWORD)
          ->setService (MailMerge::SERVICE_FREE);  // for premium service, use MailMerge::SERVICE_PREMIUM

Helper::printLine(
    PHP_EOL . 'Supported Fonts' .
    PHP_EOL .
    PHP_EOL . 'The following fonts are installed on the backend server and may be used in templates. Fonts used in templates, which are NOT listed below, will be substituted. If you would like to use a font, which is not installed on the backend server, please contact your LiveDocx provider.' .
    PHP_EOL .
    PHP_EOL . Helper::arrayDecorator($mailMerge->getFontNames()) .
    PHP_EOL .
    PHP_EOL
);

unset($mailMerge);