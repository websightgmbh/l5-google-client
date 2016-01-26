<?php

/*
 * This file is part of L5 Google Client
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Websight\L5GoogleClient\Tests;

use Google_Client;
use Websight\L5GoogleClient\GoogleClientFactory;
use Websight\L5GoogleClient\GoogleClientManager;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;

/**
 * This is the service provider test class.
 *
 * @author Cedric Ziel <ziel@websight.de>
 * @package Websight\L5GoogleClient\Tests
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testGoogleClientFactoryIsInjectable()
    {
        $this->assertIsInjectable(GoogleClientFactory::class);
    }

    public function testGoogleClientManagerIsInjectable()
    {
        $this->assertIsInjectable(GoogleClientManager::class);
    }
}
