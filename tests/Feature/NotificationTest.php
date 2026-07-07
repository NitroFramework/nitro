<?php

namespace Tests\Feature;

use App\Models\User;
use Nitro\Container\Container;
use Nitro\Database\DB;
use Nitro\Database\Schema\SchemaBuilder as Schema;
use Nitro\Facades\Notification as NotificationFacade;
use Nitro\Foundation\Application;
use Nitro\Notifications\Notifiable;
use Nitro\Notifications\Notification;
use PHPUnit\Framework\TestCase;

/**
 * The notification layer wired into a real app: the User model is Notifiable,
 * notify() dispatches through the container, and the database channel persists
 * to the notifications table.
 */
class NotificationTest extends TestCase
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

    protected function setUp(): void
    {
        // Isolate on an in-memory database with just the tables this test needs.
        DB::configure(['driver' => 'sqlite', 'database' => ':memory:']);
        Schema::create('users', function ($t) {
            $t->id();
            $t->string('name');
            $t->string('email');
        });
        Schema::create('notifications', function ($t) {
            $t->string('id');
            $t->primary('id');
            $t->string('type');
            $t->string('notifiable_type');
            $t->string('notifiable_id');
            $t->text('data');
            $t->timestamp('read_at')->nullable();
            $t->timestamps();
        });
        DB::table('users')->insert(['name' => 'Ada', 'email' => 'ada@x.dev']);
    }

    protected function tearDown(): void
    {
        DB::configure(['driver' => 'sqlite', 'database' => ':memory:']);
    }

    private function notification(): Notification
    {
        return new class extends Notification {
            public function via(object $notifiable): array
            {
                return ['database'];
            }

            public function toDatabase(object $notifiable): array
            {
                return ['message' => 'Welcome to Nitro!'];
            }
        };
    }

    public function test_user_is_notifiable(): void
    {
        $this->assertContains(Notifiable::class, class_uses(User::class));
    }

    public function test_notify_persists_a_database_notification(): void
    {
        User::find(1)->notify($this->notification());

        $row = DB::table('notifications')->first();
        $this->assertSame(User::class, $row->notifiable_type);
        $this->assertStringContainsString('Welcome to Nitro!', $row->data);
    }

    public function test_notification_facade_sends(): void
    {
        NotificationFacade::send(User::find(1), $this->notification());

        $this->assertSame(1, DB::table('notifications')->count());
    }
}
