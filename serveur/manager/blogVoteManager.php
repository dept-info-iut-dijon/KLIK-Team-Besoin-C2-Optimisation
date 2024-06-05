<?php
require_once '../data/blogVoteDAO.php';
require_once '../model/blogVote.php';

class BlogVoteManager
{
    private BlogVoteDAO $blogVoteDAO;

    public function __construct()
    {
        $this->blogVoteDAO = new BlogVoteDAO();
    }

    public function createBlogVote(BlogVote $blogVote): bool
    {
        return $this->blogVoteDAO->create($blogVote);
    }

    public function getBlogVoteById(int $blogVoteId): ?BlogVote
    {
        return $this->blogVoteDAO->read($blogVoteId);
    }

    public function updateBlogVote(BlogVote $blogVote): bool
    {
        return $this->blogVoteDAO->update($blogVote);
    }

    public function deleteBlogVote(int $blogVoteId): bool
    {
        return $this->blogVoteDAO->delete($blogVoteId);
    }

    public function getAllBlogVotes(): array
    {
        return $this->blogVoteDAO->getAll();
    }
}
