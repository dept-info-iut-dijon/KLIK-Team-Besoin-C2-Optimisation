<?php
require_once '../data/interface/messageDAOInterface.php';
require_once '../model/message.php';

require_once 'userDAO.php';
require_once '../model/user.php';

require_once 'conversationDAO.php';
require_once '../model/conversation.php';


class MessageDAO implements MessageDAOInterface {
    private Database $db;
    private UserDAO $userDAO;

    public function __construct() {
        $this->db = new Database();
        $this->userDAO = new UserDAO();
    }

    /**
     * @throws Exception
     */
    public function create(Message $message): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                $message->getMessageContent(),
                $message->getMessageDate()->format('Y-m-d H:i:s'),
                $message->getConversationId(),
                $message->getMessageUser()->getUserId()
            ];
            $sql = "INSERT INTO Messages (message_content, message_date, conversation_id, user_id) VALUES (?, ?, ?, ?)";

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
    public function read(int $messageId): ?Message {
        $result = $this->db->query("SELECT * FROM Messages WHERE message_id = ?", [$messageId]);

        if(count($result) === 0)
            throw new Exception("Message not found");

        $user = $this->userDAO->read($result[0]["user_id"]);

        $message = Message::createFromDb($result[0]);
        $message->setMessageUser($user);

        return $message;
    }

    /**
     * @throws Exception
     */
    public function update(Message $message): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                $message->getMessageContent(),
                $message->getMessageDate()->format('Y-m-d H:i:s'),
                $message->getConversationId(),
                $message->getMessageUser()->getUserId(),
                $message->getMessageId()
            ];
            $sql = "UPDATE Messages SET message_content = ?, message_date = ?, conversation_id = ?, user_id = ? WHERE message_id = ?";

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
    public function delete(int $messageId): bool {
        $this->db->beginTransaction();
        try
        {
            $this->db->query("DELETE FROM Messages WHERE message_id = ?", [$messageId]);
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
        $messages = $this->db->query("SELECT * FROM Messages");

        return array_map(function($item) {
            $user = $this->userDAO->read($item["user_id"]);

            $message = Message::createFromDb($item);
            $message->setMessageUser($user);

            return $message;
        }, $messages);
    }

    /**
     * @param int $conversationId
     * @return array
     * @throws Exception
     */
    public function getMessagesByConversation(int $conversationId): array
    {
        $result = $this->db->query("SELECT * FROM Messages WHERE conversation_id = ?", [$conversationId]);

        return array_map(function($item) {
            $user = $this->userDAO->read($item["user_id"]);

            $message = Message::createFromDb($item);
            $message->setMessageUser($user);

            return $message;
        }, $result);
    }
}
