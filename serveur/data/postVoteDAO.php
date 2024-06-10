<?php

require_once '../data/interface/postVoteDAOInterface.php';
require_once '../model/postVote.php';

require_once 'userDAO.php';
require_once '../model/user.php';

require_once 'postDAO.php';
require_once '../model/post.php';

class PostVoteDAO implements PostVoteDAOInterface {
    private Database $db;
    private UserDAO $userDAO;

    public function __construct() {
        $this->db = new Database();
        $this->userDAO = new UserDAO();
    }

    /**
     * @throws Exception
     */
    public function create(PostVote $postVote): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                $postVote->getPostVoteDate()->format('Y-m-d'),
                $postVote->getPostVote(),
                $postVote->getPostId(),
                $postVote->getPostVoteUser()->getUserId()
            ];
            $sql = "INSERT INTO Post_Votes (post_Vote_date, post_Vote, post_id, user_id) VALUES (?, ?, ?, ?)";

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
    public function read(int $postVoteId): ?PostVote {
        $result = $this->db->query("SELECT * FROM Post_Votes WHERE post_Vote_id = ?", [$postVoteId]);

        if(count($result) === 0)
            throw new Exception("PostVote not found");

        $user = $this->userDAO->read($result[0]["user_id"]);

        $postVote = PostVote::createFromDb($result[0]);
        $postVote->setPostVoteUser($user);

        return $postVote;
    }

    /**
     * @throws Exception
     */
    public function update(PostVote $postVote): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                $postVote->getPostVoteDate()->format('Y-m-d'),
                $postVote->getPostVote(),
                $postVote->getPostId(),
                $postVote->getPostVoteUser()->getUserId(),
                $postVote->getPostVoteId()
            ];
            $sql = "UPDATE Post_Votes SET post_Vote_date = ?, post_Vote = ?, post_id = ?, user_id = ? WHERE post_Vote_id = ?";

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
    public function delete(int $postVoteId): bool {
        $this->db->beginTransaction();
        try
        {
            $this->db->query("DELETE FROM Post_Votes WHERE post_Vote_id = ?", [$postVoteId]);
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
        $postVotes = $this->db->query("SELECT * FROM Post_Votes");

        return array_map(function($item) {
            $user = $this->userDAO->read($item["user_id"]);

            $postVote = PostVote::createFromDb($item);
            $postVote->setPostVoteUser($user);

            return $postVote;
        }, $postVotes);
    }

    /**
     * @throws Exception
     */
    public function getPostVoteByPost(int $postId): array
    {
        $result = $this->db->query("SELECT * FROM Post_Votes WHERE post_id = ?", [$postId]);

        return array_map(function ($item) {
            $user = $this->userDAO->read($item["user_id"]);

            $postVote = PostVote::createFromDb($item);
            $postVote->setPostVoteUser($user);

            return $postVote;
        }, $result);
    }
}