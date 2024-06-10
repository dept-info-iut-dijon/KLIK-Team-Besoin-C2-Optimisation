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

    /**
     * @throws Exception
     */
    public function createPost(Post $post): bool
    {
        return $this->postDAO->create($post);
    }

    /**
     * @throws Exception
     */
    public function getPostById(int $postId): ?Post
    {
        return $this->postDAO->read($postId);
    }

    /**
     * @throws Exception
     */
    public function updatePost(Post $post): bool
    {
        return $this->postDAO->update($post);
    }

    /**
     * @throws Exception
     */
    public function deletePost(int $postId): bool
    {
        return $this->postDAO->delete($postId);
    }

    /**
     * @throws Exception
     */
    public function getAllPosts(): array
    {
        return $this->postDAO->getAll();
    }
}
