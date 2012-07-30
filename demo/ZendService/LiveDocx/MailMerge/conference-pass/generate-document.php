<?php

include_once realpath('../../../../Bootstrap.php');


use ZendService\LiveDocx\DemoHelper as Helper;
use ZendService\LiveDocx\MailMerge;

$mailMerge = new MailMerge();

$mailMerge->setUsername(DEMOS_ZEND_SERVICE_LIVEDOCX_USERNAME)
          ->setPassword(DEMOS_ZEND_SERVICE_LIVEDOCX_PASSWORD);

/**
 * Image Source:
 * iStock_000003413016Medium_business-man-with-hands-up.jpg
 */
$photoFilename = __DIR__ . '/dailemaitre.jpg';
$photoFile     = basename($photoFilename);

if (!$mailMerge->imageExists($photoFile)) {         // pass image file *without* path
    $mailMerge->uploadImage($photoFilename);        // pass image file *with* path
}

$mailMerge->setLocalTemplate('template.docx');

$mailMerge->assign('name',        'Daï Lemaitre')
          ->assign('company',     'Megasoft Co-operation')
          ->assign('date',        Helper::currentDate())
          ->assign('image:photo', $photoFile);      // pass image file *without* path

$mailMerge->createDocument();

$document = $mailMerge->retrieveDocument('pdf');

file_put_contents('document.pdf', $document);

$mailMerge->deleteImage($photoFilename);

unset($mailMerge);