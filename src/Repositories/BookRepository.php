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
        $sql = "SELECT * FROM books WHERE title LIKE :query OR isbn LIKE :query";
        $query = $this->db->getConnection()->prepare($sql);
        $query->bindValue(":query", "%" . $searchTerm . "%");
        $query->execute();
        $results = $query->fetchAll();

        $books = [];
        foreach ($results as $row) {
            $books[] = new Book($row['isbn'],$row['title'],(int)$row['publication_year'],(int)$row['category_id'],$row['status']);
        }
        return $books;
    }

    public function updateStatus(string $isbn, string $status): bool {
        try {
            $this->db->getConnection()->beginTransaction();

            $sql = "UPDATE books SET status = :status WHERE isbn = :isbn";
            $query = $this->db->getConnection()->prepare($sql);
            $query->bindValue(":isbn", $isbn);
            $query->bindValue(":status", $status);
            $query->execute();

            $this->db->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            $this->db->getConnection()->rollBack();
            return false;
        }
    }

    public function getInventory(string $isbn, int $branchId): int {
        $sql = "SELECT available_copies FROM inventory WHERE book_isbn = :isbn AND branch_id = :branch_id";
        $query = $this->db->getConnection()->prepare($sql);
        $query->bindValue(":isbn", $isbn);
        $query->bindValue(":branch_id", $branchId, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch();

        return $result;
    }
}