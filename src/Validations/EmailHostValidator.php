<?php

declare(strict_types=1);

namespace EmailValidation\Validations;

class EmailHostValidator extends Validator implements ValidatorInterface
{
    /** @return string Foobar */
    public function getValidatorName(): string
    {
        return 'valid_host';
    }

    public function getResultResponse(): bool
    {
        $hostName = $this->getEmailAddress()->getHostPart();
        if ($hostName) {
            return $this->getHostByName($hostName) !== $hostName;
        }

        return false; // huh
    }

    protected function getHostByName(string $hostName): string
    {
        return gethostbyname($hostName); // @codeCoverageIgnore
    }
}
