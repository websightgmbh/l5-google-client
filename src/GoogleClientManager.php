<?php

/*
 * This file is part of L5 Google Client
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Websight\L5GoogleClient;

use Google_Client;
use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * This is the google client manager class.
 *
 * @author Cedric Ziel <ziel@websight.de>
 * @package Websight\L5GoogleClient
 */
class GoogleClientManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var GoogleClientFactory
     */
    protected $factory;

    /**
     * Create a new google client manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param GoogleClientFactory $factory
     */
    public function __construct(Repository $config, GoogleClientFactory $factory)
    {
        parent::__construct($config);
        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return Google_Client
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'google-client';
    }

    /**
     * Get the factory instance.
     *
     * @return GoogleClientFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
