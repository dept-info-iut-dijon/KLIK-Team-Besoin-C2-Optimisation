<?php

interface PollDAOInterface {
    public function create(Poll $poll): bool;
    public function read(int $pollId): ?Poll;
    public function update(Poll $poll): bool;
    public function delete(int $pollId): bool;
    public function getAll(): array;
}
