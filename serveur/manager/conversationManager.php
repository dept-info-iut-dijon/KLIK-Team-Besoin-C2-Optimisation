<?php
require_once '../data/conversationDAO.php';
require_once '../model/conversation.php';

class ConversationManager
{
    private ConversationDAO $conversationDAO;

    public function __construct()
    {
        $this->conversationDAO = new ConversationDAO();
    }

    public function createConversation(Conversation $conversation): bool
    {
        return $this->conversationDAO->create($conversation);
    }

    public function getConversationById(int $conversationId): ?Conversation
    {
        return $this->conversationDAO->read($conversationId);
    }

    public function updateConversation(Conversation $conversation): bool
    {
        return $this->conversationDAO->update($conversation);
    }

    public function deleteConversation(int $conversationId): bool
    {
        return $this->conversationDAO->delete($conversationId);
    }

    public function getAllConversations(): array
    {
        return $this->conversationDAO->getAll();
    }
}
