<?php
require_once '../data/blogDAO.php';
require_once '../data/blogVoteDAO.php';
require_once '../model/blog.php';

class BlogManager
{
    private BlogDAO $blogDAO;
    public function __construct()
    {
        $this->blogDAO = new BlogDAO();
    }

    /**
     * @throws Exception
     */
    public function createBlog(Blog $blog): bool
    {
        return $this->blogDAO->create($blog);
    }

    /**
     * @throws Exception
     */
    public function getBlogById(int $blogId): ?Blog
    {
        return $this->blogDAO->read($blogId);
    }

    /**
     * @throws Exception
     */
    public function updateBlog(Blog $blog): bool
    {
        return $this->blogDAO->update($blog);
    }

    /**
     * @throws Exception
     */
    public function deleteBlog(int $blogId): bool
    {
        return $this->blogDAO->delete($blogId);
    }

    /**
     * @throws Exception
     */
    public function getAllBlogs(): array
    {
        return $this->blogDAO->getAll();
    }
}
