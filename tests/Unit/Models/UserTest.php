<?php

namespace Tests\Unit\Models;

use App\Models\User;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Models\User
 */
class UserTest extends TestCase
{
    /**
     * In this case, there is no DB requirement because we're not actually persisting anything to the database
     * We just want to see if the magic methods (ugh) of `setUserAttribute` and `getUserAttribute` works as expected
     * For that reason, we can extend the regular PHPUnit TestCase class
     *
     * The moment this attempts to interact with the database, it will become a feature test
     *
     * @covers ::getNameAndEmail
     */
    public function testGetNameAndEmail(): void
    {
        $user = new User();
        $user->name = 'John Doe';
        $user->email = 'john.doe@example.com';

        $fullName = $user->getNameAndEmail();

        $this->assertEquals('John Doe - john.doe@example.com', $fullName);
    }
}
