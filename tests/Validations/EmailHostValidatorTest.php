<?php

namespace EmailValidation\Tests\Validations;

use EmailValidation\EmailAddress;
use EmailValidation\Validations\EmailHostValidator;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class EmailHostValidatorTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /** @var EmailHostValidator|Mockery\MockInterface */
    private $hostValidator;

    protected function setUp(): void
    {
        $this->hostValidator = \Mockery::mock(EmailHostValidator::class, [
            new EmailAddress('dave@gmail.com'),
        ])
            ->shouldAllowMockingProtectedMethods()
            ->makePartial()
        ;
    }

    public function testHostIsChecked(): void
    {
        $this->hostValidator->shouldReceive('getHostByName')->with('gmail.com');
        $this->hostValidator->getResultResponse();
    }
}
