<?php

namespace Hard2code\XlsParser;

use Hard2code\XlsParser\Model\Subject;
use PHPUnit\Framework\TestCase;

class XlsReaderResultTest extends TestCase
{

    public function testToArray(): void
    {
        $readerXlsX = new XlsReportReader("test.xlsx");
        $readerResult = new XlsReaderResult($readerXlsX);
        $readerResult->startsWithRow(3);

        $this->assertNotEmpty($readerResult->toArray());
    }

    public function testToObjects(): void
    {
        $readerXlsX = new XlsReportReader("test.xlsx");
        $readerResult = new XlsReaderResult($readerXlsX);
        $readerResult->startsWithRow(3);

        $this->assertNotEmpty($readerResult->toObjects());
    }

    public function testToJson(): void
    {
        $readerXlsX = new XlsReportReader("test.xlsx");
        $readerResult = new XlsReaderResult($readerXlsX);

        json_decode($readerResult->startsWithRow(3)->toJSON());

        $this->assertTrue(json_last_error() === JSON_ERROR_NONE);
    }

    public function testStartsWithRow(): void
    {
        $readerXlsX = new XlsReportReader("test.xlsx");
        $readerResult = new XlsReaderResult($readerXlsX);
        /**
         * @var Subject $row
         */
        $row = $readerResult->startsWithRow(3)->toObjects()[1];

        $this->assertEquals("34100", $row->getCode());
        $this->assertEquals("Budget test2", $row->getLabel());
        $this->assertEquals("4778860,65", $row->getIncomes());
        $this->assertEquals("4590256,44", $row->getExpenses());
    }

    public function testEndsWithRow(): void
    {
        $readerXlsX = new XlsReportReader("test.xlsx");
        $readerResult = new XlsReaderResult($readerXlsX);
        /**
         * @var Subject $row
         */
        $row = $readerResult->endsWithRow(3)->toObjects()[1];

        $this->assertEquals("34000", $row->getCode());
        $this->assertEquals("Budget test1", $row->getLabel());
        $this->assertEquals("2072647,86", $row->getIncomes());
        $this->assertEquals("2142316,16", $row->getExpenses());
    }
}
