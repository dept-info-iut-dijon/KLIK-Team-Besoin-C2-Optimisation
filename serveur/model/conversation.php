<?php

require_once 'user.php';

class Conversation {
    private int $conversationId;
    private DateTime $conversationDateCreation;
    private array $members;
    private array $messages;

    public function __construct() {
        $this->conversationId = 0;
        $this->conversationDateCreation = new DateTime();
        $this->members = array();
        $this->messages = array();
    }

    // Getters
    public function getConversationId(): int {
        return $this->conversationId;
    }

    public function getConversationDateCreation(): DateTime {
        return $this->conversationDateCreation;
    }

    public function getMembers(): array {
        return $this->members;
    }

    public function getMessages(): array {
        return $this->messages;
    }

    // Setters
    public function setConversationId(int $conversationId): void {
        $this->conversationId = $conversationId;
    }

    public function setConversationDateCreation(DateTime $conversationDateCreation): void {
        $this->conversationDateCreation = $conversationDateCreation;
    }

    public function setMembers(array $members): void {
        $this->members = $members;
    }

    public function setMessages(array $messages): void {
        $this->messages = $messages;
    }

    public function toArray(): array {
        return [
            'conversationId' => $this->conversationId,
            'conversationDateCreation' => $this->conversationDateCreation->format('Y-m-d H:i:s'), // Formatage de la date en chaîne de caractères
            'members' => array_map(function($member) { return $member->toArray(); }, $this->members),
            'messages' => array_map(function($message) { return $message->toArray(); }, $this->messages)
        ];
    }

    public static function createFromObject($obj): Conversation {
        $conversation = new Conversation();

        $conversation->setConversationId($obj->conversationId);
        $conversation->setConversationDateCreation(new DateTime($obj->conversationDateCreation));
        $conversation->setMembers(array_map(function($member) {
            return User::createFromObject($member);
        }, $obj->members));
        $conversation->setMessages(array_map(function($message) {
            return Message::createFromObject($message);
        }, $obj->messages));

        return $conversation;
    }

    public static function createFromDb($array): Conversation {
        $conversation = new Conversation();

        $conversation->setConversationId($array["conversation_id"]);
        $conversation->setConversationDateCreation(new DateTime($array["conservation_date_creation"]));

        return $conversation;
    }
}
