<?php

namespace App\Models;

class StudentMember extends Member {
    public function __construct(int $id, string $fullName, string $email, string $phone, \DateTime $expiryDate, float $unpaidFees = 0.0) {
        parent::__construct($id, $fullName, $email, $phone, $expiryDate, $unpaidFees);
    }

    public function getMaxBooks(): int {
        return 3;
    }

    public function getLoanPeriod(): int {
        return 14;
    }

    public function getLateFeeRate(): float {
        return 0.50;
    }
}