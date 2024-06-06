<?php
require_once '../manager/pollManager.php';
require_once '../model/poll.php';
require_once '../data/userDAO.php';

class PollController {
    private PollManager $pollManager;

    public function __construct() {
        $this->pollManager = new PollManager();
    }

    public function createPoll() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['poll'])) {
                $pollArray = $data['poll'];
                $poll = new Poll(
                    0, // Assuming 0 for new Poll ID
                    $pollArray['pollSubject'],
                    new DateTime($pollArray['pollCreated']),
                    new DateTime($pollArray['pollModified']),
                    $pollArray['pollStatus'],
                    $pollArray['pollDescription'],
                    $pollArray['pollLocked'],
                    (new UserDAO())->read($pollArray['userId'])
                );

                $result = $this->pollManager->createPoll($poll);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Poll created successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to create poll']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid poll data']);
            }
        }
    }

    public function getPollById($pollId) {
        $poll = $this->pollManager->getPollById($pollId);
        if ($poll) {
            echo json_encode($poll->toArray());
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Poll not found']);
        }
    }

    public function updatePoll() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['poll'])) {
                $pollArray = $data['poll'];
                $poll = new Poll(
                    $pollArray['pollId'],
                    $pollArray['pollSubject'],
                    new DateTime($pollArray['pollCreated']),
                    new DateTime($pollArray['pollModified']),
                    $pollArray['pollStatus'],
                    $pollArray['pollDescription'],
                    $pollArray['pollLocked'],
                    (new UserDAO())->read($pollArray['userId'])
                );

                $result = $this->pollManager->updatePoll($poll);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Poll updated successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update poll']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid poll data']);
            }
        }
    }

    public function deletePoll($pollId) {
        $result = $this->pollManager->deletePoll($pollId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Poll deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete poll']);
        }
    }

    public function getAllPolls() {
        $polls = $this->pollManager->getAllPolls();
        $pollArray = [];
        foreach ($polls as $poll) {
            $pollArray[] = $poll->toArray();
        }
        echo json_encode($pollArray);
    }
}

if (isset($_GET['action'])) {
    $controller = new PollController();
    $action = $_GET['action'];

    switch ($action) {
        case 'create':
            $controller->createPoll();
            break;
        case 'read':
            if (isset($_GET['pollId'])) {
                $controller->getPollById(intval($_GET['pollId']));
            }
            break;
        case 'update':
            $controller->updatePoll();
            break;
        case 'delete':
            if (isset($_GET['pollId'])) {
                $controller->deletePoll(intval($_GET['pollId']));
            }
            break;
        case 'all':
            $controller->getAllPolls();
            break;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
            break;
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No action specified']);
}
?>
