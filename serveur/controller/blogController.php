<?php
require_once '../manager/blogManager.php';
require_once '../model/blog.php';
require_once '../data/userDAO.php';

class BlogController {
    private BlogManager $blogManager;

    public function __construct() {
        $this->blogManager = new BlogManager(new BlogDAO());
    }

    public function createBlog() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['blog'])) {
                $blogArray = $data['blog'];
                $blog = new Blog(
                    0, // Assuming 0 for new Blog ID
                    $blogArray['blogTitle'],
                    $blogArray['blogImg'],
                    new DateTime($blogArray['blogDate']),
                    $blogArray['blogContent'],
                    (new UserDAO())->read($blogArray['userId'])
                );

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

    public function getBlogById($blogId) {
        $blog = $this->blogManager->getBlogById($blogId);
        if ($blog) {
            echo json_encode($blog);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Blog not found']);
        }
    }

    public function updateBlog() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['blog'])) {
                $blogArray = $data['blog'];
                $blog = new Blog(
                    $blogArray['blogId'],
                    $blogArray['blogTitle'],
                    $blogArray['blogImg'],
                    new DateTime($blogArray['blogDate']),
                    $blogArray['blogContent'],
                    (new UserDAO())->read($blogArray['userId'])
                );

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

    public function deleteBlog($blogId) {
        $result = $this->blogManager->deleteBlog($blogId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Blog deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete blog']);
        }
    }

    public function getAllBlogs() {
        $blogs = $this->blogManager->getAllBlogs();
        echo json_encode($blogs);
    }
}

if (isset($_GET['action'])) {
    $controller = new BlogController();
    $action = $_GET['action'];

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
} else {
    echo json_encode(['status' => 'error', 'message' => 'No action specified']);
}
?>
