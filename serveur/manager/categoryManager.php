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

    /**
     * @throws Exception
     */
    public function createCategory(Category $category): bool
    {
        return $this->categoryDAO->create($category);
    }

    /**
     * @throws Exception
     */
    public function getCategoryById(int $catId): ?Category
    {
        return $this->categoryDAO->read($catId);
    }

    /**
     * @throws Exception
     */
    public function updateCategory(Category $category): bool
    {
        return $this->categoryDAO->update($category);
    }

    /**
     * @throws Exception
     */
    public function deleteCategory(int $catId): bool
    {
        return $this->categoryDAO->delete($catId);
    }

    public function getAllCategories(): array
    {
        return $this->categoryDAO->getAll();
    }
}
