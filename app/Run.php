<?php

namespace App;

use App\Algorithms\Sort\QuickSort;

class Run
{
    public static function start(): void
    {
        $values = QuickSort::getTestCase();

        QuickSort::algorithm($values);
    }
}