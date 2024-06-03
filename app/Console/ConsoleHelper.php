<?php

namespace App\Console;

class ConsoleHelper
{
    public static function write(string $message, mixed $data, TextColor $color): void
    {
        fwrite(STDOUT, $color->value);
        fwrite(STDOUT, $message .': '. self::formattedData($data) . "\n");
        fwrite(STDOUT, TextColor::CLEAR->value);
    }

    public static function printAlgorithm(string $message): void
    {
        fwrite(STDOUT, 'Алгоритм: ' . $message . "\n");
    }

    private static function formattedData(mixed $data): string
    {
        if (is_string($data)) {
            return $data;
        } elseif (is_array($data)) {
            return '[' . implode(', ', $data) . ']';
        }

        return '';
    }

}