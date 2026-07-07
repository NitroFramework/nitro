<?php

namespace Tests\Feature;

use Nitro\Container\Container;
use Nitro\Encryption\Contracts\Encrypter as EncrypterContract;
use Nitro\Encryption\Encrypter;
use Nitro\Facades\Crypt;
use Nitro\Foundation\Application;
use PHPUnit\Framework\TestCase;

/**
 * The encryption layer is wired into a real app: the 'encrypter' service, its
 * class, and its contract all resolve to one Encrypter keyed off the app key,
 * and the Crypt facade round-trips through the container.
 */
class EncryptionTest extends TestCase
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

    public function test_encrypter_resolves_from_the_container(): void
    {
        $enc = Container::getInstance()->make('encrypter');

        $this->assertInstanceOf(Encrypter::class, $enc);
        $this->assertSame(32, strlen($enc->getKey()), 'app key decodes to 32 bytes (aes-256)');
    }

    public function test_class_and_contract_alias_to_the_same_service(): void
    {
        $c = Container::getInstance();

        $this->assertInstanceOf(Encrypter::class, $c->make(Encrypter::class));
        $this->assertInstanceOf(Encrypter::class, $c->make(EncrypterContract::class));
    }

    public function test_crypt_facade_round_trips(): void
    {
        $payload = Crypt::encryptString('confidential');

        $this->assertTrue(Encrypter::appearsEncrypted($payload));
        $this->assertSame('confidential', Crypt::decryptString($payload));
    }
}
