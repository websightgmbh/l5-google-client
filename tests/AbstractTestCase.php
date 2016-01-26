<?php

/*
 * This file is part of L5 Google Client
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Websight\L5GoogleClient\Tests;

use GrahamCampbell\TestBench\AbstractPackageTestCase;
use Websight\L5GoogleClient\GoogleApiClientServiceProvider;

/**
 * This is the abstract test case class.
 *
 * @author Cedric Ziel <ziel@websight.de>
 * @package Websight\L5GoogleClient\Tests
 */
abstract class AbstractTestCase extends AbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return GoogleApiClientServiceProvider::class;
    }
}
