<?php
class Message {
    private int $messageId;
    private string $messageContent;
    private DateTime $messageDate;
    private Conversation $conversation;
    private User $user;

    public function __construct(int $messageId, string $messageContent, DateTime $messageDate, Conversation $conversation, User $user) {
        $this->messageId = $messageId;
        $this->messageContent = $messageContent;
        $this->messageDate = $messageDate;
        $this->conversation = $conversation;
        $this->user = $user;
    }

    // Getters
    public function getMessageId(): int {
        return $this->messageId;
    }

    public function getMessageContent(): string {
        return $this->messageContent;
    }

    public function getMessageDate(): DateTime {
        return $this->messageDate;
    }

    public function getConversation(): Conversation {
        return $this->conversation;
    }

    public function getUser(): User {
        return $this->user;
    }

    // Setters
    public function setMessageId(int $messageId): void {
        $this->messageId = $messageId;
    }

    public function setMessageContent(string $messageContent): void {
        $this->messageContent = $messageContent;
    }

    public function setMessageDate(DateTime $messageDate): void {
        $this->messageDate = $messageDate;
    }

    public function setConversation(Conversation $conversation): void {
        $this->conversation = $conversation;
    }

    public function setUser(User $user): void {
        $this->user = $user;
    }
}
