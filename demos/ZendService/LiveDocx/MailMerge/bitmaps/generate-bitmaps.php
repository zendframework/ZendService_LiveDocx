<?php

include_once realpath('../../../../Bootstrap.php');


use ZendService\LiveDocx\DemoHelper as Helper;
use ZendService\LiveDocx\MailMerge;

$mailMerge = new MailMerge();

$mailMerge->setUsername(DEMOS_ZEND_SERVICE_LIVEDOCX_USERNAME)
          ->setPassword(DEMOS_ZEND_SERVICE_LIVEDOCX_PASSWORD);

$mailMerge->setLocalTemplate('template.docx');

$mailMerge->assign('software', 'Magic Graphical Compression Suite v1.9')
          ->assign('licensee', 'Daï Lemaitre')
          ->assign('company',  'Megasoft Co-operation')
          ->assign('date',     Helper::currentDate())
          ->assign('time',     Helper::currentTime())
          ->assign('city',     'Lyon')
          ->assign('country',  'France');

$mailMerge->createDocument();

// Get all bitmaps
$bitmaps = $mailMerge->getAllBitmaps(100, 'png');      // zoomFactor, format

// Get just bitmaps in specified range
//$bitmaps = $mailMerge->getBitmaps(2, 2, 100, 'png');   // fromPage, toPage, zoomFactor, format

foreach ($bitmaps as $pageNumber => $bitmapData) {
    $filename = sprintf('document-page-%d.png', $pageNumber);
    file_put_contents($filename, $bitmapData);
}

unset($mailMerge);