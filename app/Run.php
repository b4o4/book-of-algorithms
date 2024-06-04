<?php

namespace App;

use App\Algorithms\Sort\InsertSort;
use App\Algorithms\Sort\MergeSort;

class Run
{
    public static function start(): void
    {

        $values = MergeSort::getTestCase();

        MergeSort::algorithm($values);
    }
}