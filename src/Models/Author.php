<?php

namespace App\Models;

class Author {
    private int $id;
    private string $name;
    private string $biography;
    private string $nationality;
    private DateTime $birthDate;

    public function __construct(int $id, string $name, string $biography, string $nationality, DateTime $birthDate) {
        $this->id = $id;
        $this->name = $name;
        $this->biography = $biography;
        $this->nationality = $nationality;
        $this->birthDate = $birthDate;
    }

    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getBiography(): string { return $this->biography; }
    public function getNationality(): string { return $this->nationality; }
    public function getBirthDate(): DateTime { return $this->birthDate; }

    public function setName(string $name): void { $this->name = $name; }
    public function setBiography(string $biography): void { $this->biography = $biography; }
    public function setNationality(string $nationality): void { $this->nationality = $nationality; }
    public function setBirthDate(DateTime $birthDate): void { $this->birthDate = $birthDate; }
}