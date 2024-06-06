<?php
require_once '../manager/postVoteManager.php'; 
require_once '../model/postVote.php';
require_once '../data/userDAO.php';
require_once '../data/postDAO.php';

class PostVoteController {
    private PostVoteManager $postVoteManager;

    public function __construct() {
        $this->postVoteManager = new PostVoteManager();
    }

    public function createPostVote() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['postVote'])) {
                $postVoteArray = $data['postVote'];
                $postVote = new PostVote(
                    0, 
                    new DateTime($postVoteArray['postVoteDate']),
                    $postVoteArray['postVote'],
                    (new PostDAO())->read($postVoteArray['postId']),
                    (new UserDAO())->read($postVoteArray['userId'])
                );

                $result = $this->postVoteManager->createPostVote($postVote);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Post vote created successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to create post vote']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid post vote data']);
            }
        }
    }

    public function getPostVoteById($postVoteId) {
        $postVote = $this->postVoteManager->getPostVoteById($postVoteId);
        if ($postVote) {
            echo json_encode($postVote);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Post vote not found']);
        }
    }

    public function updatePostVote() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['postVote'])) {
                $postVoteArray = $data['postVote'];
                $postVote = new PostVote(
                    $postVoteArray['postVoteId'],
                    new DateTime($postVoteArray['postVoteDate']),
                    $postVoteArray['postVote'],
                    (new PostDAO())->read($postVoteArray['postId']),
                    (new UserDAO())->read($postVoteArray['userId'])
                );

                $result = $this->postVoteManager->updatePostVote($postVote);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Post vote updated successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update post vote']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid post vote data']);
            }
        }
    }

    public function deletePostVote($postVoteId) {
        $result = $this->postVoteManager->deletePostVote($postVoteId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Post vote deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete post vote']);
        }
    }

    public function getAllPostVotes() {
        $postVotes = $this->postVoteManager->getAllPostVotes();
        echo json_encode($postVotes);
    }
}

if (isset($_GET['action'])) {
    $controller = new PostVoteController();
    $action = $_GET['action'];

    switch ($action) {
        case 'create':
            $controller->createPostVote();
            break;
        case 'read':
            if (isset($_GET['postVoteId'])) {
                $controller->getPostVoteById(intval($_GET['postVoteId']));
            }
            break;
        case 'update':
            $controller->updatePostVote();
            break;
        case 'delete':
            if (isset($_GET['postVoteId'])) {
                $controller->deletePostVote(intval($_GET['postVoteId']));
            }
            break;
        case 'all':
            $controller->getAllPostVotes();
            break;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
            break;
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No action specified']);
}
?>
