<?php
require_once '../manager/messageManager.php';
require_once '../model/message.php';
require_once '../data/userDAO.php';
require_once '../data/conversationDAO.php';

class MessageController {
    private MessageManager $messageManager;

    public function __construct() {
        $this->messageManager = new MessageManager();
    }

    /**
     * @throws Exception
     */
    public function createMessage(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['message'])) {
                $message = Message::createFromObject($data['message']);

                $result = $this->messageManager->createMessage($message);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Message created successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to create message']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid message data']);
            }
        }
    }

    /**
     * @throws Exception
     */
    public function getMessageById($messageId): void
    {
        $message = $this->messageManager->getMessageById($messageId);
        if ($message) {
            echo json_encode($message->toArray());
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Message not found']);
        }
    }

    /**
     * @throws Exception
     */
    public function updateMessage(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['message'])) {
                $message = Message::createFromObject($data['message']);

                $result = $this->messageManager->updateMessage($message);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Message updated successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update message']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid message data']);
            }
        }
    }

    /**
     * @throws Exception
     */
    public function deleteMessage($messageId): void
    {
        $result = $this->messageManager->deleteMessage($messageId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Message deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete message']);
        }
    }

    /**
     * @throws Exception
     */
    public function getAllMessages(): void
    {
        $messages = $this->messageManager->getAllMessages();

        echo json_encode(array_map(function($message) { return $message->toArray(); }, $messages));
    }
}

if (isset($_GET['action'])) {
    $controller = new MessageController();
    $action = $_GET['action'];

    try
    {
        switch ($action) {
            case 'create':
                $controller->createMessage();
                break;
            case 'read':
                if (isset($_GET['messageId'])) {
                    $controller->getMessageById(intval($_GET['messageId']));
                }
                break;
            case 'update':
                $controller->updateMessage();
                break;
            case 'delete':
                if (isset($_GET['messageId'])) {
                    $controller->deleteMessage(intval($_GET['messageId']));
                }
                break;
            case 'all':
                $controller->getAllMessages();
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