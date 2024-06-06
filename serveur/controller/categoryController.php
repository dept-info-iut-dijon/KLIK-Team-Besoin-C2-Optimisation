<?php
require_once '../manager/categoryManager.php';
require_once '../model/category.php';

class CategoryController {
    private CategoryManager $categoryManager;

    public function __construct() {
        $this->categoryManager = new CategoryManager();
    }

    public function createCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['category'])) {
                $categoryArray = $data['category'];
                $category = new Category(
                    0, 
                    $categoryArray['catName'],
                    $categoryArray['catDescription']
                );

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

    public function getCategoryById($catId) {
        $category = $this->categoryManager->getCategoryById($catId);
        if ($category) {
            echo json_encode($category->toArray());
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Category not found']);
        }
    }

    public function updateCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['category'])) {
                $categoryArray = $data['category'];
                $category = new Category(
                    $categoryArray['catId'],
                    $categoryArray['catName'],
                    $categoryArray['catDescription']
                );

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

    public function deleteCategory($catId) {
        $result = $this->categoryManager->deleteCategory($catId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Category deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete category']);
        }
    }

    public function getAllCategories() {
        $categories = $this->categoryManager->getAllCategories();
        $categoryArray = [];
        foreach ($categories as $category) {
            $categoryArray[] = $category->toArray();
        }
        echo json_encode($categoryArray);
    }
}

if (isset($_GET['action'])) {
    $controller = new CategoryController();
    $action = $_GET['action'];

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
} else {
    echo json_encode(['status' => 'error', 'message' => 'No action specified']);
}
?>
