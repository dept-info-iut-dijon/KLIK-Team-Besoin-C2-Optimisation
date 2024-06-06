<?php
require_once '../manager/pollOptionManager.php';
require_once '../model/pollOption.php';
require_once '../data/pollDAO.php';

class PollOptionController {
    private PollOptionManager $pollOptionManager;

    public function __construct() {
        $this->pollOptionManager = new PollOptionManager();
    }

    public function createPollOption() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['pollOption'])) {
                $pollOptionArray = $data['pollOption'];
                $pollOption = new PollOption(
                    0, // Assuming 0 for new PollOption ID
                    $pollOptionArray['pollOptionName'],
                    $pollOptionArray['pollOptionStatus'],
                    (new PollDAO())->read($pollOptionArray['pollId'])
                );

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

    public function getPollOptionById($pollOptionId) {
        $pollOption = $this->pollOptionManager->getPollOptionById($pollOptionId);
        if ($pollOption) {
            echo json_encode($pollOption->toArray());
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Poll option not found']);
        }
    }

    public function updatePollOption() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['pollOption'])) {
                $pollOptionArray = $data['pollOption'];
                $pollOption = new PollOption(
                    $pollOptionArray['pollOptionId'],
                    $pollOptionArray['pollOptionName'],
                    $pollOptionArray['pollOptionStatus'],
                    (new PollDAO())->read($pollOptionArray['pollId'])
                );

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

    public function deletePollOption($pollOptionId) {
        $result = $this->pollOptionManager->deletePollOption($pollOptionId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Poll option deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete poll option']);
        }
    }

    public function getAllPollOptions() {
        $pollOptions = $this->pollOptionManager->getAllPollOptions();
        $pollOptionsArray = [];
        foreach ($pollOptions as $pollOption) {
            $pollOptionsArray[] = $pollOption->toArray();
        }
        echo json_encode($pollOptionsArray);
    }
}

if (isset($_GET['action'])) {
    $controller = new PollOptionController();
    $action = $_GET['action'];

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
} else {
    echo json_encode(['status' => 'error', 'message' => 'No action specified']);
}
?>
