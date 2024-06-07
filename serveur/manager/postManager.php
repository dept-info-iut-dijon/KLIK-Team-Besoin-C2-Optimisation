<?php
require_once '../data/postDAO.php'; 
require_once '../model/post.php';

class PostManager
{
    private PostDAO $postDAO;

    public function __construct()
    {
        $this->postDAO = new PostDAO();
    }

    public function createPost(Post $post): bool
    {
        return $this->postDAO->create($post);
    }

    public function getPostById(int $postId): ?Post
    {
        return $this->postDAO->read($postId);
    }

    public function updatePost(Post $post): bool
    {
        return $this->postDAO->update($post);
    }

    public function deletePost(int $postId): bool
    {
        return $this->postDAO->delete($postId);
    }

    public function getAllPosts(): array
    {
        return $this->postDAO->getAll();
    }

    public function getPostVotes(int $postId): array{
        return $this->postDAO->getPostVotes($postId);
    }
}
