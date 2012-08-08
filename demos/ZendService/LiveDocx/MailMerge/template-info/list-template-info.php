<?php

include_once realpath('../../../../Bootstrap.php');


use ZendService\LiveDocx\DemoHelper as Helper;
use ZendService\LiveDocx\MailMerge;

Helper::printLine(
    PHP_EOL . 'Field and Block Field Names (merge fields)' .
    PHP_EOL .
    PHP_EOL . 'The following templates contain the listed field or block field names:' .
    PHP_EOL .
    PHP_EOL
);

$mailMerge = new MailMerge();

$mailMerge->setUsername(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_USERNAME)
          ->setPassword(DEMOS_ZENDSERVICE_LIVEDOCX_FREE_PASSWORD)
          ->setService (MailMerge::SERVICE_FREE);  // for LiveDocx Premium, use MailMerge::SERVICE_PREMIUM

// -----------------------------------------------------------------------------

$templateName = 'template-1-text-field.docx';

$mailMerge->setLocalTemplate($templateName);

printf('Field names in %s:%s', $templateName, PHP_EOL);

$fieldNames = $mailMerge->getFieldNames();
foreach ($fieldNames as $fieldName) {
    printf('- %s%s', $fieldName, PHP_EOL);
}

// -----------------------------------------------------------------------------

$templateName = 'template-2-text-fields.doc';

$mailMerge->setLocalTemplate($templateName);

printf('%sField names in %s:%s', PHP_EOL, $templateName, PHP_EOL);

$fieldNames = $mailMerge->getFieldNames();
foreach ($fieldNames as $fieldName) {
    printf('- %s%s', $fieldName, PHP_EOL);
}

// -----------------------------------------------------------------------------

$templateName = 'template-block-fields.doc';

$mailMerge->setLocalTemplate($templateName);

printf('%sField names in %s:%s', PHP_EOL, $templateName, PHP_EOL);

$fieldNames = $mailMerge->getFieldNames();
foreach ($fieldNames as $fieldName) {
    printf('- %s%s', $fieldName, PHP_EOL);
}

printf('%sBlock names in %s:%s', PHP_EOL, $templateName, PHP_EOL);

$blockNames = $mailMerge->getBlockNames();
foreach ($blockNames as $blockName) {
    printf('- %s%s', $blockName, PHP_EOL);
}

printf('%sBlock field names in %s:%s', PHP_EOL, $templateName, PHP_EOL);

foreach ($blockNames as $blockName) {
    $blockFieldNames = $mailMerge->getBlockFieldNames($blockName);
    foreach ($blockFieldNames as $blockFieldName) {
        printf('- %s::%s%s', $blockName, $blockFieldName, PHP_EOL);
    }
}

print(PHP_EOL);

// -----------------------------------------------------------------------------

unset($mailMerge);