<?php

namespace App\Dtos;

class TransactionDto
{
    public function __construct(private float $amount, private int $userId, private string $dueOn, private int $vat, private bool $isVatInclusive) { }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getDueOn(): string
    {
        return $this->dueOn;
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
