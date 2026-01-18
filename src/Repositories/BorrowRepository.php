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
        try {
            $this->db->getConnection()->beginTransaction();

            $sql = "INSERT INTO borrow_records (member_id, book_isbn, branch_id, borrow_date, due_date) 
                    VALUES (:member_id, :book_isbn, :branch_id, :borrow_date, :due_date)";
            
            $query = $this->db->getConnection()->prepare($sql);
            $query->bindValue(":member_id", $record->getMemberId(), PDO::PARAM_INT);
            $query->bindValue(":book_isbn", $record->getBookIsbn());
            $query->bindValue(":branch_id", $record->getBranchId(), PDO::PARAM_INT);
            $query->bindValue(":borrow_date", $record->getBorrowDate()->format('Y-m-d'));
            $query->bindValue(":due_date", $record->getDueDate()->format('Y-m-d'));
            
            $query->execute();

            $this->db->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            $this->db->getConnection()->rollBack();
            return false;
        }
    }

    public function findActiveByMember(int $memberId): array {
        $sql = "SELECT * FROM borrow_records WHERE member_id = :member_id AND return_date IS NULL";
        $query = $this->db->getConnection()->prepare($sql);
        $query->bindValue(":member_id", $memberId, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll();
    }

    public function markAsReturned(int $recordId, string $returnDate, float $fee): bool {
        return false;
    }
}