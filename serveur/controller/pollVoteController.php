<?php
require_once '../manager/pollVoteManager.php';
require_once '../model/pollVote.php';
require_once '../data/userDAO.php';
require_once '../data/pollOptionDAO.php';

class PollVoteController {
    private PollVoteManager $pollVoteManager;

    public function __construct() {
        $this->pollVoteManager = new PollVoteManager();
    }

    /**
     * @throws Exception
     */
    public function createPollVote(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['pollVote'])) {
                $pollVote = PollVote::createFromObject($data['pollVote']);

                $result = $this->pollVoteManager->createPollVote($pollVote);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Poll vote created successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to create poll vote']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid poll vote data']);
            }
        }
    }

    /**
     * @throws Exception
     */
    public function getPollVoteById($pollVoteId): void
    {
        $pollVote = $this->pollVoteManager->getPollVoteById($pollVoteId);

        if ($pollVote) {
            echo json_encode($pollVote->toArray());
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Poll vote not found']);
        }
    }


    /**
     * @throws Exception
     */
    public function deletePollVote($pollVoteId): void
    {
        $result = $this->pollVoteManager->deletePollVote($pollVoteId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Poll vote deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete poll vote']);
        }
    }

    /**
     * @throws Exception
     */
    public function getAllPollVotes(): void
    {
        $pollVotes = $this->pollVoteManager->getAllPollVotes();

        echo json_encode(array_map(function($pollVote) { return $pollVote->toArray(); }, $pollVotes));
    }
}

if (isset($_GET['action'])) {
    $controller = new PollVoteController();
    $action = $_GET['action'];

    try
    {
        switch ($action) {
            case 'create':
                $controller->createPollVote();
                break;
            case 'read':
                if (isset($_GET['pollVoteId'])) {
                    $controller->getPollVoteById(intval($_GET['pollVoteId']));
                }
                break;
            case 'delete':
                if (isset($_GET['pollVoteId'])) {
                    $controller->deletePollVote(intval($_GET['pollVoteId']));
                }
                break;
            case 'all':
                $controller->getAllPollVotes();
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