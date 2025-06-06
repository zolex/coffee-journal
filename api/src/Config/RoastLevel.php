<?php

namespace App\Config;

enum RoastLevel: string
{
    case LIGHT = 'light';
    case MEDIUM = 'medium';
    case DARK = 'dark';

    public const array ARRAY = [self::LIGHT, self::MEDIUM, self::DARK];
}
