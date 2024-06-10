<?php

require_once 'user.php';
require_once 'conversation.php';
class Message {
    private int $messageId;
    private string $messageContent;
    private DateTime $messageDate;
    private int $conversationId;
    private User $messageUser;

    public function __construct() {
        $this->messageId = 0;
        $this->messageContent = "";
        $this->messageDate = new DateTime();
        $this->conversationId = 0;
        $this->messageUser = new User();
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

    public function getConversationId(): int {
        return $this->conversationId;
    }

    public function getMessageUser(): User {
        return $this->messageUser;
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

    public function setConversationId(int $conversationId): void {
        $this->conversationId = $conversationId;
    }

    public function setMessageUser(User $user): void {
        $this->messageUser = $user;
    }

    public function toArray(): array {
        return [
            'messageId' => $this->messageId,
            'messageContent' => $this->messageContent,
            'messageDate' => $this->messageDate->format('Y-m-d H:i:s'),
            'conversationId' => $this->conversationId,
            'messageUser' => $this->messageUser->toArray()
        ];
    }

    public static function createFromObject($obj): Message {
        $message = new Message();

        $message->setMessageId($obj->messageId);
        $message->setMessageContent($obj->messageContent);
        $message->setMessageDate(new DateTime($obj->messageDate));
        $message->setConversationId($obj->conversationId);
        $message->setMessageUser(User::createFromObject($obj->messageUser));

        return $message;
    }

    public static function createFromDb($array): Message {
        $message = new Message();

        $message->setMessageId($array["message_id"]);
        $message->setMessageContent($array["message_content"]);
        $message->setMessageDate(new DateTime($array["message_date"]));
        $message->setConversationId($array["conversation_id"]);

        return $message;
    }
}
