<?php

declare(strict_types=1);

namespace Webauthn\TrustPath;

final readonly class CertificateTrustPath implements TrustPath
{
    /**
     * @param string[] $certificates
     */
    public function __construct(
        public array $certificates
    ) {
    }

    /**
     * @param string[] $certificates
     */
    public static function create(array $certificates): self
    {
        return new self($certificates);
    }

    public function isValid(): bool
    {
        return !empty($this->certificates);
    }

    public function hasFido2Attributes(): bool
    {
        return in_array('FIDO2', $this->certificates);
    }

}
