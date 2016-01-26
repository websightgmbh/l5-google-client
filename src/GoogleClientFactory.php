<?php

/*
 * This file is part of L5 Google Client
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Websight\L5GoogleClient;

use Google_Client;
use InvalidArgumentException;

/**
 * This is the google-client factory class.
 *
 * @author Cedric Ziel <ziel@websight.de>
 * @package Websight\L5GoogleClient
 */
class GoogleClientFactory
{
    /**
     * The allowed authentication methods
     *
     * @var string[]
     */
    protected $allowedMethods = ['metadata', 'json', 'p12'];

    /**
     * Make a new google client.
     *
     * @param string[] $config
     *
     * @return Google_Client
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws InvalidArgumentException
     * @return string[]
     */
    protected function getConfig(array $config)
    {
        if (!array_key_exists('method', $config)) {
            throw new InvalidArgumentException('The google client requires an authentication method.');
        }
        if (!in_array($config['method'], $this->allowedMethods)) {
            throw new InvalidArgumentException('You need to choose a valid authentication method.');
        }

        return array_only($config, ['file', 'method', 'password']);
    }

    /**
     * Get the google client.
     *
     * @param string[] $auth
     *
     * @return Google_Client
     */
    protected function getClient(array $auth)
    {
        if ($auth['method'] == 'metadata') {
            return $this->authenticateClientByMetadata($auth);
        }
        return new Google_Client();
    }

    protected function authenticateClientByMetadata() {

    }
}
