<?php

interface PollVoteDAOInterface {
    public function create(PollVote $pollVote): bool;
    public function read(int $pollVoteId): ?PollVote;
    public function update(PollVote $pollVote): bool;
    public function delete(int $pollVoteId): bool;
    public function getAll(): array;
}

