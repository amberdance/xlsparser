<?php

namespace Hard2code\XlsParser\Model;

class Subject implements \JsonSerializable
{

    private string $label;
    private string $code;
    private string $incomes;
    private string $expenses;

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getIncomes(): string
    {
        return $this->incomes;
    }

    /**
     * @return string
     */
    public function getExpenses(): string
    {
        return $this->expenses;
    }

    /**
     * @param string $label
     * @param string $code
     * @param string $income
     * @param string $expenses
     */
    public function __construct(string $label, string $code, string $income, string $expenses)
    {
        $this->label = $label;
        $this->code = $code;
        $this->incomes = $this->formatDigits($income);
        $this->expenses = $this->formatDigits($expenses);
    }


    public static function parseCode(string $input): string
    {
        preg_match("/\d{5}/", $input, $matches);

        return count($matches) ? $matches[0] : "null";
    }

    public static function parseLabel(string $input): string
    {
        return trim(preg_replace("/(\d{5})|-/", "", $input)) ?? "null";
    }

    private function formatDigits(string $input): string
    {
        return str_replace(".", ",", $input);
    }

    public function jsonSerialize(): array
    {
        return [
            "label" => $this->label,
            "code" => $this->code,
            "incomes" => $this->incomes,
            "expenses" => $this->expenses
        ];
    }
}