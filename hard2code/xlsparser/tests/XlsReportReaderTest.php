<?php

namespace Hard2code\XlsParser;

use Hard2code\XlsParser\Exception\FileNotFoundException;
use Hard2code\XlsParser\Exception\UnsupportedFileFormatException;
use PHPUnit\Framework\TestCase;

class XlsReportReaderTest extends TestCase
{

    public function testThrowsFileNotFoundException(): void
    {
        $this->expectException(FileNotFoundException::class);
        new XlsReportReader("some.rt");
    }

    public function testThrowsUnsupportedFileFormatException(): void
    {
        $this->expectException(UnsupportedFileFormatException::class);
        new XlsReportReader("test.txt");
    }

    public function testCanReadXlsFile(): void
    {
        $reader = new XlsReportReader("test.xls");
        $this->assertNotEmpty($reader->read()->toArray());

    }

    public function testCanReadXlsxFile(): void
    {
        $reader = new XlsReportReader("test.xlsx");
        $this->assertNotEmpty($reader->read()->toArray());
    }

}
