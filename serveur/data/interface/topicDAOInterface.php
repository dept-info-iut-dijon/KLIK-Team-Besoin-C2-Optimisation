<?php

interface TopicDAOInterface {
    public function create(Topic $topic): bool;
    public function read(int $topicId): ?Topic;
    public function update(Topic $topic): bool;
    public function delete(int $topicId): bool;
    public function getAll(): array;
}