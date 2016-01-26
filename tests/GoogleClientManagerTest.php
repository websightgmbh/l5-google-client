<?php

/*
 * This file is part of L5 Google Client
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Dropbox;

use Dropbox\Client;
use Google_Client;
use GrahamCampbell\Dropbox\DropboxFactory;
use GrahamCampbell\Dropbox\DropboxManager;
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Illuminate\Contracts\Config\Repository;
use Mockery;
use Websight\L5GoogleClient\GoogleClientFactory;
use Websight\L5GoogleClient\GoogleClientManager;

/**
 * This is the google client manager test class.
 *
 * @author Cedric Ziel <ziel@websight.de>
 * @package Websight\L5GoogleClient\Tests
 */
class GoogleClientManagerTest extends AbstractTestBenchTestCase
{
    public function testCreateConnection()
    {
        $config = ['path' => __DIR__];
        $manager = $this->getManager($config);
        $manager->getConfig()->shouldReceive('get')->once()
            ->with('google-client.default')->andReturn('google-client');
        $this->assertSame([], $manager->getConnections());
        $return = $manager->connection();
        $this->assertInstanceOf('Google_Client', $return);
        $this->assertArrayHasKey('google-client', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repo = Mockery::mock(Repository::class);
        $factory = Mockery::mock(GoogleClientFactory::class);
        $manager = new GoogleClientManager($repo, $factory);
        $manager->getConfig()->shouldReceive('get')->once()
            ->with('google-client.connections')->andReturn(['google-client' => $config]);
        $config['name'] = 'google-client';
        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock(Google_Client::class));

        return $manager;
    }
}
