<?php

interface EventDAOInterface {
    public function create(Event $event): bool;
    public function read(int $eventId): ?Event;
    public function update(Event $event): bool;
    public function delete(int $eventId): bool;
    public function getAll(): array;
}