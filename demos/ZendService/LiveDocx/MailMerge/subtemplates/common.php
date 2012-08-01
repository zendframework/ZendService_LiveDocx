<?php

include_once realpath('../../../../Bootstrap.php');


$templateFilename     = 'maintemplate.docx';    // Main template file (one that includes subtemplates).
$subTemplate1Filename = 'subtemplate1.docx';    // Subtemplate 1      (one that is included in main template).
$subTemplate2Filename = 'subtemplate2.docx';    // Subtemplate 2      (one that is included in main template).

$templateFilesnames   = array();                // An array containing the above.
$templateFilesnames[] = $templateFilename;
$templateFilesnames[] = $subTemplate1Filename;
$templateFilesnames[] = $subTemplate2Filename;