<?php

namespace EmailValidation\Tests;

use EmailValidation\EmailAddress;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class EmailAddressTest extends TestCase
{
    private const VALID_TEST_EMAIL = 'dave@gmail.com';
    private const INVALID_TEST_EMAIL = 'dave----gmail.com';

    private EmailAddress $validEmail;

    private EmailAddress $invalidEmail;

    protected function setUp(): void
    {
        $this->validEmail = new EmailAddress(self::VALID_TEST_EMAIL);
        $this->invalidEmail = new EmailAddress(self::INVALID_TEST_EMAIL);
    }

    public function testEmailNamePartConstant(): void
    {
        $this->assertTrue(defined('\EmailValidation\EmailAddress::EMAIL_NAME_PART'));
        $this->assertSame(0, EmailAddress::EMAIL_NAME_PART);
    }

    public function testAsString(): void
    {
        $this->assertSame(self::VALID_TEST_EMAIL, $this->validEmail->asString());
    }

    public function testGetHostPart(): void
    {
        $this->assertSame('gmail.com', $this->validEmail->getHostPart());
    }

    public function testGetTldPart(): void
    {
        $this->assertSame('com', $this->validEmail->getTopLevelDomainPart());
    }

    public function testGetNamePart(): void
    {
        $this->assertSame('dave', $this->validEmail->getNamePart());
    }

    public function testGetHostPartForInvalidEmail(): void
    {
        $this->assertNull($this->invalidEmail->getHostPart());
    }

    public function testGetTldPartForInvalidEmail(): void
    {
        $this->assertNull($this->invalidEmail->getTopLevelDomainPart());
    }

    public function testGetNamePartForInvalidEmail(): void
    {
        $this->assertNull($this->invalidEmail->getNamePart());
    }

    public function testIsValidFormat(): void
    {
        $this->assertTrue($this->validEmail->isValidEmailAddressFormat());
    }

    public function testIsValidFormatForInvalidEmail(): void
    {
        $this->assertFalse($this->invalidEmail->isValidEmailAddressFormat());
    }
}
