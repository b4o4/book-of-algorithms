<?php

namespace App\Algorithms\Sort;

use App\Algorithms\Algorithm;
use App\Console\ConsoleHelper;
use App\Console\TextColor;

class QuickSort extends Algorithm
{
    public static function algorithm(array &$values): void
    {
        ConsoleHelper::printAlgorithm('Быстрая сортировка');
        ConsoleHelper::write('Входные данные', $values, TextColor::GREEN);

        $count = count($values);

        if ($count < 2) {
            return;
        }

        self::quickSort($values, 0, count($values) - 1);

        ConsoleHelper::write('Выходные данные', $values, TextColor::RED);
    }

    private static function quickSort(array &$arr, int $low, int $high): void
    {
        if ($low < $high) {

            $q = self::partition($arr, $low, $high);

            /**
             * В следующих строчках применяется парадигма "Разделяй и властвуй"
             * https://education.yandex.ru/handbook/algorithms/article/razdelyaj-i-vlastvuj
             */

            /** Передаем левую часть массива до опорного элемента */
            self::quickSort($arr, $low, $q - 1);
            /** Передаем правую часть массива после опорного элемента */
            self::quickSort($arr, $q + 1, $high);
        }
    }


    /**
     * func partition в данном случае принимает указатель,
     * чтобы не задействовать доп память для изменения порядка подмассива
     */
    public static function partition(array &$arr, int $low, int $high): int
    {
        /** Опорный элемент в данном случае всегда последний */
        $x = $arr[$high];

        /**
         * $i Перед первой итерацией цикла должно быть меньше на 1, чем левая граница подмассива
         * В конечном итоге $i является границей левого подмассива
         */
        $i = $low - 1;

        /**
         * Перебираем подмассив начиная с самого первого элемента и до предпоследнего,
         * чтобы не зацепить опорный элемент
         */
        for ($j = $low; $j <= $high - 1; $j++) {
            if ($arr[$j] <= $x) {
                /**
                 * Если найден элемент, который меньше опорного,
                 * то сдвигаем указатель, чтобы потом переместить элемент в левый подмассив
                 */
                $i = $i + 1;

                /**
                 * Меняем местами элемент меньше опорного с элементом больше опорного
                 */
                [$arr[$i], $arr[$j]] = [$arr[$j], $arr[$i]];
            }
        }
        /**
         * Переставляем опорный элемент с последним элементом,
         * который меньше опорного,
         * чтобы числа меньше были слева, а больше - справа
         */
        [$arr[$i + 1], $arr[$high]] = [$arr[$high], $arr[$i + 1]];

        /**
         * Возвращаем индекс опорного элемента,
         * чтобы потом по нему разделить на подмассивы
         */
        return $i + 1;
    }

    public static function getTestCase(): array
    {
        return [4,6,3,1,8,7,5,2,1,0];
    }
}