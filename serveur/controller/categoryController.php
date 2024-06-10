<?php
require_once '../manager/categoryManager.php';
require_once '../model/category.php';

class CategoryController {
    private CategoryManager $categoryManager;

    public function __construct() {
        $this->categoryManager = new CategoryManager();
    }

    /**
     * @throws Exception
     */
    public function createCategory(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['category'])) {
                $category = Category::createFromObject($data['category']);

                $result = $this->categoryManager->createCategory($category);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Category created successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to create category']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid category data']);
            }
        }
    }

    /**
     * @throws Exception
     */
    public function getCategoryById($catId): void
    {
        $category = $this->categoryManager->getCategoryById($catId);

        if ($category) {
            echo json_encode($category->toArray());
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Category not found']);
        }
    }

    /**
     * @throws Exception
     */
    public function updateCategory(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['category'])) {
                $category = Category::createFromObject($data['category']);

                $result = $this->categoryManager->updateCategory($category);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Category updated successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update category']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid category data']);
            }
        }
    }

    /**
     * @throws Exception
     */
    public function deleteCategory($catId): void
    {
        $result = $this->categoryManager->deleteCategory($catId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Category deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete category']);
        }
    }

    public function getAllCategories(): void
    {
        $categories = $this->categoryManager->getAllCategories();

        echo json_encode(array_map(function($category) { return $category->toArray(); }, $categories));
    }
}

if (isset($_GET['action'])) {
    $controller = new CategoryController();
    $action = $_GET['action'];

    try
    {
        switch ($action) {
            case 'create':
                $controller->createCategory();
                break;
            case 'read':
                if (isset($_GET['catId'])) {
                    $controller->getCategoryById(intval($_GET['catId']));
                }
                break;
            case 'update':
                $controller->updateCategory();
                break;
            case 'delete':
                if (isset($_GET['catId'])) {
                    $controller->deleteCategory(intval($_GET['catId']));
                }
                break;
            case 'all':
                $controller->getAllCategories();
                break;
            default:
                echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
                break;
        }
    }
    catch (Exception $e)
    {
        echo json_encode(['status' => 'error', 'message' => 'Error has occurred']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No action specified']);
}

