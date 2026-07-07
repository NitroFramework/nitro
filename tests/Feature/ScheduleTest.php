<?php

namespace Tests\Feature;

use DateTimeImmutable;
use Nitro\Console\CommandManager;
use Nitro\Container\Container;
use Nitro\Foundation\Application;
use Nitro\Scheduling\Schedule;
use PHPUnit\Framework\TestCase;

/**
 * The scheduler wired into a real app: the Schedule resolves, the app registers
 * tasks (AppServiceProvider), due events run, and schedule:run executes.
 */
class ScheduleTest extends TestCase
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

    private function schedule(): Schedule
    {
        return Container::getInstance()->make(Schedule::class);
    }

    public function test_schedule_resolves_and_app_registered_tasks(): void
    {
        $schedule = $this->schedule();

        $this->assertInstanceOf(Schedule::class, $schedule);
        $this->assertNotEmpty($schedule->events(), 'AppServiceProvider registered at least one task');
    }

    public function test_due_event_runs_through_the_container(): void
    {
        $ran = false;
        $this->schedule()->call(function () use (&$ran): void { $ran = true; })
            ->everyMinute()
            ->description('__test_marker__');

        $due = $this->schedule()->dueEvents(new DateTimeImmutable('2026-06-15 13:30:00'));

        foreach ($due as $event) {
            if ($event->getDescription() === '__test_marker__') {
                $event->run(Container::getInstance());
            }
        }

        $this->assertTrue($ran, 'an everyMinute() task is always due and ran');
    }

    public function test_schedule_run_command_is_registered(): void
    {
        $descriptions = Container::getInstance()->make(CommandManager::class)->getDescriptions();

        $this->assertArrayHasKey('schedule:run', $descriptions);
        $this->assertArrayHasKey('schedule:list', $descriptions);
    }
}
