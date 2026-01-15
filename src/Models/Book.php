<?php

namespace App\Models;

class Book {
    private string $isbn;
    private string $title;
    private int $publicationYear;
    private int $categoryId;
    private string $status;
    private array $authors;

    public function __construct(string $isbn, string $title, int $publicationYear, int $categoryId, string $status = 'Available') {
        $this->isbn = $isbn;
        $this->title = $title;
        $this->publicationYear = $publicationYear;
        $this->categoryId = $categoryId;
        $this->status = $status;
        $this->authors = [];
    }

    public function getIsbn(): string { return $this->isbn; }
    public function getTitle(): string { return $this->title; }
    public function getPublicationYear(): int { return $this->publicationYear; }
    public function getCategoryId(): int { return $this->categoryId; }
    public function getStatus(): string { return $this->status; }
    public function getAuthors(): array { return $this->authors; }

    public function setTitle(string $title): void { $this->title = $title; }
    public function setPublicationYear(int $year): void { $this->publicationYear = $year; }
    public function setCategoryId(int $id): void { $this->categoryId = $id; }
    public function setStatus(string $status): void { $this->status = $status; }
    public function addAuthor(Author $author): void { $this->authors[] = $author; }
}