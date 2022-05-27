<?php

namespace Syscape\Single;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Syscape\Single\Skeleton\SkeletonClass
 */
class SingleFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'single';
    }
}
