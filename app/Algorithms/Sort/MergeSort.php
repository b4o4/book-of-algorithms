<?php

namespace App\Algorithms\Sort;

use App\Algorithms\Algorithm;
use App\Console\ConsoleHelper;
use App\Console\TextColor;

class MergeSort extends Algorithm
{
    public static function algorithm(array &$values): void
    {
        ConsoleHelper::printAlgorithm('Сортировка слиянием');
        ConsoleHelper::write('Входные данные', $values, TextColor::RED);
        if (count($values) < 2) {
            return;
        }

        $values = self::mergeSort($values);

        ConsoleHelper::write('Выходные данные', $values, TextColor::GREEN);
    }

    public static function mergeSort(array $values): array
    {
        /**
         * Проверяем есть ли что сортировать
         */
        if (count($values) < 2) {
            return $values;
        }

        /**
         * Берем индекс среднего элемента
         */
        $mid = (int)(count($values) / 2);

        /**
         * Делим массив на подмассива
         * До среднего элемента не включительно
         * и после уже включая средний элемент
         */
        $left = array_slice($values, 0, $mid);
        $right = array_slice($values, $mid);

        /**
         * Продолжаем раскручивать рекурсию, пока не останется по 1 элементу в каждом массиве
         */
        return self::merge(self::mergeSort($left), self::mergeSort($right));
    }

    private static function merge(array $left, array $right): array
    {
        /**
         * Массив, в который будут складываться результаты
         */
        $result = [];

        /**
         * Записываем максимальный размер каждого массива
         */
        $i = count($left);
        $j = count($right);

        /**
         * Прогоняем итерации пока в каждом из массивов есть хотя бы 1 элемент
         */
        while (($i > 0) && ($j > 0)) {
            /**
             * Проверяем какой элемент меньше
             */
            if ($left[0] < $right[0]) {
                /**
                 * Если первый элемент в левом массиве меньше, то записываем его
                 * array_shift вытаскивает первый элемент массива и сдвигает нумерацию
                 */
                $result[] = array_shift($left);

                /**
                 * Уменьшаем количество элементов в левом массиве
                 */
                $i--;
            } else {
                /**
                 * Если первый элемент в правом массиве меньше, то записываем его
                 */
                $result[] = array_shift($right);

                /**
                 * Уменьшаем количество элементов в правом массиве
                 */
                $j--;
            }
        }

        /**
         * Распаковываем результирующий массив и возможные остатки в остальных
         * Не боимся того, что там могут оказаться элементы меньше чем последний в результирующем,
         * потому что во время скрутки рекурсии элементы сортировались
         */
        return [...$result, ...$left, ...$right];
    }

    public static function getTestCase(): array
    {
        return [4,6,3,1,8,7,5,2,1,0];
    }
}