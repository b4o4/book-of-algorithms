<?php

namespace App\Console;

enum TextColor: string
{
    case WHITE = "\033[39m";
    case GREEN = "\033[92m";
    case RED = "\033[91m";
    case CLEAR = "\033[0m";
}
