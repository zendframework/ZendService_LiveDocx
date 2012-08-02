<?php

include_once realpath('./common.php');


/**
 * The following variables are defined in the included 'common.php' file:
 *
 * (string) $templateFilename       Main template file (one that includes subtemplates).
 * (string) $subTemplate1Filename   Subtemplate 1      (one that is included in main template).
 * (string) $subTemplate2Filename   Subtemplate 2      (one that is included in main template).
 *
 * (array)  $templateFilesnames     An array containing the above.
 */


use ZendService\LiveDocx\MailMerge;

$mailMerge = new MailMerge();

$mailMerge->setUsername(DEMOS_ZENDSERVICE_LIVEDOCX_PREMIUM_USERNAME)
          ->setPassword(DEMOS_ZENDSERVICE_LIVEDOCX_PREMIUM_PASSWORD)
          ->setService (MailMerge::SERVICE_PREMIUM);

// -----------------------------------------------------------------------------

foreach ($templateFilesnames as $filename) {

    if ($mailMerge->templateExists($filename)) {
        $mailMerge->deleteTemplate($filename);
    }

    $mailMerge->uploadTemplate($filename);
}

// -----------------------------------------------------------------------------

$mailMerge->setSubTemplateIgnoreList(array($subTemplate1Filename, $subTemplate2Filename));

$mailMerge->setRemoteTemplate($templateFilename);

$mailMerge->createDocument();

$document = $mailMerge->retrieveDocument('pdf');

file_put_contents('document-ignore-list-1.pdf', $document);

// -----------------------------------------------------------------------------

$mailMerge->setSubTemplateIgnoreList(array($subTemplate1Filename));

$mailMerge->setRemoteTemplate($templateFilename);

$mailMerge->createDocument();

$document = $mailMerge->retrieveDocument('pdf');

file_put_contents('document-ignore-list-2.pdf', $document);

// -----------------------------------------------------------------------------

$mailMerge->setSubTemplateIgnoreList(array($subTemplate2Filename));

$mailMerge->setRemoteTemplate($templateFilename);

$mailMerge->createDocument();

$document = $mailMerge->retrieveDocument('pdf');

file_put_contents('document-ignore-list-3.pdf', $document);

// -----------------------------------------------------------------------------

unset($mailMerge);