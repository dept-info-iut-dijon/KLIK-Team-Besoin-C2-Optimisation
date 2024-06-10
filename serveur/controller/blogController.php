<?php
require_once '../manager/blogManager.php';
require_once '../model/blog.php';
require_once '../data/userDAO.php';

class BlogController {
    private BlogManager $blogManager;

    public function __construct() {
        $this->blogManager = new BlogManager();
    }

    /**
     * @throws Exception
     */
    public function createBlog(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['blog'])) {
                $blog = Blog::createFromObject($data['blog']);

                $result = $this->blogManager->createBlog($blog);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Blog created successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to create blog']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid blog data']);
            }
        }
    }

    /**
     * @throws Exception
     */
    public function getBlogById($blogId): void
    {
        $blog = $this->blogManager->getBlogById($blogId);
        if ($blog) {
            echo json_encode($blog->toArray());
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Blog not found']);
        }
    }

    /**
     * @throws Exception
     */
    public function updateBlog(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['blog'])) {
                $blog = Blog::createFromObject($data['blog']);

                $result = $this->blogManager->updateBlog($blog);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Blog updated successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update blog']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid blog data']);
            }
        }
    }

    /**
     * @throws Exception
     */
    public function deleteBlog($blogId): void
    {
        $result = $this->blogManager->deleteBlog($blogId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Blog deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete blog']);
        }
    }

    /**
     * @throws Exception
     */
    public function getAllBlogs(): void
    {
        $blogs = $this->blogManager->getAllBlogs();

        echo json_encode(array_map(function($blog) { return $blog->toArray(); }, $blogs));
    }
}

if (isset($_GET['action'])) {
    $controller = new BlogController();
    $action = $_GET['action'];

    try
    {
        switch ($action) {
            case 'create':
                $controller->createBlog();
                break;
            case 'read':
                if (isset($_GET['blogId'])) {
                    $controller->getBlogById(intval($_GET['blogId']));
                }
                break;
            case 'update':
                $controller->updateBlog();
                break;
            case 'delete':
                if (isset($_GET['blogId'])) {
                    $controller->deleteBlog(intval($_GET['blogId']));
                }
                break;
            case 'all':
                $controller->getAllBlogs();
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

