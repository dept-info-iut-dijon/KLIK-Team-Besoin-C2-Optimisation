<?php


class Category {
    private int $catId;
    private string $catName;
    private string $catDescription;

    public function __construct() {
        $this->catId = 0;
        $this->catName = "";
        $this->catDescription = "";
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

    public function toArray(): array {
        return [
            'catId' => $this->catId,
            'catName' => $this->catName,
            'catDescription' => $this->catDescription
        ];
    }

    public static function createFromObject($obj): Category {
        $category = new Category();

        $category->setCatId($obj->catId);
        $category->setCatName($obj->catName);
        $category->setCatDescription($obj->catDescription);

        return $category;
    }

    public static function createFromDb($array): Category {
        $category = new Category();

        $category->setCatId($array["cat_id"]);
        $category->setCatName($array["cat_name"]);
        $category->setCatDescription($array["cat_description"]);

        return $category;
    }
}
