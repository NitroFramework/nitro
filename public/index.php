<?php

declare(strict_types=1);

use Nitro\Foundation\Application;
use Nitro\Foundation\Http\Kernel;
use Nitro\PerformanceBar\PerformanceMetrics;

require_once __DIR__ . '/../vendor/autoload.php';

$sessionPath = dirname(__DIR__) . '/storage/cache/sessions';
if (!is_dir($sessionPath)) {
    mkdir($sessionPath, 0777, true);
}
if (is_dir($sessionPath) && is_writable($sessionPath)) {
    session_save_path($sessionPath);
}

// One always-on safety net for fatal bootstrap errors. The framework's own
// ExceptionHandler is installed by the HandleExceptions bootstrapper and
// supersedes this for everything that happens AFTER bootstrap().
set_exception_handler(static function (\Throwable $e): void {
    while (ob_get_level() > 0) ob_end_clean();
    http_response_code(500);
    echo "<pre>{$e->getMessage()}\n{$e->getFile()}:{$e->getLine()}\n\n{$e->getTraceAsString()}</pre>";
    exit(1);
});

// Record the timing baseline before anything else fires.
PerformanceMetrics::start();

$app = Application::create(dirname(__DIR__));

// Profiler is expensive (it records every container resolve). Keep it gated.
if (filter_var(
    $_ENV['APP_DEBUG'] ?? $_SERVER['APP_DEBUG'] ?? getenv('APP_DEBUG') ?: 'false',
    FILTER_VALIDATE_BOOLEAN
)) {
    $app->getContainer()->setProfiler(\Nitro\Container\ContainerProfiler::getInstance());
}

$app->bootstrap();
$app->handle(Kernel::class);
