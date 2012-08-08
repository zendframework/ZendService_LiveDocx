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

$mailMerge->setUsername(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_USERNAME)
          ->setPassword(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_PASSWORD)
          ->setService (MailMerge::SERVICE_FREE);  // for LiveDocx Premium, use MailMerge::SERVICE_PREMIUM

// -----------------------------------------------------------------------------

foreach ($templateFilesnames as $filename) {

    if ($mailMerge->templateExists($filename)) {
        $mailMerge->deleteTemplate($filename);
    }

    $mailMerge->uploadTemplate($filename);
}

// -----------------------------------------------------------------------------

$mailMerge->setIgnoreSubTemplates(true);            // <-- Does NOT include any sub-templates.

$mailMerge->setRemoteTemplate($templateFilename);

$mailMerge->createDocument();

$document = $mailMerge->retrieveDocument('pdf');

file_put_contents('document-ignore-1.pdf', $document);

// -----------------------------------------------------------------------------

$mailMerge->setIgnoreSubTemplates(false);           // <-- Includes all sub-templates.
                                                    //     Default, when setIgnoreSubTemplates is not called.
$mailMerge->setRemoteTemplate($templateFilename);

$mailMerge->createDocument();

$document = $mailMerge->retrieveDocument('pdf');

file_put_contents('document-ignore-2.pdf', $document);

// -----------------------------------------------------------------------------

unset($mailMerge);