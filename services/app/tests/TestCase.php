<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseTransactions;

    protected static $migrationsRun = false;

    public function setUp(): void
    {
        parent::setUp();

        if (!static::$migrationsRun) {
            Artisan::call('migrate');
            static::$migrationsRun = true;
        }
    }
}
