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

    public function createMessage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['message'])) {
                $messageArray = $data['message'];
                $message = new Message(
                    0, // Assuming 0 for new Message ID
                    $messageArray['messageContent'],
                    new DateTime($messageArray['messageDate']),
                    (new ConversationDAO())->read($messageArray['conversationId']),
                    (new UserDAO())->read($messageArray['userId'])
                );

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

    public function getMessageById($messageId) {
        $message = $this->messageManager->getMessageById($messageId);
        if ($message) {
            echo json_encode($message->toArray());
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Message not found']);
        }
    }

    public function updateMessage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['message'])) {
                $messageArray = $data['message'];
                $message = new Message(
                    $messageArray['messageId'],
                    $messageArray['messageContent'],
                    new DateTime($messageArray['messageDate']),
                    (new ConversationDAO())->read($messageArray['conversationId']),
                    (new UserDAO())->read($messageArray['userId'])
                );

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

    public function deleteMessage($messageId) {
        $result = $this->messageManager->deleteMessage($messageId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Message deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete message']);
        }
    }

    public function getAllMessages() {
        $messages = $this->messageManager->getAllMessages();
        $resultArray = [];
        foreach ($messages as $message) {
            $resultArray[] = $message->toArray();
        }
        echo json_encode($resultArray);
    }
}

if (isset($_GET['action'])) {
    $controller = new MessageController();
    $action = $_GET['action'];

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
} else {
    echo json_encode(['status' => 'error', 'message' => 'No action specified']);
}
?>
