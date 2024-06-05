<?php
require_once '../data/interface/messageDAOInterface.php';
require_once '../model/message.php';

require_once 'userDAO.php';
require_once '../model/user.php';

require_once 'conversationDAO.php';
require_once '../model/conversation.php';


class MessageDAO implements MessageDAOInterface {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function create(Message $message): bool {
        $sql = "INSERT INTO Messages (message_content, message_date, conversation_id, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $message->getMessageContent(),
            $message->getMessageDate()->format('Y-m-d H:i:s'),
            $message->getConversation()->getConversationId(),
            $message->getUser()->getUserId()
        ]);
    }

    public function read(int $messageId): ?Message {
        $sql = "SELECT * FROM Messages WHERE message_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$messageId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $conversationDAO = new ConversationDAO();
            $userDAO = new UserDAO();
            $conversation = $conversationDAO->read($row['conversation_id']);
            $user = $userDAO->read($row['user_id']);
            return new Message(
                $row['message_id'],
                $row['message_content'],
                new DateTime($row['message_date']),
                $conversation,
                $user
            );
        }
        return null;
    }

    public function update(Message $message): bool {
        $sql = "UPDATE Messages SET message_content = ?, message_date = ?, conversation_id = ?, user_id = ? WHERE message_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $message->getMessageContent(),
            $message->getMessageDate()->format('Y-m-d H:i:s'),
            $message->getConversation()->getConversationId(),
            $message->getUser()->getUserId(),
            $message->getMessageId()
        ]);
    }

    public function delete(int $messageId): bool {
        $sql = "DELETE FROM Messages WHERE message_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$messageId]);
    }

    public function getAll(): array {
        $sql = "SELECT * FROM Messages";
        $stmt = $this->pdo->query($sql);
        $messages = [];
        $conversationDAO = new ConversationDAO();
        $userDAO = new UserDAO();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $conversation = $conversationDAO->read($row['conversation_id']);
            $user = $userDAO->read($row['user_id']);
            $messages[] = new Message(
                $row['message_id'],
                $row['message_content'],
                new DateTime($row['message_date']),
                $conversation,
                $user
            );
        }
        return $messages;
    }
}
