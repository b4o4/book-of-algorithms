<?php

namespace App\Algorithms;

abstract class Algorithm
{
    abstract public static function algorithm(array &$values): void;
}