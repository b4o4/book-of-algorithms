<?php

namespace App\Algorithms\Sort;

use App\Algorithms\Algorithm;
use App\Console\ConsoleHelper;
use App\Console\TextColor;

class HeapSort extends Algorithm
{

    public static function algorithm(array &$values): void
    {
        ConsoleHelper::printAlgorithm('Пирамидальная сортировка');
        ConsoleHelper::write('Входные данные', $values, TextColor::RED);

        self::heapSort($values, count($values));

        ConsoleHelper::write('Выходные данные', $values, TextColor::GREEN);
    }


    /**
     * Процедура для преобразования в двоичную кучу поддерева с корневым узлом i,
     * что является индексом в arr[]. n - размер кучи
     */
    public static function heapify(&$arr, $n, $i): void
    {
        /**
         * Инициализируем наибольший элемент как корень
         */
        $largest = $i;

        /**
         * Если родительский узел хранится в индексе $i,
         * левый дочерний элемент может быть вычислен как 2*$i + 1,
         * а правый дочерний элемент — как 2*$i + 2
         * (при условии, что индексирование начинается с 0)
         */
        /** Левый = 2*$i + 1 */
        $l = 2*$i + 1;

        /** Правый = 2*$i + 2 */
        $r = 2*$i + 2;

        /**
         * Если левый дочерний элемент больше корня
         */
        if ($l < $n && $arr[$l] > $arr[$largest]) {
            $largest = $l;
        }
        /**
         * Если правый дочерний элемент больше,
         * чем самый большой элемент на данный момент
         */
        if ($r < $n && $arr[$r] > $arr[$largest]) {
            $largest = $r;
        }

        /**
         * Если самый большой элемент не корень
         */
        if ($largest != $i)
        {
            $swap = $arr[$i];
            $arr[$i] = $arr[$largest];
            $arr[$largest] = $swap;

            /**
             * Рекурсивно преобразуем в двоичную кучу затронутое поддерево
             */
            self::heapify($arr, $n, $largest);
        }
    }

    /**
     * Основная функция, выполняющая пирамидальную сортировку
     */
    public static function heapSort(array &$arr, int $n): void
    {
        /**
         * Построение кучи (перегруппируем массив)
         */
        for ($i = $n / 2 - 1; $i >= 0; $i--) {
            self::heapify($arr, $n, $i);
        }

        /**
         * Один за другим извлекаем элементы из кучи
         */
        for ($i = $n - 1; $i >= 0; $i--) {
            /**
             * Перемещаем текущий корень в конец
             */
            [$arr[0], $arr[$i]] = [$arr[$i], $arr[0]];

            /**
             * Вызываем процедуру heapify на уменьшенной куче
             */
            self::heapify($arr, $i, 0);
        }
    }

    public static function getTestCase(): array
    {
        return [4,6,3,1,8,7,5,2,1,0];
    }
}