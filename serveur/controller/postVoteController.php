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

    /**
     * @throws Exception
     */
    public function createPostVote(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['postVote'])) {
                $postVote = PostVote::createFromObject($data['postVote']);

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

    /**
     * @throws Exception
     */
    public function getPostVoteById($postVoteId): void
    {
        $postVote = $this->postVoteManager->getPostVoteById($postVoteId);

        if ($postVote) {
            echo json_encode($postVote->toArray());
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Post vote not found']);
        }
    }

    /**
     * @throws Exception
     */
    public function updatePostVote(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['postVote'])) {
                $postVote = PostVote::createFromObject($data['postVote']);

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

    /**
     * @throws Exception
     */
    public function deletePostVote($postVoteId): void
    {
        $result = $this->postVoteManager->deletePostVote($postVoteId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Post vote deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete post vote']);
        }
    }

    /**
     * @throws Exception
     */
    public function getAllPostVotes(): void
    {
        $postVotes = $this->postVoteManager->getAllPostVotes();

        echo json_encode(array_map(function($postVote) { return $postVote->toArray(); }, $postVotes));
    }
}

if (isset($_GET['action'])) {
    $controller = new PostVoteController();
    $action = $_GET['action'];

    try
    {
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
    }
    catch (Exception $e)
    {
        echo json_encode(['status' => 'error', 'message' => 'Error has occurred']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No action specified']);
}
