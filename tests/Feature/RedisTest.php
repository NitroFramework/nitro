<?php

namespace Tests\Feature;

use Nitro\Container\Container;
use Nitro\Facades\Redis;
use Nitro\Foundation\Application;
use Nitro\Redis\Connections\PhpRedisConnection;
use Nitro\Redis\RedisManager;
use PHPUnit\Framework\TestCase;

/**
 * The Redis client wired into a real app: connections resolve from
 * config('database.redis') and the Redis facade round-trips against a live
 * server. Skipped when phpredis or a server is unavailable.
 */
class RedisTest extends TestCase
{
    private static bool $booted = false;
    private string $key;

    public static function setUpBeforeClass(): void
    {
        if (! self::$booted) {
            require_once __DIR__ . '/../../vendor/autoload.php';
            Container::reset();
            (new Application(dirname(__DIR__, 2)))->bootstrap();
            self::$booted = true;
        }
    }

    protected function setUp(): void
    {
        if (! extension_loaded('redis')) {
            $this->markTestSkipped('phpredis extension required');
        }
        $socket = @fsockopen('127.0.0.1', 6379, $errno, $errstr, 0.5);
        if (! $socket) {
            $this->markTestSkipped('no Redis server on 127.0.0.1:6379');
        }
        fclose($socket);

        $this->key = 'nitro:test:' . bin2hex(random_bytes(6));
    }

    protected function tearDown(): void
    {
        if (isset($this->key) && extension_loaded('redis')) {
            try {
                Redis::del($this->key);
            } catch (\Throwable) {
                // server gone mid-test
            }
        }
    }

    public function test_redis_manager_resolves(): void
    {
        $this->assertInstanceOf(RedisManager::class, Container::getInstance()->make('redis'));
    }

    public function test_facade_round_trips_against_a_live_server(): void
    {
        Redis::set($this->key, 'live-value');

        $this->assertSame('live-value', Redis::get($this->key));
    }

    public function test_named_cache_connection_resolves(): void
    {
        $this->assertInstanceOf(PhpRedisConnection::class, Redis::connection('cache'));
    }
}
