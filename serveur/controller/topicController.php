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

    /**
     * @throws Exception
     */
    public function createTopic(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['topic'])) {
                $topic = Topic::createFromObject($data['topic']);

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

    /**
     * @throws Exception
     */
    public function getTopicById($topicId): void
    {
        $topic = $this->topicManager->getTopicById($topicId);

        if ($topic) {
            echo json_encode($topic->toArray());
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Topic not found']);
        }
    }

    /**
     * @throws Exception
     */
    public function updateTopic(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['topic'])) {
                $topic = Topic::createFromObject($data['topic']);

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

    /**
     * @throws Exception
     */
    public function deleteTopic($topicId): void
    {
        $result = $this->topicManager->deleteTopic($topicId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Topic deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete topic']);
        }
    }

    /**
     * @throws Exception
     */
    public function getAllTopics(): void
    {
        $topics = $this->topicManager->getAllTopics();

        echo json_encode(array_map(function($topic) { return $topic->toArray(); }, $topics));
    }
}

if (isset($_GET['action'])) {
    $controller = new TopicController();
    $action = $_GET['action'];

    try
    {
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
    }
    catch (Exception $e)
    {
        echo json_encode(['status' => 'error', 'message' => 'Error has occurred']);
    }

} else {
    echo json_encode(['status' => 'error', 'message' => 'No action specified']);
}
