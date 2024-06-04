<?php

interface BlogVoteDAOInterface {
    public function create(BlogVote $blogVote): bool;
    public function read(int $blogVoteId): ?BlogVote;
    public function update(BlogVote $blogVote): bool;
    public function delete(int $blogVoteId): bool;
    public function getAll(): array;
}