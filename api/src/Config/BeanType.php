<?php

namespace App\Config;

enum BeanType: string
{
    case ARABICA = 'Arabica';
    case ROBUSTA = 'Robusta';
    case LIBERICA = 'Liberica';
    case EXCELSA = 'Excelsa';

    public const array ARRAY = [self::ARABICA, self::ROBUSTA, self::LIBERICA, self::EXCELSA];
}
