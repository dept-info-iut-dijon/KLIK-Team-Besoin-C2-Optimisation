<?php

interface ConversationDAOInterface {
    public function create(Conversation $conversation): bool;
    public function read(int $conversationId): ?Conversation;
    public function update(Conversation $conversation): bool;
    public function delete(int $conversationId): bool;
    public function getAll(): array;
}