<?php

/*
 * This file is part of L5 Google Client
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Websight\L5GoogleClient\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the google client facade class.
 *
 * @author Cedric Ziel <ziel@websight.de>
 * @package Websight\L5GoogleClient\Facades
 */
class GoogleClient extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'google-client';
    }
}
