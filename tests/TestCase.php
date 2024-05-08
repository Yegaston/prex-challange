<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    // Seed database
    protected function setUp(): void
    {
        parent::setUp();
        // run php artisan passport:client --personal

        // Artisan::call('passport:client --personal');
    }
}
