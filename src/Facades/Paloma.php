<?php

namespace Revo\Paloma\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Revo\Paloma\Paloma
 */
class Paloma extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Revo\Paloma\Paloma::class;
    }
}
