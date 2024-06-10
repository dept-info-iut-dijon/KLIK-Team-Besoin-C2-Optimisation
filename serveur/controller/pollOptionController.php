<?php
require_once '../manager/pollOptionManager.php';
require_once '../model/pollOption.php';
require_once '../data/pollDAO.php';

class PollOptionController {
    private PollOptionManager $pollOptionManager;

    public function __construct() {
        $this->pollOptionManager = new PollOptionManager();
    }

    /**
     * @throws Exception
     */
    public function createPollOption(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['pollOption'])) {
                $pollOption = PollOption::createFromObject($data['pollOption']);

                $result = $this->pollOptionManager->createPollOption($pollOption);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Poll option created successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to create poll option']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid poll option data']);
            }
        }
    }

    /**
     * @throws Exception
     */
    public function getPollOptionById($pollOptionId): void
    {
        $pollOption = $this->pollOptionManager->getPollOptionById($pollOptionId);

        if ($pollOption) {
            echo json_encode($pollOption->toArray());
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Poll option not found']);
        }
    }

    /**
     * @throws Exception
     */
    public function updatePollOption(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['pollOption'])) {
                $pollOption = PollOption::createFromObject($data['pollOption']);

                $result = $this->pollOptionManager->updatePollOption($pollOption);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Poll option updated successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update poll option']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid poll option data']);
            }
        }
    }

    /**
     * @throws Exception
     */
    public function deletePollOption($pollOptionId): void
    {
        $result = $this->pollOptionManager->deletePollOption($pollOptionId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Poll option deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete poll option']);
        }
    }

    /**
     * @throws Exception
     */
    public function getAllPollOptions(): void
    {
        $pollOptions = $this->pollOptionManager->getAllPollOptions();

        echo json_encode(array_map(function($pollOption) { return $pollOption->toArray(); }, $pollOptions));
    }
}

if (isset($_GET['action'])) {
    $controller = new PollOptionController();
    $action = $_GET['action'];

    try
    {
        switch ($action) {
            case 'create':
                $controller->createPollOption();
                break;
            case 'read':
                if (isset($_GET['pollOptionId'])) {
                    $controller->getPollOptionById(intval($_GET['pollOptionId']));
                }
                break;
            case 'update':
                $controller->updatePollOption();
                break;
            case 'delete':
                if (isset($_GET['pollOptionId'])) {
                    $controller->deletePollOption(intval($_GET['pollOptionId']));
                }
                break;
            case 'all':
                $controller->getAllPollOptions();
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
