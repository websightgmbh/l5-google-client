<?php

/*
 * This file is part of L5 Google Client
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Websight\L5GoogleClient\Tests\Facades;

use GrahamCampbell\TestBenchCore\FacadeTrait;
use Websight\L5GoogleClient\Facades\GoogleClient;
use Websight\L5GoogleClient\GoogleClientManager;
use Websight\L5GoogleClient\Tests\AbstractTestCase;

/**
 * This is the dropbox facade test class.
 *
 * @author Cedric Ziel <ziel@websight.de>
 * @package Websight\L5GoogleClient\Tests\Facades
 */
class GoogleClientTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'google-client';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return GoogleClient::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return GoogleClientManager::class;
    }
}
