<?php

namespace Tests;

use Http;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Notification;
use Storage;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected bool $seed = true;

    protected function setUp(): void
    {
        parent::setUp();

        Notification::fake();
        Storage::fake('images');
        Http::preventStrayRequests();
    }
}
