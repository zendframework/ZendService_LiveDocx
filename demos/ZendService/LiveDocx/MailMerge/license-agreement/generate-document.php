<?php

include_once realpath('../../../../Bootstrap.php');


use ZendService\LiveDocx\MailMerge;
use ZendService\LiveDocx\DemoHelper as Helper;

$mailMerge = new MailMerge();

$mailMerge->setUsername(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_USERNAME)
          ->setPassword(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_PASSWORD)
          ->setService (MailMerge::SERVICE_FREE);  // for LiveDocx Premium, use MailMerge::SERVICE_PREMIUM

$mailMerge->setLocalTemplate('template.docx');

$mailMerge->assign('software', 'Magic Graphical Compression Suite v1.9')
          ->assign('licensee', 'Henry Döner-Meyer')
          ->assign('company',  'Co-Operation')
          ->assign('date',     Helper::currentDate())
          ->assign('time',     Helper::currentTime())
          ->assign('city',     'Berlin')
          ->assign('country',  'Germany');

/**
 * ALTERNATIVE: Concatenating PDF files locally - basic
 *
 * You can also assign multiple sets of data. In this case, each set of data
 * will populate the template and the resulting document (one per set of data)
 * will be appended to the previous document. Thus, in this example, we create
 * two documents that are concatenated into one PDF file.
 *
 * NOTE: In the case that you wish to generate several thousand documents that
 *       are concatenated into one PDF, please take a look at the sample
 *       application 'generate-document-pdftk.php' in this directory.
 */
/*
$fieldValues = array (
    // set 1
    array (
        'software' => 'Magic Graphical Compression Suite v2.5',
        'licensee' => 'Henry Döner-Meyer',
        'company'  => 'Megasoft Co-Operation',
        'date'     => Helper::currentDate(),
        'time'     => Helper::currentTime(),
        'city'     => 'Berlin',
        'country'  => 'Germany'
    ),
    // set 2
    array (
        'software' => 'Magic CAD Suite v1.9',
        'licensee' => 'Brüno Döner-Meyer',
        'company'  => 'Future Co-Operation',
        'date'     => Helper::currentDate(),
        'time'     => Helper::currentTime(),
        'city'     => 'Berlin',
        'country'  => 'Germany'
    )
);

$mailMerge->assign($fieldValues);
*/

$mailMerge->createDocument();

$document = $mailMerge->retrieveDocument('pdf');

file_put_contents('document.pdf', $document);

/*
 * ALTERNATIVE: Retrieve document in all supported formats
 *
 * You can also retrieve the document in all supported formats. In this case,
 * the generated document is written to the file system multiple times (one file
 * per format). This is only for exemplary purposes. In a real-world
 * application, you would probably decide on one or the other format.
 */
/*
foreach ($mailMerge->getDocumentFormats() as $format) {
    $document = $mailMerge->retrieveDocument($format);
    file_put_contents('document.' . $format, $document);
}

*/

unset($mailMerge);