<?php

namespace Tests\Feature;

use Nitro\Support\Collection;
use PHPUnit\Framework\TestCase;

/**
 * Confirms the Nitro framework is installed and autoloadable from your app.
 * A handy sanity check right after `composer create-project`.
 */
class FrameworkInstalledTest extends TestCase
{
    public function test_framework_classes_are_available(): void
    {
        $this->assertTrue(class_exists(Collection::class));
    }

    public function test_a_framework_helper_runs(): void
    {
        $this->assertSame(6, Collection::make([1, 2, 3])->sum());
    }
}
