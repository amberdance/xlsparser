<?php

namespace Hard2code\XlsParser;

abstract class AbstractReaderResult implements ReaderResult
{
    public function toJSON(): string
    {
        return json_encode($this->toObjects());
    }

}