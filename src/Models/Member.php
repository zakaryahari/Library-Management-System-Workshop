<?php

namespace App\Models;

abstract class Member {
    protected int $id;
    protected string $fullName;
    protected string $email;
    protected string $phone;
    protected DateTime $expiryDate;
    protected float $unpaidFees;

    public function __construct(int $id, string $fullName, string $email, string $phone, \DateTime $expiryDate, float $unpaidFees = 0.0) {
        $this->id = $id;
        $this->fullName = $fullName;
        $this->email = $email;
        $this->phone = $phone;
        $this->expiryDate = $expiryDate;
        $this->unpaidFees = $unpaidFees;
    }

    abstract public function getMaxBooks(): int;
    abstract public function getLoanPeriod(): int;
    abstract public function getLateFeeRate(): float;

    public function canBorrow(): bool {
        return false;
    }

    public function getId(): int { return $this->id; }
    public function getFullName(): string { return $this->fullName; }
    public function getEmail(): string { return $this->email; }
    public function getPhone(): string { return $this->phone; }
    public function getExpiryDate(): \DateTime { return $this->expiryDate; }
    public function getUnpaidFees(): float { return $this->unpaidFees; }

    public function setFullName(string $fullName): void { $this->fullName = $fullName; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setPhone(string $phone): void { $this->phone = $phone; }
    public function setExpiryDate(\DateTime $expiryDate): void { $this->expiryDate = $expiryDate; }
    public function setUnpaidFees(float $unpaidFees): void { $this->unpaidFees = $unpaidFees; }
}