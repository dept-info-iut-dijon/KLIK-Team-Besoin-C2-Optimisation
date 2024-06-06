<?php
require_once '../manager/conversationManager.php';
require_once '../model/conversation.php';

class ConversationController {
    private ConversationManager $conversationManager;

    public function __construct() {
        $this->conversationManager = new ConversationManager();
    }

    public function createConversation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['conversation'])) {
                $conversationArray = $data['conversation'];
                $conversation = new Conversation(
                    0, 
                    new DateTime($conversationArray['conversationDateCreation'])
                );

                $result = $this->conversationManager->createConversation($conversation);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Conversation created successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to create conversation']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid conversation data']);
            }
        }
    }

    public function getConversationById($conversationId) {
        $conversation = $this->conversationManager->getConversationById($conversationId);
        if ($conversation) {
            echo json_encode($conversation);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Conversation not found']);
        }
    }

    public function updateConversation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['conversation'])) {
                $conversationArray = $data['conversation'];
                $conversation = new Conversation(
                    $conversationArray['conversationId'],
                    new DateTime($conversationArray['conversationDateCreation'])
                );

                $result = $this->conversationManager->updateConversation($conversation);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Conversation updated successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update conversation']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid conversation data']);
            }
        }
    }

    public function deleteConversation($conversationId) {
        $result = $this->conversationManager->deleteConversation($conversationId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Conversation deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete conversation']);
        }
    }

    public function getAllConversations() {
        $conversations = $this->conversationManager->getAllConversations();
        echo json_encode($conversations);
    }
}

if (isset($_GET['action'])) {
    $controller = new ConversationController();
    $action = $_GET['action'];

    switch ($action) {
        case 'create':
            $controller->createConversation();
            break;
        case 'read':
            if (isset($_GET['conversationId'])) {
                $controller->getConversationById(intval($_GET['conversationId']));
            }
            break;
        case 'update':
            $controller->updateConversation();
            break;
        case 'delete':
            if (isset($_GET['conversationId'])) {
                $controller->deleteConversation(intval($_GET['conversationId']));
            }
            break;
        case 'all':
            $controller->getAllConversations();
            break;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
            break;
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No action specified']);
}
?>
