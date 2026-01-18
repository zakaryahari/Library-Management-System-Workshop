<?php

namespace src\Repositories;

use src\Repositories\DatabaseConnection;
use src\Models\Book;


class BookRepository {
    private DatabaseConnection $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findById(string $isbn): ?Book {
        return null;
    }

    public function search(string $query): array {
        return [];
    }

    public function updateStatus(string $isbn, string $status): bool {
        return false;
    }

    public function getInventory(string $isbn, int $branchId): int {
        return 0;
    }
}