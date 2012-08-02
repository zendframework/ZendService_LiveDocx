<?php

include_once realpath('../../../../Bootstrap.php');


use ZendService\LiveDocx\DemoHelper as Helper;
use ZendService\LiveDocx\MailMerge;

$mailMerge = new MailMerge();

$mailMerge->setUsername(DEMOS_ZENDSERVICE_LIVEDOCX_PREMIUM_USERNAME)
          ->setPassword(DEMOS_ZENDSERVICE_LIVEDOCX_PREMIUM_PASSWORD)
          ->setService (MailMerge::SERVICE_PREMIUM);

$mailMerge->setLocalTemplate('template.docx');

$mailMerge->assign('software', 'Magic Graphical Compression Suite v1.9')
          ->assign('licensee', 'Henry Döner-Meyer')
          ->assign('company',  'Co-Operation')
          ->assign('date',     Helper::currentDate())
          ->assign('time',     Helper::currentTime())
          ->assign('city',     'Berlin')
          ->assign('country',  'Germany');

// Available on premium service only
$mailMerge->setDocumentPassword('aaaaaaaaaa');

// Available on premium service only
$mailMerge->setDocumentAccessPermissions(
    array(
        'AllowHighLevelPrinting',  // getDocumentAccessOptions() returns
        'AllowExtractContents'     // array of permitted values
    ),
    'myDocumentAccessPassword'
);

$mailMerge->createDocument();

$document = $mailMerge->retrieveDocument('pdf');

file_put_contents('document.pdf', $document);

unset($mailMerge);