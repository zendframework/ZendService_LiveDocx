<?php

include_once realpath('../../../../Bootstrap.php');


use ZendService\LiveDocx\DemoHelper as Helper;
use ZendService\LiveDocx\MailMerge;

Helper::printLine(
    PHP_EOL . 'Template, Document and Image Formats' .
    PHP_EOL .
    PHP_EOL . 'The following formats are supported by LiveDocx:' .
    PHP_EOL .
    PHP_EOL
);

$mailMerge = new MailMerge();

$mailMerge->setUsername(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_USERNAME)
          ->setPassword(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_PASSWORD)
          ->setService (MailMerge::SERVICE_FREE);  // for LiveDocx Premium, use MailMerge::SERVICE_PREMIUM

printf("Supported TEMPLATE file formats (input)  : %s%s",
    Helper::arrayDecorator($mailMerge->getTemplateFormats()), PHP_EOL);

printf("Supported DOCUMENT file formats (output) : %s%s",
    Helper::arrayDecorator($mailMerge->getDocumentFormats()), PHP_EOL);

printf("Supported IMAGE file formats (output)    : %s%s",
    Helper::arrayDecorator($mailMerge->getImageExportFormats()), PHP_EOL);

print PHP_EOL;

unset($mailMerge);