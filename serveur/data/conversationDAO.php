<?php

require_once '../data/interface/conversationDAOInterface.php';
require_once '../model/conversation.php';

class ConversationDAO implements ConversationDAOInterface {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function create(Conversation $conversation): bool {
        $sql = "INSERT INTO Conversation (conservation_date_creation) VALUES (?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $conversation->getConversationDateCreation()->format('Y-m-d')
        ]);
    }

    public function read(int $conversationId): ?Conversation {
        $sql = "SELECT * FROM Conversation WHERE conversation_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$conversationId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Conversation(
                $row['conversation_id'],
                new DateTime($row['conservation_date_creation'])
            );
        }
        return null;
    }

    public function update(Conversation $conversation): bool {
        $sql = "UPDATE Conversation SET conservation_date_creation = ? WHERE conversation_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $conversation->getConversationDateCreation()->format('Y-m-d'),
            $conversation->getConversationId()
        ]);
    }

    public function delete(int $conversationId): bool {
        $sql = "DELETE FROM Conversation WHERE conversation_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$conversationId]);
    }

    public function getAll(): array {
        $sql = "SELECT * FROM Conversation";
        $stmt = $this->pdo->query($sql);
        $conversations = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $conversations[] = new Conversation(
                $row['conversation_id'],
                new DateTime($row['conservation_date_creation'])
            );
        }
        return $conversations;
    }
}