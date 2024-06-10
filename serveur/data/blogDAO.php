<?php

require_once '../data/interface/blogDAOInterface.php';
require_once '../model/blog.php';

require_once 'userDAO.php';
require_once 'blogVoteDAO.php';

class BlogDAO implements BlogDAOInterface {
    private Database $db;
    private UserDAO $userDAO;
    private BlogVoteDAO $blogVoteDAO;

    public function __construct() {
        $this->db = new Database();
        $this->userDAO = new UserDAO();
        $this->blogVoteDAO = new BlogVoteDAO();
    }

    /**
     * @throws Exception
     */
    public function create(Blog $blog): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                "blog_title" => $blog->getBlogTitle(),
                "blog_image" => $blog->getBlogImg(),
                "blog_date" => $blog->getBlogDate()->format('Y-m-d'),
                "blog_content" => $blog->getBlogContent(),
                "blog_userId" => $blog->getBlogUser()->getUserId()
            ];
            $sql = "INSERT INTO Blogs (blog_title, blog_img, blog_date, blog_content, user_id) VALUES (:blog_title, :blog_image, :blog_date, :blog_content, :blog_userId)";

            $this->db->execute($sql, $params);
            $this->db->commit();
        }
        catch (Exception $e)
        {
            $this->db->rollBack();
            throw $e;
        }

        return true;
    }

    /**
     * @throws Exception
     */
    public function read(int $blogId): Blog
    {
        $result = $this->db->query("SELECT * FROM Blogs WHERE blog_id = :blog_id", [":blog_id" => $blogId]);

        if(count($result) === 0)
            throw new Exception("Blog not found");

        $user = $this->userDAO->read($result[0]["user_id"]);
        $blogVotes = $this->blogVoteDAO->getBlogVoteByBlog($result[0]["blog_id"]);

        $blog = Blog::createFromDb($result[0]);
        $blog->setBlogUser($user);
        $blog->setBlogVotes($blogVotes);

        return $blog;
    }

    /**
     * @throws Exception
     */
    public function update(Blog $blog): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                "blog_id" => $blog->getBlogId(),
                "blog_title" => $blog->getBlogTitle(),
                "blog_image" => $blog->getBlogImg(),
                "blog_date" => $blog->getBlogDate()->format('Y-m-d'),
                "blog_content" => $blog->getBlogContent(),
                "blog_userId" => $blog->getBlogUser()->getUserId()
            ];
            $sql = "UPDATE Blogs SET blog_title = :blog_title, blog_img = :blog_image, blog_date = :blog_date, blog_content = :blog_content, user_id = :blog_userId WHERE blog_id = :blog_id";

            $this->db->execute($sql, $params);
            $this->db->commit();
        }
        catch (Exception $e)
        {
            $this->db->rollBack();
            throw $e;
        }

        return true;
    }

    /**
     * @throws Exception
     */
    public function delete(int $blogId): bool {
        $this->db->beginTransaction();
        try
        {
            $this->db->query("DELETE FROM Blogs WHERE blog_id = :blog_id", [":blog_id" => $blogId]);
            $this->db->commit();
        }
        catch (Exception $e)
        {
            $this->db->rollBack();
            throw $e;
        }

        return true;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getAll(): array {
        $blogs = $this->db->query("SELECT * FROM Blogs");

        return array_map(function($item) {
            $user = $this->userDAO->read($item["user_id"]);
            $blogVotes = $this->blogVoteDAO->getBlogVoteByBlog($item["blog_id"]);

            $blog = Blog::createFromDb($item);
            $blog->setBlogUser($user);
            $blog->setBlogVotes($blogVotes);

            return $blog;
        }, $blogs);
    }
}