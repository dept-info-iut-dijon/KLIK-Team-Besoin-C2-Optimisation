<?php

interface PollOptionDAOInterface {
    public function create(PollOption $pollOption): bool;
    public function read(int $pollOptionId): ?PollOption;
    public function update(PollOption $pollOption): bool;
    public function delete(int $pollOptionId): bool;
    public function getAll(): array;
    public function getPollOptionsByPoll(int $pollId): array;
}