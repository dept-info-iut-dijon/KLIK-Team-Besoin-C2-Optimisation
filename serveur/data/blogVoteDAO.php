<?php
require_once '../data/interface/blogVoteDAOInterface.php';
require_once '../model/blogVote.php';

require_once 'userDAO.php';
require_once 'blogDAO.php';

class BlogVoteDAO implements BlogVoteDAOInterface {
    private Database $db;
    private UserDAO $userDAO;

    public function __construct() {
        $this->db = new Database();
        $this->userDAO = new UserDAO();
    }

    /**
     * @throws Exception
     */
    public function create(BlogVote $blogVote): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                "blog_Vote_date" => $blogVote->getBlogVoteDate()->format('Y-m-d'),
                "blog_Vote" => $blogVote->getBlogVote(),
                "user_id" => $blogVote->getBlogVoteUser()->getUserId(),
                "blog_id" => $blogVote->getBlogId()
            ];
            $sql = "INSERT INTO Blog_Votes (blog_Vote_date, blog_Vote, user_id, blog_id) VALUES (:blog_Vote_date, :blog_Vote, :user_id, :blog_id)";

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
    public function read(int $blogVoteId): BlogVote {
        $result = $this->db->query("SELECT * FROM Blog_Votes WHERE blog_Vote_id = :blog_Vote_id", [":blog_Vote_id" => $blogVoteId]);

        if(count($result) === 0)
            throw new Exception("BlogVote not found");

        $user = $this->userDAO->read($result[0]["user_id"]);

        $blogVote = BlogVote::createFromDb($result[0]);
        $blogVote->setBlogVoteUser($user);

        return $blogVote;
    }

    /**
     * @throws Exception
     */
    public function update(BlogVote $blogVote): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                "blog_Vote_id" => $blogVote->getBlogId(),
                "blog_Vote_date" => $blogVote->getBlogVoteDate()->format('Y-m-d'),
                "blog_Vote" => $blogVote->getBlogVote(),
                "user_id" => $blogVote->getBlogVoteUser()->getUserId(),
                "blog_id" => $blogVote->getBlogId()
            ];
            $sql = "UPDATE Blog_Votes SET blog_Vote_date = :blog_Vote_date, blog_Vote = :blog_Vote, user_id = :user_id, blog_id = :blog_id WHERE blog_Vote_id = :blog_Vote_id";

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
    public function delete(int $blogVoteId): bool {
        $this->db->beginTransaction();
        try
        {
            $this->db->query("DELETE FROM Blog_Votes WHERE blog_Vote_id = :blog_Vote_id", [":blog_Vote_id" => $blogVoteId]);
            $this->db->commit();
        }
        catch (Exception $e)
        {
            $this->db->rollBack();
            throw $e;
        }

        return true;
    }

    public function getAll(): array {
        $blogVotes = $this->db->query("SELECT * FROM Blog_Votes");

        return array_map(function($item) {
            $user = $this->userDAO->read($item["user_id"]);

            $blogVote = BlogVote::createFromDb($item);
            $blogVote->setBlogVoteUser($user);

            return $blogVote;
        }, $blogVotes);
    }

    /**
     * @throws Exception
     */
    public function getBlogVoteByBlog(int $blogId): array
    {
        $result = $this->db->query("SELECT * FROM Blog_Votes WHERE blog_id = :blod_id", [":blod_id" => $blogId]);

        return array_map(function($item) {
            $user = $this->userDAO->read($item["user_id"]);

            $blogVote = BlogVote::createFromDb($item);
            $blogVote->setBlogVoteUser($user);

            return $blogVote;
        }, $result);
    }
}