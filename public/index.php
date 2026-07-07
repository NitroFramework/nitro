<?php

declare(strict_types=1);

use Nitro\Foundation\Application;

require_once __DIR__ . '/../vendor/autoload.php';

// Bootstrap the application and handle the request.
Application::create(dirname(__DIR__))->run();
