<?php

namespace Tests\Feature;

use Nitro\Container\Container;
use Nitro\Cookie\CookieJar;
use Nitro\Cookie\CookieValuePrefix;
use Nitro\Foundation\Application;
use Nitro\Foundation\Http\Kernel;
use Nitro\Http\Cookie;
use Nitro\Http\Middleware\EncryptCookies;
use Nitro\Http\Request;
use Nitro\Http\Response;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * The cookie layer wired into a real app: the jar resolves, EncryptCookies sits
 * in the web group, and cookies encrypt/decrypt with the real app key while the
 * session cookie stays plaintext.
 */
class CookieEncryptionTest extends TestCase
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

    public function test_cookie_jar_resolves_and_helper_returns_it(): void
    {
        $this->assertInstanceOf(CookieJar::class, Container::getInstance()->make('cookie'));
        $this->assertInstanceOf(CookieJar::class, cookie());
        $this->assertInstanceOf(Cookie::class, cookie('theme', 'dark', 60));
    }

    public function test_encrypt_cookies_is_in_the_web_group(): void
    {
        $groups = (new ReflectionClass(Kernel::class))->getDefaultProperties()['middlewareGroups'];
        $this->assertContains(EncryptCookies::class, $groups['web']);
    }

    public function test_cookie_round_trips_through_the_middleware_with_the_app_key(): void
    {
        $mw = Container::getInstance()->make(EncryptCookies::class);

        // Encrypt on the way out.
        $response = $mw->handle(
            new Request('GET', '/'),
            fn ($req) => (new Response(''))->withCookie(new Cookie('prefs', 'lang=en'))
        );
        $encrypted = $response->cookies()[0]->value;
        $this->assertNotSame('lang=en', $encrypted);

        // Decrypt on the way back in.
        $request = new Request('GET', '/', [], [], [], [], [], ['prefs' => $encrypted]);
        $mw->handle($request, fn ($req) => new Response(''));
        $this->assertSame('lang=en', $request->cookie('prefs'));
    }

    public function test_session_cookie_is_excepted(): void
    {
        $mw = Container::getInstance()->make(EncryptCookies::class);
        $sessionCookie = (string) config('session.cookie', 'nitro_session');

        // The session cookie must pass through unencrypted (session owns it).
        $request = new Request('GET', '/', [], [], [], [], [], [$sessionCookie => 'raw-session-id']);
        $mw->handle($request, fn ($req) => new Response(''));

        $this->assertSame('raw-session-id', $request->cookie($sessionCookie));
    }
}
