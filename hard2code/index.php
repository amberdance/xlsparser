<?php

use Hard2code\XlsParser\XlsReaderResult;
use Hard2code\XlsParser\XlsReportReader;

require __DIR__ . "/xlsparser/vendor/autoload.php";

$xlsReportReader = new XlsReportReader("report.xlsx");
$reportReaderResult = new XlsReaderResult($xlsReportReader);
$reportReaderResult->startsWithRow(4)->endsWithRow(36);

echo "<pre>";
var_dump($reportReaderResult->toArray());
var_dump($reportReaderResult->toObjects());
echo "</pre>";

var_dump($reportReaderResult->toJSON());



