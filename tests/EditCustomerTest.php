<?php

/**
 * This is a EditCustomerTest Class
 * The code test data is setup here
 * Some of the functions as tested but not extensively due to time or lack of it factor
 *
 * @author  Obinna Johnphill <obinna.johnphill@googlemail.com>
 *
 * @since 1.0
 *
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class EditCustomerTest extends TestCase
{
    public function testCanBeCreatedFromValidEmailAddress(): void
    {
        $this->assertInstanceOf(
            CreateCustomerAddress::class,
            CreateCustomerAddress::fromString('user@example.com')
        );
    }

    public function testCannotBeCreatedFromInvalidEmailAddress(): void
    {
        $this->expectException(InvalidArgumentException::class);

        CreateCustomerAddress::fromString('invalid');
    }

    public function testCanBeUsedAsString(): void
    {
        $this->assertEquals(
            'user@example.com',
           CreateCustomerAddress::fromString('user@example.com')
        );
    }
}