<?php

require_once 'User.php';
require_once 'Message.php';

class Conversation {
    private array $messages;
    private User $user1;
    private User $user2;
    private int $conversationId;
    private DateTime $conversationDateCreation;

    public function __construct() {
        $this->messages = array();
        $this->user1 = new User();
        $this->user2 = new User();
        $this->conversationId = 0;
        $this->conversationDateCreation = new DateTime();
    }

    // Getters
    public function getMessages(): array {
        return $this->messages;
    }

    public function getUser1(): User {
        return $this->user1;
    }

    public function getUser2(): User {
        return $this->user2;
    }

    public function getConversationId(): int {
        return $this->conversationId;
    }

    public function getConversationDateCreation(): DateTime {
        return $this->conversationDateCreation;
    }

    // Setters
    public function setMessages(array $messages): void {
        $this->messages = $messages;
    }

    public function setUser1(User $user1): void {
        $this->user1 = $user1;
    }

    public function setUser2(User $user2): void {
        $this->user2 = $user2;
    }

    public function setConversationId(int $conversationId): void {
        $this->conversationId = $conversationId;
    }

    public function setConversationDateCreation(DateTime $conversationDateCreation): void {
        $this->conversationDateCreation = $conversationDateCreation;
    }


    public function toArray(): array {
        return [
            'conversationId' => $this->conversationId,
            'conversationDateCreation' => $this->conversationDateCreation->format('Y-m-d H:i:s'),
            'user1' => $this->user1 ? $this->user1->toArray() : null,
            'user2' => $this->user2 ? $this->user2->toArray() : null,
            'messages' => array_map(function($message) { return $message->toArray(); }, $this->messages)
        ];
    }


    public static function createFromObject($obj): Conversation {
        $conversation = new Conversation();

        $conversation->setConversationId($obj->conversationId);
        $conversation->setConversationDateCreation(new DateTime($obj->conversationDateCreation));
        $conversation->setUser1(User::createFromObject($obj->user1));
        $conversation->setUser2(User::createFromObject($obj->user2));
        $conversation->setMessages(array_map(function($message) {
            return Message::createFromObject($message);
        }, $obj->messages));

        return $conversation;
    }


    public static function createFromDb($array): Conversation {
        $conversation = new Conversation();

        $conversation->setConversationId($array['conversation_id']);
        $conversation->setConversationDateCreation(new DateTime($array['conversation_date_creation']));

        return $conversation;
    }
}
