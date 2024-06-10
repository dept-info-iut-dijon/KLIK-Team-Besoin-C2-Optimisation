<?php
require_once '../manager/blogVoteManager.php';
require_once '../model/blogVote.php';
require_once '../data/userDAO.php';
require_once '../data/blogDAO.php';

class BlogVoteController {
    private BlogVoteManager $blogVoteManager;

    public function __construct() {
        $this->blogVoteManager = new BlogVoteManager();
    }

    /**
     * @throws Exception
     */
    public function createBlogVote(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['blogVote'])) {
                $blogVote = BlogVote::createFromObject($data['blogVote']);

                $result = $this->blogVoteManager->createBlogVote($blogVote);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Blog vote created successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to create blog vote']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid blog vote data']);
            }
        }
    }

    /**
     * @throws Exception
     */
    public function getBlogVoteById($blogVoteId): void
    {
        $blogVote = $this->blogVoteManager->getBlogVoteById($blogVoteId);
        if ($blogVote) {
            echo json_encode($blogVote->toArray());
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Blog vote not found']);
        }
    }

    /**
     * @throws Exception
     */
    public function updateBlogVote(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['blogVote'])) {
                $blogVote = BlogVote::createFromObject($data['blogVote']);

                $result = $this->blogVoteManager->updateBlogVote($blogVote);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Blog vote updated successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update blog vote']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid blog vote data']);
            }
        }
    }

    /**
     * @throws Exception
     */
    public function deleteBlogVote($blogVoteId): void
    {
        $result = $this->blogVoteManager->deleteBlogVote($blogVoteId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Blog vote deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete blog vote']);
        }
    }

    public function getAllBlogVotes(): void
    {
        $blogVotes = $this->blogVoteManager->getAllBlogVotes();

        echo json_encode(array_map(function($globVote) { return $globVote->toArray(); }, $blogVotes));
    }
}

if (isset($_GET['action'])) {
    $controller = new BlogVoteController();
    $action = $_GET['action'];

    try
    {
        switch ($action) {
            case 'create':
                $controller->createBlogVote();
                break;
            case 'read':
                if (isset($_GET['blogVoteId'])) {
                    $controller->getBlogVoteById(intval($_GET['blogVoteId']));
                }
                break;
            case 'update':
                $controller->updateBlogVote();
                break;
            case 'delete':
                if (isset($_GET['blogVoteId'])) {
                    $controller->deleteBlogVote(intval($_GET['blogVoteId']));
                }
                break;
            case 'all':
                $controller->getAllBlogVotes();
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