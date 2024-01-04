<?php

namespace EmailValidation\Tests\Validations;

use EmailValidation\EmailAddress;
use EmailValidation\Validations\MxRecordsValidator;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class MxRecordsValidatorTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    private MxRecordsValidator $mxValidator;

    protected function setUp(): void
    {
        $this->mxValidator = \Mockery::mock(MxRecordsValidator::class, [
            new EmailAddress('dave@gmail.com'),
        ])
            ->shouldAllowMockingProtectedMethods()
            ->shouldReceive('getResultResponse')
            ->passthru()
            ->getMock()
            ->shouldReceive('getEmailAddress')
            ->passthru()
            ->getMock()
        ;
    }

    public function testMxRecordIsChecked(): void
    {
        foreach (['MX', 'AAAA', 'NS', 'A'] as $dns) {
            $this->mxValidator
                ->shouldReceive('checkDns')
                ->with('gmail.com.', $dns)
            ;
        }

        $this->mxValidator->getResultResponse();
    }
}
