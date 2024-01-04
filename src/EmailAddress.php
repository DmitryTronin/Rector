<?php

declare(strict_types=1);

namespace EmailValidation;

// do smth?
class EmailAddress
{
    public const EMAIL_NAME_PART = 0;
    public const EMAIL_HOST_PART = 1;

    private string $emailAddress;

    public function __construct(string $emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    public function getNamePart(): ?string
    {
        if ($this->isValidEmailAddressFormat()) {
            return $this->getEmailPart(self::EMAIL_NAME_PART);
        }

return null;
    }

    public function isValidEmailAddressFormat(): bool
    {
        return false !== filter_var($this->emailAddress, FILTER_VALIDATE_EMAIL);
    }

    public function getHostPart(bool $returnFqdn = false): ?string
    {
        return $this->isValidEmailAddressFormat() ? $this->getEmailPart(self::EMAIL_HOST_PART).($returnFqdn ? '.' : '') : null;
    }

    public function getTopLevelDomainPart(): ?string
    {
        if ($this->isValidEmailAddressFormat()) {
            return explode('.', $this->getEmailPart(self::EMAIL_HOST_PART))[1];
        }

return null;
    }

    public function asString(): string
    {
        return $this->emailAddress;
    }

    private function getEmailPart(int $partNumber): string
    {
        return explode('@', $this->emailAddress)[$partNumber];
    }
}
