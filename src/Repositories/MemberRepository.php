<?php

namespace src\Repositories;

use src\Repositories\DatabaseConnection;
use src\Models\Book;

use src\Models\Member;
use src\Models\StudentMember;
use src\Models\FacultyMember;

class MemberRepository {
    private DatabaseConnection $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findById(int $id): ?Member {
        $sql = "SELECT * FROM members WHERE id = :id";
        $query = $this->db->getConnection()->prepare($sql);
        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch();

        if (!$result) {
            return null;
        }

        if ($result['member_type'] == 'Student') {
            return new StudentMember($this->db , $result['id'], $result['name'], $result['email'], $result['membership_date'], $result['member_type'], $result['school_name']);
        }

        if ($result['member_type'] == 'Faculty') {
            return new FacultyMember($this->db , $result['id'], $result['name'], $result['email'], $result['membership_date'], $result['member_type'], $result['school_name']);
        }
    }

    public function updateFees(int $id, float $amount): bool {
        try {
            $this->db->getConnection()->beginTransaction();

            $sql = "UPDATE members SET unpaid_fees = :unpaid_fees WHERE id = :id";
            $query = $this->db->getConnection()->prepare($sql);
            $query->bindValue(":id", $id, PDO::PARAM_INT);
            $query->bindValue(":unpaid_fees", $amount);
            $query->execute();

            $this->db->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            $this->db->getConnection()->rollBack();
            return false;
        }
    }

    public function renewMembership(int $id, string $newDate): bool {
        try {
            $this->db->getConnection()->beginTransaction();

            $sql = "UPDATE members SET expiry_date = :expiry_date WHERE id = :id";
            $query = $this->db->getConnection()->prepare($sql);
            $query->bindValue(":id", $id, PDO::PARAM_INT);
            $query->bindValue(":expiry_date", $newDate);
            $query->execute();

            $this->db->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            $this->db->getConnection()->rollBack();
            return false;
        }
    }
}