<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * @deprecated Extending this class from your test cases means you've given up trying to write a proper unit test.
 *             Unit tests do not require the application to be bootstrapped.
 *             When writing unit tests, ALWAYS extend PHPUnit\Framework\TestCase.
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
