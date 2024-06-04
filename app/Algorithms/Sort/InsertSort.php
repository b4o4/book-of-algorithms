<?php

namespace App\Algorithms\Sort;

use App\Algorithms\Algorithm;
use App\Console\ConsoleHelper;
use App\Console\TextColor;

class InsertSort extends Algorithm
{
    public static function algorithm(array &$values): void
    {
        ConsoleHelper::printAlgorithm('Сортировка вставкой');
        ConsoleHelper::write('Входные данные', $values, TextColor::RED);

        $count = count($values);

        /**
         * Проверяем, нужно ли вообще запускать алгоритм
         */
        if ($count < 2) {
            return;
        }
        /**
         * Начинаем перебор элементов не с 0, а с 1.
         * Мы могли бы начать и с 0, но тогда была бы лишняя итерация цикла
         */
        for ($j = 1; $j < $count; $j++) {

            /**
             * Берем текущий элемент, который будем двигать
             */
            $key = $values[$j];

            /**
             * Берем предыдущий индекс, чтобы двигать элементы
             */
            $i = $j - 1;

            /**
             * Проверяем, не кончился ли наш массив для сортировки
             * и смотрим, есть ли значение больше, чем то, которое мы взяли
             */
            while ($i >= 0 && $values[$i] > $key) {
                /**
                 * Двигаем значение больше на один шаг вправо
                 */
                $values[$i + 1] = $values[$i];

                /**
                 * Смещаемся на один шаг влево и повторяем проверку, чтобы прогнать все значения больше $key
                 */
                $i = $i - 1;
            }

            /**
             * Вставляем на то место, где остановился указатель $i + 1 (Потому что $values[$i] меньше $key)
             */
            $values[$i + 1] = $key;
        }

        ConsoleHelper::write('Выходные данные', $values, TextColor::GREEN);
    }

    public static function getTestCase(): array
    {
        return [4,6,3,1,8,7,5,2,1,0];
    }
}