<?php

namespace Tests\Feature;

use Nitro\Container\Container;
use Nitro\Filesystem\Contracts\Filesystem;
use Nitro\Filesystem\FilesystemManager;
use Nitro\Foundation\Application;
use Nitro\Facades\Storage;
use PHPUnit\Framework\TestCase;

/**
 * The filesystem layer wired into a real app: disks resolve from
 * config('filesystems'), the Storage facade round-trips files, and named disks
 * (public) expose a URL.
 */
class StorageTest extends TestCase
{
    private static bool $booted = false;

    public static function setUpBeforeClass(): void
    {
        if (! self::$booted) {
            require_once __DIR__ . '/../../vendor/autoload.php';
            Container::reset();
            (new Application(dirname(__DIR__, 2)))->bootstrap();
            self::$booted = true;
        }
    }

    public function test_manager_and_default_disk_resolve(): void
    {
        $this->assertInstanceOf(FilesystemManager::class, Container::getInstance()->make('filesystem'));
        $this->assertInstanceOf(Filesystem::class, Container::getInstance()->make(Filesystem::class));
    }

    public function test_storage_facade_round_trips_a_file(): void
    {
        Storage::put('__test__/hello.txt', 'from storage');

        $this->assertTrue(Storage::exists('__test__/hello.txt'));
        $this->assertSame('from storage', Storage::get('__test__/hello.txt'));
        $this->assertSame(12, Storage::size('__test__/hello.txt'));

        Storage::delete('__test__/hello.txt');
        Storage::disk('local')->deleteDirectory('__test__');
        $this->assertFalse(Storage::exists('__test__/hello.txt'));
    }

    public function test_public_disk_builds_a_url(): void
    {
        $url = Storage::disk('public')->url('avatars/1.png');
        $this->assertStringEndsWith('/storage/avatars/1.png', $url);
    }
}
