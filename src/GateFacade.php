<?php

namespace Looxis\Gate;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Looxis\Gate\Skeleton\SkeletonClass
 */
class GateFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'LooxisGate';
    }
}
