<?php

interface MessageDAOInterface {
    public function create(Message $message): bool;
    public function read(int $messageId): ?Message;
    public function update(Message $message): bool;
    public function delete(int $messageId): bool;
    public function getAll(): array;
    public function getMessagesByConversation(int $conversationId): array;
}