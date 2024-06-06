<?php
require_once '../data/postVoteDAO.php';
require_once '../model/postVote.php';

class PostVoteManager
{
    private PostVoteDAO $postVoteDAO;

    public function __construct()
    {
        $this->postVoteDAO = new PostVoteDAO();
    }

    public function createPostVote(PostVote $postVote): bool
    {
        return $this->postVoteDAO->create($postVote);
    }

    public function getPostVoteById(int $postVoteId): ?PostVote
    {
        return $this->postVoteDAO->read($postVoteId);
    }

    public function updatePostVote(PostVote $postVote): bool
    {
        return $this->postVoteDAO->update($postVote);
    }

    public function deletePostVote(int $postVoteId): bool
    {
        return $this->postVoteDAO->delete($postVoteId);
    }

    public function getAllPostVotes(): array
    {
        return $this->postVoteDAO->getAll();
    }
}
