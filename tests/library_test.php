<?php

require_once '../src/Services/LibraryService.php';
require_once '../src/Repositories/BookRepository.php';
require_once '../src/Repositories/BorrowRepository.php';
require_once '../src/Repositories/MemberRepository.php';
require_once '../src/Models/Book.php';
require_once '../src/Models/Member.php';
require_once '../src/Models/StudentMember.php';
require_once '../src/Models/FacultyMember.php';
require_once '../src/Models/BorrowRecord.php';
require_once '../src/Exceptions/BookUnavailableException.php';
require_once '../src/Exceptions/MemberLimitExceededException.php';
require_once '../src/Exceptions/LateFeeException.php';

use src\Services\LibraryService;
use src\Exceptions\BookUnavailableException;
use src\Exceptions\MemberLimitExceededException;
use src\Exceptions\LateFeeException;

class LibraryTest {
    private LibraryService $service;

    public function __construct() {
        $this->service = new LibraryService();
    }

    public function testBorrowBook(): void {
        echo "Testing book borrowing...\n";
        
        try {
            $result = $this->service->borrowBook(1, '978-0134685991', 1);
            if ($result) {
                echo "✓ Book borrowed successfully\n";
            } else {
                echo "✗ Failed to borrow book\n";
            }
        } catch (BookUnavailableException $e) {
            echo "✗ Book unavailable: " . $e->getMessage() . "\n";
        } catch (MemberLimitExceededException $e) {
            echo "✗ Member limit exceeded: " . $e->getMessage() . "\n";
        } catch (LateFeeException $e) {
            echo "✗ Late fee issue: " . $e->getMessage() . "\n";
        }
    }

    public function testReturnBook(): void {
        echo "Testing book return...\n";
        
        try {
            $result = $this->service->returnBook(1);
            if ($result) {
                echo "✓ Book returned successfully\n";
            } else {
                echo "✗ Failed to return book\n";
            }
        } catch (Exception $e) {
            echo "✗ Error returning book: " . $e->getMessage() . "\n";
        }
    }

    public function testSearchBooks(): void {
        echo "Testing book search...\n";
        
        try {
            $books = $this->service->searchBooks('PHP');
            echo "✓ Found " . count($books) . " books\n";
        } catch (Exception $e) {
            echo "✗ Search failed: " . $e->getMessage() . "\n";
        }
    }

    public function testGetMemberBorrows(): void {
        echo "Testing member borrows...\n";
        
        try {
            $borrows = $this->service->getMemberBorrows(1);
            echo "✓ Member has " . count($borrows) . " active borrows\n";
        } catch (Exception $e) {
            echo "✗ Failed to get borrows: " . $e->getMessage() . "\n";
        }
    }

    public function runAllTests(): void {
        echo "=== Library Service Tests ===\n\n";
        
        $this->testBorrowBook();
        echo "\n";
        
        $this->testReturnBook();
        echo "\n";
        
        $this->testSearchBooks();
        echo "\n";
        
        $this->testGetMemberBorrows();
        echo "\n";
        
        echo "=== Tests Complete ===\n";
    }
}

$test = new LibraryTest();
$test->runAllTests();