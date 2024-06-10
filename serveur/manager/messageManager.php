<?php
require_once '../data/messageDAO.php'; 
require_once '../model/message.php';

class MessageManager
{
    private MessageDAO $messageDAO;

    public function __construct()
    {
        $this->messageDAO = new MessageDAO();
    }

    /**
     * @throws Exception
     */
    public function createMessage(Message $message): bool
    {
        return $this->messageDAO->create($message);
    }

    /**
     * @throws Exception
     */
    public function getMessageById(int $messageId): ?Message
    {
        return $this->messageDAO->read($messageId);
    }

    /**
     * @throws Exception
     */
    public function updateMessage(Message $message): bool
    {
        return $this->messageDAO->update($message);
    }

    /**
     * @throws Exception
     */
    public function deleteMessage(int $messageId): bool
    {
        return $this->messageDAO->delete($messageId);
    }

    /**
     * @throws Exception
     */
    public function getAllMessages(): array
    {
        return $this->messageDAO->getAll();
    }
}
