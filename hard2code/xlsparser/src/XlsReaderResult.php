<?php

namespace Hard2code\XlsParser;

use Hard2code\XlsParser\Model\Subject;

class XlsReaderResult extends AbstractReaderResult
{
    private ReportReader $reader;
    private int $startRowIndex;
    private int $endRowIndex;
    private array $rawResult;


    public function __construct(ReportReader $reader)
    {
        $this->reader = $reader;
        $this->rawResult = $this->reader->read()->toArray();
        $this->startRowIndex = 0;
        $this->endRowIndex = 0;
    }

    public function toArray(): array
    {
        return json_decode($this->toJSON(), true);
    }

    public function toObjects(): array
    {
        $result = [];

        foreach ($this->trimArray() as $row) {
            if (empty($row[0])) continue;

            $result[] = new Subject(Subject::parseLabel($row[1]), Subject::parseCode($row[1]), $row[2], $row[3]);
        }

        return $result;
    }


    /**
     * @param int $index index of position of row (based from 1)
     * @return $this
     */
    public function startsWithRow(int $index): XlsReaderResult
    {
        $this->startRowIndex = $index;

        return $this;
    }

    /**
     * @param int $index index of position of row that should be last (based from 1)
     * @return $this
     */
    public function endsWithRow(int $index): XlsReaderResult
    {
        $this->endRowIndex = $index;

        return $this;
    }

    private function trimArray(): array
    {
        $result = $this->rawResult;

        if ($this->endRowIndex > 0)
            array_splice($result, $this->endRowIndex, count($this->rawResult) - $this->endRowIndex);

        if ($this->startRowIndex > 0)
            array_splice($result, 0, $this->startRowIndex - 1);


        return $result;
    }

}