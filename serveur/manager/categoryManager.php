<?php
require_once '../data/categoryDAO.php';
require_once '../model/category.php';

class CategoryManager
{
    private CategoryDAO $categoryDAO;

    public function __construct()
    {
        $this->categoryDAO = new CategoryDAO();
    }

    public function createCategory(Category $category): bool
    {
        return $this->categoryDAO->create($category);
    }

    public function getCategoryById(int $catId): ?Category
    {
        return $this->categoryDAO->read($catId);
    }

    public function updateCategory(Category $category): bool
    {
        return $this->categoryDAO->update($category);
    }

    public function deleteCategory(int $catId): bool
    {
        return $this->categoryDAO->delete($catId);
    }

    public function getAllCategories(): array
    {
        return $this->categoryDAO->getAll();
    }
}
