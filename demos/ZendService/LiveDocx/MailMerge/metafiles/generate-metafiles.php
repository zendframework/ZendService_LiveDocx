<?php

include_once realpath('../../../../Bootstrap.php');


use ZendService\LiveDocx\DemoHelper as Helper;
use ZendService\LiveDocx\MailMerge;

$mailMerge = new MailMerge();

$mailMerge->setUsername(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_USERNAME)
          ->setPassword(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_PASSWORD)
          ->setService (MailMerge::SERVICE_FREE);  // for LiveDocx Premium, use MailMerge::SERVICE_PREMIUM

$mailMerge->setLocalTemplate('template.docx');

$mailMerge->setFieldValue('software', 'Magic Graphical Compression Suite v1.9')
          ->setFieldValue('licensee', 'Henry Döner-Meyer')
          ->setFieldValue('company',  'Megasoft Co-operation')
          ->setFieldValue('date',     Helper::currentDate())
          ->setFieldValue('time',     Helper::currentTime())
          ->setFieldValue('city',     'Bremen')
          ->setFieldValue('country',  'Germany');

$mailMerge->createDocument();

// Get all metafiles
$metaFiles = $mailMerge->getAllMetafiles();

// Get just metafiles in specified range
//$metaFiles = $mailMerge->getMetafiles(1, 2);    // fromPage, toPage

foreach ($metaFiles as $pageNumber => $metaFileData) {
    $filename = sprintf('document-page-%d.wmf', $pageNumber);
    file_put_contents($filename, $metaFileData);
}

unset($mailMerge);