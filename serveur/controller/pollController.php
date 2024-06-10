<?php
require_once '../manager/pollManager.php';
require_once '../model/poll.php';
require_once '../data/userDAO.php';

class PollController {
    private PollManager $pollManager;

    public function __construct() {
        $this->pollManager = new PollManager();
    }

    /**
     * @throws Exception
     */
    public function createPoll(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['poll'])) {
                $poll = Poll::createFromObject($data["poll"]);

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

    /**
     * @throws Exception
     */
    public function getPollById($pollId): void
    {
        $poll = $this->pollManager->getPollById($pollId);

        if ($poll) {
            echo json_encode($poll->toArray());
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Poll not found']);
        }
    }

    /**
     * @throws Exception
     */
    public function updatePoll(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['poll'])) {
                $poll = Poll::createFromObject($data["poll"]);

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

    /**
     * @throws Exception
     */
    public function deletePoll($pollId): void
    {
        $result = $this->pollManager->deletePoll($pollId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Poll deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete poll']);
        }
    }

    /**
     * @throws Exception
     */
    public function getAllPolls(): void
    {
        $polls = $this->pollManager->getAllPolls();

        echo json_encode(array_map(function($poll) { return $poll->toArray(); }, $polls));
    }
}

if (isset($_GET['action'])) {
    $controller = new PollController();
    $action = $_GET['action'];

    try
    {
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
    }
    catch (Exception $e)
    {
        echo json_encode(['status' => 'error', 'message' => 'Error has occurred']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No action specified']);
}