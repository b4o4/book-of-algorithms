<?php

namespace App\Algorithms\Sort;

use App\Algorithms\Algorithm;
use App\Console\ConsoleHelper;
use App\Console\TextColor;

class CountingSort extends Algorithm
{
    public static function algorithm(array &$values): void
    {
        ConsoleHelper::printAlgorithm('Сортировка подсчетом');
        ConsoleHelper::write('Входные данные', $values, TextColor::RED);

        self::countingSort($values);

        ConsoleHelper::write('Выходные данные', $values, TextColor::GREEN);
    }

    public static function countingSort(array &$values): void
    {
        /** Временное хранилище */
        $temp = array_fill(0, count($values), 0);
        /** Результирующий массив */
        $result = [];

        /**
         * За ключ берем значение $values,
         * а за значение количество вхождений в массиве
         */
        for ($i = 0; $i < count($values); $i++) {
            $temp[$values[$i]] += 1;
        }

        /**
         * Индекс результирующего массива
         */
        $j = 0;

        for ($i = 0; $i < count($values); $i++) {
            /** Если значение существует,
             * то вставляем его столько раз,
             * сколько он был в исходном массиве
             */
            while ($temp[$i] > 0) {
                $result[$j] = $i;
                $j++;
                $temp[$i]--;
            }
        }

        $values = $result;
    }

    public static function getTestCase(): array
    {
        return [4,6,3,1,8,7,5,2,1,0];
    }
}