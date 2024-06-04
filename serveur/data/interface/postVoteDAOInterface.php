<?php

interface PostVoteDAOInterface {
    public function create(PostVote $postVote): bool;
    public function read(int $postVoteId): ?PostVote;
    public function update(PostVote $postVote): bool;
    public function delete(int $postVoteId): bool;
    public function getAll(): array;
}