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

    public function createPost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['post'])) {
                $postArray = $data['post'];
                $post = new Post(
                    0, 
                    $postArray['postContent'],
                    new DateTime($postArray['postDate']),
                    (new TopicDAO())->read($postArray['topicId']),
                    (new UserDAO())->read($postArray['userId'])
                );

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

    public function getPostById($postId) {
        $post = $this->postManager->getPostById($postId);
        if ($post) {
            echo json_encode($post->toArray());
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Post not found']);
        }
    }

    public function updatePost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['post'])) {
                $postArray = $data['post'];
                $post = new Post(
                    $postArray['postId'],
                    $postArray['postContent'],
                    new DateTime($postArray['postDate']),
                    (new TopicDAO())->read($postArray['topicId']),
                    (new UserDAO())->read($postArray['userId'])
                );

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

    public function deletePost($postId) {
        $result = $this->postManager->deletePost($postId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Post deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete post']);
        }
    }

    public function getAllPosts() {
        
        $posts = $this->postManager->getAllPosts();
        $postArray = [];
        foreach ($posts as $post) {
            $postArray[] = $post->toArray();
        }
        echo json_encode($postArray);
    }
}

if (isset($_GET['action'])) {
    $controller = new PostController();
    $action = $_GET['action'];

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
} else {
    echo json_encode(['status' => 'error', 'message' => 'No action specified']);
}
?>
