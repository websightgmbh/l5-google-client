<?php

/*
 * This file is part of L5 Google Client
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Websight\L5GoogleClient\Tests;

use Google_Client;
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Websight\L5GoogleClient\GoogleClientFactory;

/**
 * Class GoogleClientFactoryTest
 *
 * @author Cedric Ziel <ziel@websight.de>
 * @package Websight\L5GoogleClient\Tests
 */
class GoogleClientFactoryTest extends AbstractTestBenchTestCase
{
    public function testMakeFromMetadata()
    {
        $factory = $this->getGoogleClientFactory();
        $return = $factory->make(['method' => 'metadata']);
        $this->assertInstanceOf(Google_Client::class, $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The google client requires an authentication method.
     */
    public function testMakeWithoutToken()
    {
        $factory = $this->getGoogleClientFactory();
        $factory->make(['app' => 'your-app']);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The google client requires an authentication method.
     */
    public function testMakeWithoutMethod()
    {
        $factory = $this->getGoogleClientFactory();
        $factory->make(['file' => 'bar/baz.json']);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage You need to choose a valid authentication method.
     */
    public function testMakeWithUnknownMethod()
    {
        $factory = $this->getGoogleClientFactory();
        $factory->make(['method' => 'jingeling_klingeling']);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The google client requires an authentication method.
     */
    public function testMakeWithoutSecret()
    {
        $factory = $this->getGoogleClientFactory();
        $factory->make(['token' => 'your-token']);
    }

    protected function getGoogleClientFactory()
    {
        return new GoogleClientFactory();
    }
}
