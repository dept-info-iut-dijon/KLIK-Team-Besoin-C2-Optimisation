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

    public function createPollVote() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['pollVote'])) {
                $pollVoteArray = $data['pollVote'];
                $pollVote = new PollVote(
                    0, // Assuming 0 for new PollVote ID
                    (new UserDAO())->read($pollVoteArray['userId']),
                    (new PollOptionDAO())->read($pollVoteArray['pollOptionId'])
                );

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

    public function getPollVoteById($pollVoteId) {
        $pollVote = $this->pollVoteManager->getPollVoteById($pollVoteId);
        if ($pollVote) {
            echo json_encode($pollVote->toArray());
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Poll vote not found']);
        }
    }


    public function deletePollVote($pollVoteId) {
        $result = $this->pollVoteManager->deletePollVote($pollVoteId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Poll vote deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete poll vote']);
        }
    }

    public function getAllPollVotes() {
        $pollVotes = $this->pollVoteManager->getAllPollVotes();
        $pollVotesArray = [];
        foreach ($pollVotes as $pollVote) {
            $pollVotesArray[] = $pollVote->toArray();
        }
        echo json_encode($pollVotesArray);
    }
}

if (isset($_GET['action'])) {
    $controller = new PollVoteController();
    $action = $_GET['action'];

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
} else {
    echo json_encode(['status' => 'error', 'message' => 'No action specified']);
}
?>
