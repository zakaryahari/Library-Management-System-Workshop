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
        $sql = "SELECT b.*, c.name as category_name FROM books b JOIN categories c ON b.category_id = c.id WHERE b.isbn = :isbn";
        $query = $this->db->getConnection()->prepare($sql);
        $query->bindValue(":isbn", $isbn);
        $query->execute();
        $result = $query->fetch();

        if (!$result) {
            return null;
        }

        return new Book($result['isbn'],$result['title'],(int)$result['publication_year'],(int)$result['category_id'],$result['status']
        );
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