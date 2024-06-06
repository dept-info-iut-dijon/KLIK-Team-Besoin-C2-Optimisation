<?php
require_once '../manager/topicManager.php'; 
require_once '../model/topic.php';
require_once '../data/categoryDAO.php';
require_once '../data/userDAO.php';

class TopicController {
    private TopicManager $topicManager;

    public function __construct() {
        $this->topicManager = new TopicManager();
    }

    public function createTopic() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['topic'])) {
                $topicArray = $data['topic'];
                $topic = new Topic(
                    0, 
                    $topicArray['subject'],
                    new DateTime($topicArray['date']),
                    (new CategoryDAO())->read($topicArray['categoryId']),
                    (new UserDAO())->read($topicArray['userId'])
                );

                $result = $this->topicManager->createTopic($topic);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Topic created successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to create topic']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid topic data']);
            }
        }
    }

    public function getTopicById($topicId) {
        $topic = $this->topicManager->getTopicById($topicId);
        if ($topic) {
            echo json_encode($topic->toArray());
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Topic not found']);
        }
    }

    public function updateTopic() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['topic'])) {
                $topicArray = $data['topic'];
                $topic = new Topic(
                    $topicArray['topicId'],
                    $topicArray['subject'],
                    new DateTime($topicArray['date']),
                    (new CategoryDAO())->read($topicArray['categoryId']),
                    (new UserDAO())->read($topicArray['userId'])
                );

                $result = $this->topicManager->updateTopic($topic);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Topic updated successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update topic']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid topic data']);
            }
        }
    }

    public function deleteTopic($topicId) {
        $result = $this->topicManager->deleteTopic($topicId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Topic deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete topic']);
        }
    }

    public function getAllTopics() {
        $topics = $this->topicManager->getAllTopics();
        $topicArray = [];
        foreach ($topics as $topic) {
            $topicArray[] = $topic->toArray();
        }
        echo json_encode($topicArray);
    }
}

if (isset($_GET['action'])) {
    $controller = new TopicController();
    $action = $_GET['action'];

    switch ($action) {
        case 'create':
            $controller->createTopic();
            break;
        case 'read':
            if (isset($_GET['topicId'])) {
                $controller->getTopicById(intval($_GET['topicId']));
            }
            break;
        case 'update':
            $controller->updateTopic();
            break;
        case 'delete':
            if (isset($_GET['topicId'])) {
                $controller->deleteTopic(intval($_GET['topicId']));
            }
            break;
        case 'all':
            $controller->getAllTopics();
            break;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
            break;
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No action specified']);
}
?>
