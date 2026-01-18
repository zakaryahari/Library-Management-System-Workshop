<?php

namespace src\Repositories;

use src\Repositories\DatabaseConnection;
use src\Models\Book;

class BorrowRepository {
    private DatabaseConnection $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function save(BorrowRecord $record): bool {
        return false;
    }

    public function findActiveByMember(int $memberId): array {
        return [];
    }

    public function markAsReturned(int $recordId, string $returnDate, float $fee): bool {
        return false;
    }
}