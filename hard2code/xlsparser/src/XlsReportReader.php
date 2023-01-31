<?php

namespace Hard2code\XlsParser;

use Hard2code\XlsParser\Exception\FileNotFoundException;
use Hard2code\XlsParser\Exception\ReportReadingException;
use Hard2code\XlsParser\Exception\UnsupportedFileFormatException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReader;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class XlsReportReader implements ReportReader
{
    private string $fileName;
    private IReader $reader;


    /**
     * @throws ReportReadingException
     * @throws FileNotFoundException
     * @throws UnsupportedFileFormatException
     */
    public function __construct(string $fileName)
    {
        $this->checkFile($fileName);

        $this->fileName = $fileName;
        $this->reader = $this->createReader();
    }


    public function read(): Worksheet
    {
        return $this->reader->load($this->fileName)->getActiveSheet();
    }


    /**
     * @throws FileNotFoundException
     * @throws UnsupportedFileFormatException
     */
    private function checkFile(string $fileName): void
    {
        if (!file_exists($fileName)) throw new FileNotFoundException();
        if (!str_contains(pathinfo($fileName)["extension"], "xls")) throw new UnsupportedFileFormatException();
    }

    /**
     * @throws ReportReadingException
     */
    private function createReader(): IReader
    {
        try {
            $reader = IOFactory::createReaderForFile($this->fileName);
            $reader->setReadDataOnly(true);

            return $reader;
        } catch (\Exception $e) {
            throw new ReportReadingException($e);
        }
    }

}