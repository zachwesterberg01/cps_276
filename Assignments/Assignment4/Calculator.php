<?php
class Calculator
{
    public function calc(...$args): string
    {
        if (count($args) !== 3) {
            return $this->errorParagraph(
                'Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.'
            );
        }

        [$op, $a, $b] = $args;

        if (!is_string($op) || !$this->isValidOperator($op)) {
            return $this->errorParagraph(
                'Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.'
            );
        }

        if (!$this->isNumber($a) || !$this->isNumber($b)) {
            return $this->errorParagraph(
                'Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.'
            );
        }

        $num1 = $a + 0;
        $num2 = $b + 0;

        if ($op === "/" && $num2 == 0) {
            return $this->successParagraph($num1, $op, $num2, 'cannot divide a number by zero');
        }

        $answer = match ($op) {
            "+" => $num1 + $num2,
            "-" => $num1 - $num2,
            "*" => $num1 * $num2,
            "/" => $num1 / $num2,
        };

        return $this->successParagraph($num1, $op, $num2, $answer);
    }

    private function isValidOperator(string $op): bool
    {
        return in_array($op, ["+", "-", "*", "/"], true);
    }

    private function isNumber($value): bool
    {
        return is_int($value) || is_float($value) || (is_string($value) && is_numeric($value));
    }

    private function successParagraph($a, string $op, $b, $answerOrMessage): string
    {
        return "<p>The calculation is {$a} {$op} {$b}. The answer is {$answerOrMessage}.</p>";
    }

    private function errorParagraph(string $message): string
    {
        return "<p>{$message}</p>";
    }
}
