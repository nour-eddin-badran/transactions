<?php

namespace App\Dtos;

class PaymentDto
{
    public function __construct(private float $amount, private string $paidOn, private ?string $details) { }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getPaidOn(): string
    {
        return $this->paidOn;
    }

    public function getDetails(): string
    {
        return $this->details;
    }

    public function getVat(): int
    {
        return $this->vat;
    }

    public function getIsVatInclusive(): bool
    {
        return $this->isVatInclusive;
    }
}
