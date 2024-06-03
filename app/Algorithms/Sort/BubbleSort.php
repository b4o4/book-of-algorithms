<?php

namespace App\Algorithms\Sort;

use App\Algorithms\Algorithm;
use App\Console\ConsoleHelper;
use App\Console\TextColor;

class BubbleSort extends Algorithm
{
    public static function algorithm(array &$values): void
    {
        ConsoleHelper::printAlgorithm('Сортировка пузырьком');
        ConsoleHelper::write('Входные данные', $values, TextColor::GREEN);

        $count = count($values);

        // Нет смысла запускать алгоритм, если элементов в массиве меньше 2х
        if ($count < 2) {
            return;
        }

        for ($i = 0; $i < $count; $i++) {
            /**
             * Перебираем все значения после нашего индекса, чтобы найти меньшее
             */
            for ($j = $i + 1; $j < $count; $j++) {
                if ($values[$i] > $values[$j]) {
                    /**
                     * Если наше значение меньше найденного, то меняем их местами
                     */
                    [$values[$i], $values[$j]] = [$values[$j], $values[$i]];
                }
            }
        }

        ConsoleHelper::write('Выходные данные', $values, TextColor::RED);
    }

    public static function getTestCase(): array
    {
        return [4,6,3,1,8,7,5,2,1,0];
    }
}