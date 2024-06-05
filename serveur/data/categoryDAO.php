<?php

require_once '../data/interface/categoryDAOInterface.php';
require_once '../model/category.php';


class CategoryDAO implements CategoryDAOInterface {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function create(Category $category): bool {
        $sql = "INSERT INTO Categories (cat_name, cat_description) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $category->getCatName(),
            $category->getCatDescription()
        ]);
    }

    public function read(int $catId): ?Category {
        $sql = "SELECT * FROM Categories WHERE cat_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$catId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Category(
                $row['cat_id'],
                $row['cat_name'],
                $row['cat_description']
            );
        }
        return null;
    }

    public function update(Category $category): bool {
        $sql = "UPDATE Categories SET cat_name = ?, cat_description = ? WHERE cat_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $category->getCatName(),
            $category->getCatDescription(),
            $category->getCatId()
        ]);
    }

    public function delete(int $catId): bool {
        $sql = "DELETE FROM Categories WHERE cat_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$catId]);
    }

    public function getAll(): array {
        $sql = "SELECT * FROM Categories";
        $stmt = $this->pdo->query($sql);
        $categories = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = new Category(
                $row['cat_id'],
                $row['cat_name'],
                $row['cat_description']
            );
        }
        return $categories;
    }
}