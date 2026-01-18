<?php

namespace src\Services;

use src\Repositories\BookRepository;
use src\Repositories\BorrowRepository;
use src\Repositories\MemberRepository;
use App\Models\BorrowRecord;
use src\Exceptions\BookUnavailableException;
use src\Exceptions\MemberLimitExceededException;
use src\Exceptions\LateFeeException;
use DateTime;

class LibraryService {
    private BookRepository $bookRepo;
    private BorrowRepository $borrowRepo;
    private MemberRepository $memberRepo;

    public function __construct() {
        $this->bookRepo = new BookRepository();
        $this->borrowRepo = new BorrowRepository();
        $this->memberRepo = new MemberRepository();
    }

    public function borrowBook(int $memberId, string $isbn, int $branchId): bool {
        $member = $this->memberRepo->findById($memberId);
        $book = $this->bookRepo->findById($isbn);

        if (!$book || $book->getStatus() !== 'Available') {
            throw new BookUnavailableException();
        }

        if ($member->getUnpaidFees() > 0) {
            throw new LateFeeException();
        }

        $activeBorrows = $this->borrowRepo->findActiveByMember($memberId);
        if (count($activeBorrows) >= $member->getMaxBooks()) {
            throw new MemberLimitExceededException();
        }

        $borrowDate = new DateTime();
        $dueDate = clone $borrowDate;
        $dueDate->modify('+' . $member->getLoanPeriod() . ' days');

        $record = new BorrowRecord(0, $memberId, $isbn, $branchId, $borrowDate, $dueDate);
        
        $this->bookRepo->updateStatus($isbn, 'Borrowed');
        return $this->borrowRepo->save($record);
    }

    public function returnBook(int $recordId): bool {
        $returnDate = new DateTime();
        $lateFee = 0.0;

        return $this->borrowRepo->markAsReturned($recordId, $returnDate->format('Y-m-d'), $lateFee);
    }

    public function searchBooks(string $query): array {
        return $this->bookRepo->search($query);
    }

    public function getMemberBorrows(int $memberId): array {
        return $this->borrowRepo->findActiveByMember($memberId);
    }
}