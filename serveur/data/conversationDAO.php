<?php

require_once '../data/interface/conversationDAOInterface.php';
require_once '../model/conversation.php';
require_once '../database.php';
require_once '../data/messageDAO.php';

class ConversationDAO implements ConversationDAOInterface {
    private Database $db;
    private MessageDAO $messageDAO;

    public function __construct() {
        $this->db = new Database();
        $this->messageDAO = new MessageDAO();
    }

    /**
     * @throws Exception
     */
    public function create(Conversation $conversation): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                $conversation->getConversationDateCreation()->format('Y-m-d')
            ];
            $sql = "INSERT INTO Conversation (conservation_date_creation) VALUES (?)";

            $this->db->execute($sql, $params);
            $this->db->commit();
        }
        catch (Exception $e)
        {
            $this->db->rollBack();
            throw $e;
        }

        return true;
    }

    /**
     * @throws Exception
     */
    public function read(int $conversationId): ?Conversation {
        $result = $this->db->query("SELECT * FROM Conversation WHERE conversation_id = ?", [$conversationId]);

        if(count($result) === 0)
            throw new Exception("Conversation not found");

        $messages = $this->messageDAO->getMessagesByConversation($conversationId);

        $conversation = Conversation::createFromDb($result[0]);
        $conversation->setMessages($messages);

        return $conversation;
    }

    /**
     * @throws Exception
     */
    public function update(Conversation $conversation): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                $conversation->getConversationDateCreation()->format('Y-m-d'),
                $conversation->getConversationId()
            ];
            $sql = "UPDATE Conversation SET conservation_date_creation = ? WHERE conversation_id = ?";

            $this->db->execute($sql, $params);
            $this->db->commit();
        }
        catch (Exception $e)
        {
            $this->db->rollBack();
            throw $e;
        }

        return true;
    }

    /**
     * @throws Exception
     */
    public function delete(int $conversationId): bool {
        $this->db->beginTransaction();
        try
        {
            $this->db->query("DELETE FROM Conversation WHERE conversation_id = ?", [$conversationId]);
            $this->db->commit();
        }
        catch (Exception $e)
        {
            $this->db->rollBack();
            throw $e;
        }

        return true;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getAll(): array {
        $conversations = $this->db->query("SELECT * FROM Conversation");

        return array_map(function($item) {
            $messages = $this->messageDAO->getMessagesByConversation($item["conversation_id"]);

            $conversation = Conversation::createFromDb($item);
            $conversation->setMessages($messages);

            return $conversation;
        }, $conversations);
    }
}