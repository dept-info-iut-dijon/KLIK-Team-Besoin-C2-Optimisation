<?php
require_once '../manager/postManager.php';
require_once '../model/post.php';
require_once '../data/userDAO.php';
require_once '../data/topicDAO.php';

class PostController {
    private PostManager $postManager;

    public function __construct() {
        $this->postManager = new PostManager();
    }

    /**
     * @throws Exception
     */
    public function createPost(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['post'])) {
                $post = Post::createFromObject($data['post']);

                $result = $this->postManager->createPost($post);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Post created successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to create post']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid post data']);
            }
        }
    }

    /**
     * @throws Exception
     */
    public function getPostById($postId): void
    {
        $post = $this->postManager->getPostById($postId);
        if ($post) {
            echo json_encode($post->toArray());
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Post not found']);
        }
    }

    /**
     * @throws Exception
     */
    public function updatePost(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['post'])) {
                $post = Post::createFromObject($data['post']);

                $result = $this->postManager->updatePost($post);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Post updated successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update post']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid post data']);
            }
        }
    }

    /**
     * @throws Exception
     */
    public function deletePost($postId): void
    {
        $result = $this->postManager->deletePost($postId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Post deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete post']);
        }
    }

    /**
     * @throws Exception
     */
    public function getAllPosts(): void
    {
        
        $posts = $this->postManager->getAllPosts();

        echo json_encode(array_map(function($post) { return $post->toArray(); }, $posts));
    }
}

if (isset($_GET['action'])) {
    $controller = new PostController();
    $action = $_GET['action'];

    try
    {
        switch ($action) {
            case 'create':
                $controller->createPost();
                break;
            case 'read':
                if (isset($_GET['postId'])) {
                    $controller->getPostById(intval($_GET['postId']));
                }
                break;
            case 'update':
                $controller->updatePost();
                break;
            case 'delete':
                if (isset($_GET['postId'])) {
                    $controller->deletePost(intval($_GET['postId']));
                }
                break;
            case 'all':
                $controller->getAllPosts();
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