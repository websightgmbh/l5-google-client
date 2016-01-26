# Laravel 5 - Google API Client

This library relies on the 
[Laravel-Manager package by Graham Campbell](https://github.com/GrahamCampbell/Laravel-Manager). Thank you, Graham!

## What is it?

To access Google Cloud Platform (GCP) services like Cloud Storage (ECS) or Compute Engine (GCE),
you need to authenticate yourself as a legit user.

Google Cloud Platform has a concept of service accounts which allows granular access control to the cloud
platform services.

Most applications however use one service account (which is totally legit) and use it for every operation. This
library manages the different service accounts as *connections* to GCP, which makes it super easy to
authenticate against the platform.

As GCP even provides a metadata service, this library can automatically retrieve all required credentials from
the service and authenticate on the fly. It can do so with a 'default' account, every GCP project is associated with
from the moment of creation on, or a specified account name (see the config file for details).

## Installation

The package should be installed with composer:
 
```bash
composer require websight/l5-google-client
```

You need to include the service provider in `config/app.php`:

```php
        \Websight\L5GoogleClient\GoogleApiClientServiceProvider::class,
```

And add the facade to `config/app.php`:

```php
        'GoogleClient' => \Websight\L5GoogleClient\Facades\GoogleClient::class
```

Then publish the configuration (you don't need to if you rely on the standards):

```bash
php artisan vendor:publish --provider="Websight\L5GoogleClient\GoogleApiClientServiceProvider" --tag="config"
```

## Configuration

To be done.

## Usage

To be done.

## License

The MIT License (MIT)

Copyright (c) 2016 websight GmbH

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
