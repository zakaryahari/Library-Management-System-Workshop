<?php

namespace App\Models;

class BorrowRecord {
    private int $id;
    private int $memberId;
    private string $bookIsbn;
    private int $branchId;
    private DateTime $borrowDate;
    private DateTime $dueDate;
    private ?DateTime $returnDate;
    private float $lateFee;

    public function __construct(int $id, int $memberId, string $bookIsbn, int $branchId, DateTime $borrowDate, DateTime $dueDate) {
        $this->id = $id;
        $this->memberId = $memberId;
        $this->bookIsbn = $bookIsbn;
        $this->branchId = $branchId;
        $this->borrowDate = $borrowDate;
        $this->dueDate = $dueDate;
        $this->returnDate = null;
        $this->lateFee = 0.0;
    }

    public function getId(): int { return $this->id; }
    public function getMemberId(): int { return $this->memberId; }
    public function getBookIsbn(): string { return $this->bookIsbn; }
    public function getBranchId(): int { return $this->branchId; }
    public function getBorrowDate(): DateTime { return $this->borrowDate; }
    public function getDueDate(): DateTime { return $this->dueDate; }
    public function getReturnDate(): ?DateTime { return $this->returnDate; }
    public function getLateFee(): float { return $this->lateFee; }

    public function setReturnDate(\DateTime $date): void { $this->returnDate = $date; }
    public function setLateFee(float $fee): void { $this->lateFee = $fee; }
}