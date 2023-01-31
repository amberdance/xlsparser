<?php

namespace Hard2code\XlsParser;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

interface ReportReader
{
    public function read(): Worksheet;
}