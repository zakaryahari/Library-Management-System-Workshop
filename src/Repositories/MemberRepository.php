<?php

namespace src\Repositories;

use src\Repositories\DatabaseConnection;
use src\Models\Book;

class MemberRepository {
    private DatabaseConnection $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findById(int $id): ?Member {
        return null;
    }

    public function updateFees(int $id, float $amount): bool {
        return false;
    }

    public function renewMembership(int $id, string $newDate): bool {
        return false;
    }
}