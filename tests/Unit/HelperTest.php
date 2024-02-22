<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * Notice how this helper test does not extend any Laravel test class, nor does it require the framework to be running.
 * The only imports happening here are the ones from PHPUnit and the helper file itself.
 */
class HelperTest extends TestCase
{
    /**
     * @covers ::deburr
     *
     * @dataProvider deburrDataProvider
     *
     */
    public function testDeburr($string, $expected): void
    {
        $this->assertEquals($expected, deburr($string));
    }

    public function deburrDataProvider(): array
    {
        return [
            ['déjà', 'deja'],
            ['papier-mâché', 'papier-mache'],
            ['résumé', 'resume'],
        ];
    }
}
