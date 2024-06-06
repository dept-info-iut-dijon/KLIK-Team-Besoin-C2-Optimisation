<?php

class Conversation {
    private int $conversationId;
    private DateTime $conversationDateCreation;

    public function __construct(int $conversationId, DateTime $conversationDateCreation) {
        $this->conversationId = $conversationId;
        $this->conversationDateCreation = $conversationDateCreation;
    }

    // Getters
    public function getConversationId(): int {
        return $this->conversationId;
    }

    public function getConversationDateCreation(): DateTime {
        return $this->conversationDateCreation;
    }

    // Setters
    public function setConversationId(int $conversationId): void {
        $this->conversationId = $conversationId;
    }

    public function setConversationDateCreation(DateTime $conversationDateCreation): void {
        $this->conversationDateCreation = $conversationDateCreation;
    }

    public function toArray(): array {
        return [
            'conversationId' => $this->conversationId,
            'conversationDateCreation' => $this->conversationDateCreation->format('Y-m-d H:i:s'), // Formatage de la date en chaîne de caractères
        ];
    }
}
