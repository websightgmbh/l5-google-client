<?php

/*
 * This file is part of L5 Google Client
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Websight\L5GoogleClient;

use Google_Auth_AssertionCredentials;
use Google_Auth_ComputeEngine;
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
        if ($config['method'] == 'json' || $config['method'] == 'json') {
            if (!is_array($config['scopes'])) {
                throw new InvalidArgumentException('No auth scopes defined.');
            }
            if (count($config['scopes']) == null) {
                throw new InvalidArgumentException('No auth scopes defined.');
            }
        }

        return array_only($config, ['file', 'method', 'password', 'scopes', 'service_account_id']);
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
            $client = new Google_Client();
            $authentication = new Google_Auth_ComputeEngine($client);
            $authentication->acquireAccessToken();
            $token = $authentication->getAccessToken();

            $client->setAccessToken($token);

            return $client;
        }

        if ($auth['method'] == 'p12') {
            $credentials = new Google_Auth_AssertionCredentials(
                $auth['service_account'],
                $auth['scopes'],
                file_get_contents($auth['service_account_certificate']),
                $auth['service_account_certificate_password']
            );

            $client = new Google_Client();
            $client->setAssertionCredentials($credentials);

            return $client;
        }

        if ($auth['method'] == 'json') {
            $client = new Google_Client();
            $client->loadServiceAccountJson($auth['file'], $auth['scopes']);

            return $client;
        }
    }
}
