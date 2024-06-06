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

    public function createBlogVote() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['blogVote'])) {
                $blogVoteArray = $data['blogVote'];
                $blogVote = new BlogVote(
                    0, 
                    new DateTime($blogVoteArray['blogVoteDate']),
                    $blogVoteArray['blogVote'],
                    (new UserDAO())->read($blogVoteArray['userId']),
                    (new BlogDAO())->read($blogVoteArray['blogId'])
                );

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

    public function getBlogVoteById($blogVoteId) {
        $blogVote = $this->blogVoteManager->getBlogVoteById($blogVoteId);
        if ($blogVote) {
            echo json_encode($blogVote->toArray());
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Blog vote not found']);
        }
    }

    public function updateBlogVote() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['blogVote'])) {
                $blogVoteArray = $data['blogVote'];
                $blogVote = new BlogVote(
                    $blogVoteArray['blogVoteId'],
                    new DateTime($blogVoteArray['blogVoteDate']),
                    $blogVoteArray['blogVote'],
                    (new UserDAO())->read($blogVoteArray['userId']),
                    (new BlogDAO())->read($blogVoteArray['blogId'])
                );

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

    public function deleteBlogVote($blogVoteId) {
        $result = $this->blogVoteManager->deleteBlogVote($blogVoteId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Blog vote deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete blog vote']);
        }
    }

    public function getAllBlogVotes() {
        $blogVotes = $this->blogVoteManager->getAllBlogVotes();
        $blogVote = [];
        foreach ($blogVotes as $blogVote) {
            $blogVote[] = $blogVote->toArray();
        }
        echo json_encode($blogVotes);
    }
}

if (isset($_GET['action'])) {
    $controller = new BlogVoteController();
    $action = $_GET['action'];

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
} else {
    echo json_encode(['status' => 'error', 'message' => 'No action specified']);
}
?>
