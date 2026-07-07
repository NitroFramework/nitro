<?php

namespace Tests\Feature;

use Nitro\Container\Container;
use Nitro\Facades\Mail;
use Nitro\Foundation\Application;
use Nitro\Mail\Contracts\Mailer as MailerContract;
use Nitro\Mail\MailManager;
use Nitro\Mail\Message;
use Nitro\Mail\Transports\SmtpTransport;
use PHPUnit\Framework\TestCase;

/**
 * The mail layer wired into a real app: the manager and default mailer resolve
 * from config('mail'), the legacy Mailer contract send() still works for the
 * auth flows, and the smtp mailer delivers to a live server.
 */
class MailTest extends TestCase
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

    public function test_manager_and_default_mailer_resolve(): void
    {
        $this->assertInstanceOf(MailManager::class, Container::getInstance()->make('mail'));
        // The legacy contract binding used by the auth flows.
        $this->assertInstanceOf(MailerContract::class, Container::getInstance()->make(MailerContract::class));
    }

    public function test_legacy_send_still_works_for_auth_flows(): void
    {
        // app(Mailer::class)->send($to, $subject, $body) must not throw (log driver).
        Container::getInstance()->make(MailerContract::class)->send('user@x.dev', 'Reset', 'link');
        $this->assertTrue(true);
    }

    public function test_smtp_mailer_delivers_to_a_live_server(): void
    {
        $socket = @fsockopen('127.0.0.1', 1025, $e, $m, 0.5);
        if (! $socket) {
            $this->markTestSkipped('no SMTP catcher on 127.0.0.1:1025 (run MailHog/Mailpit)');
        }
        fclose($socket);

        @file_get_contents('http://127.0.0.1:8025/api/v1/messages', false, stream_context_create(['http' => ['method' => 'DELETE']]));

        $subject = 'Skeleton SMTP ' . bin2hex(random_bytes(4));
        Mail::mailer('smtp')->sendMessage(
            (new Message())->to('user@example.com')->subject($subject)->html('<p>hi</p>')
        );

        // The smtp mailer's transport is the SMTP one, and MailHog received it.
        $this->assertInstanceOf(SmtpTransport::class, Mail::mailer('smtp')->transport());

        $inbox = json_decode((string) @file_get_contents('http://127.0.0.1:8025/api/v2/messages'), true);
        $subjects = array_map(static fn ($i) => $i['Content']['Headers']['Subject'][0] ?? '', $inbox['items'] ?? []);
        $this->assertContains($subject, $subjects);
    }
}
