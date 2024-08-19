<?php

declare(strict_types=1);

namespace Maviance\PHPTest\Models;

use DateTime;

class Balance
{
    protected int $id;

    protected string $accountId;

    protected float $amount;

    protected string $sentAt;

    protected bool $isSuccessful;

    protected ?string $error;

    public function __construct(
        string $accountId,
        float $amount,
        ?\DateTime $sentAt = null,
        bool $isSuccessful = false,
        ?string $error = null,
        int $id = 0
    ) {
        $this->id = $id;
        $this->accountId = $accountId;
        $this->setAmount($amount);
        $this->setSentAt($sentAt);
        $this->isSuccessful = $isSuccessful;
        $this->error = $error;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException("Amount cannot be negative");
        }

        $this->amount = $amount;
    }

    public function getSentAt(): \DateTime
    {
        return \DateTime::createFromFormat("Y-m-d H:i:s", $this->sentAt);
    }

    public function setSentAt(?\DateTime $time): void
    {
        $this->sentAt = $time
            ? $time->format("Y-m-d H:i:s")
            : (new \DateTime())->format("Y-m-d H:i:s");
    }

    public function isSuccessful(): bool
    {
        return $this->isSuccessful;
    }

    public function setSuccessful(bool $success): void
    {
        $this->isSuccessful = $success;
    }

    public function getError(): string
    {
        return $this->error ?? "";
    }

    public function setError(string $error): void
    {
        $this->error = $error;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setBalance(float $amount): void
    {
        $this->setAmount($amount);
        $this->setSuccessful(true);
    }

    public function setAccountId(string $accountId): void
    {
        $this->accountId = $accountId;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }
    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "amount" => $this->amount,
            "accountId" => $this->accountId,
            "isSuccessful" => $this->isSuccessful,
            "sentAt" => $this->sentAt,
            "error" => $this->error,
        ];
    }
}
