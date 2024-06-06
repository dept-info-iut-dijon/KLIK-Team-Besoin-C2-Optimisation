<?php

class Category {
    private int $catId;
    private string $catName;
    private string $catDescription;

    public function __construct(int $catId, string $catName, string $catDescription) {
        $this->catId = $catId;
        $this->catName = $catName;
        $this->catDescription = $catDescription;
    }

    // Getters
    public function getCatId(): int {
        return $this->catId;
    }

    public function getCatName(): string {
        return $this->catName;
    }

    public function getCatDescription(): string {
        return $this->catDescription;
    }

    // Setters
    public function setCatId(int $catId): void {
        $this->catId = $catId;
    }

    public function setCatName(string $catName): void {
        $this->catName = $catName;
    }

    public function setCatDescription(string $catDescription): void {
        $this->catDescription = $catDescription;
    }

        // Ajouter la méthode toArray pour convertir l'objet en tableau associatif
        public function toArray(): array {
            return [
                'catId' => $this->catId,
                'catName' => $this->catName,
                'catDescription' => $this->catDescription
            ];
        }
}
