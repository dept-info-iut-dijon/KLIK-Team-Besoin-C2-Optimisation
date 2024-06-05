<?php
require_once '../data/blogDAO.php';
require_once '../model/blog.php';

class BlogManager
{
    private BlogDAO $blogDAO;

    public function __construct()
    {
        $this->blogDAO = new BlogDAO();
    }

    public function createBlog(Blog $blog): bool
    {
        return $this->blogDAO->create($blog);
    }

    public function getBlogById(int $blogId): ?Blog
    {
        return $this->blogDAO->read($blogId);
    }

    public function updateBlog(Blog $blog): bool
    {
        return $this->blogDAO->update($blog);
    }

    public function deleteBlog(int $blogId): bool
    {
        return $this->blogDAO->delete($blogId);
    }

    public function getAllBlogs(): array
    {
        return $this->blogDAO->getAll();
    }
}
