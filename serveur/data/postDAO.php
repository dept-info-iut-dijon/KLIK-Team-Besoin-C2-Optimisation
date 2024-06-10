<?php

require_once '../data/interface/postDAOInterface.php';
require_once '../model/post.php';

require_once 'userDAO.php';
require_once '../model/user.php';

require_once 'postVoteDAO.php';
require_once '../model/topic.php';

require_once '../model/postVote.php';

class PostDAO implements PostDAOInterface {
    private Database $db;
    private UserDAO $userDAO;
    private PostVoteDAO $postVoteDAO;

    public function __construct() {
        $this->db = new Database();
        $this->userDAO = new UserDAO();
        $this->postVoteDAO = new PostVoteDAO();
    }

    /**
     * @throws Exception
     */
    public function create(Post $post): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                $post->getPostContent(),
                $post->getPostDate()->format('Y-m-d'),
                $post->getTopicId(),
                $post->getPostUser()->getUserId()
            ];
            $sql = "INSERT INTO Posts (post_content, post_date, topic_id, user_id) VALUES (?, ?, ?, ?)";

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
    public function read(int $postId): Post {
        $result = $this->db->query("SELECT * FROM Posts WHERE post_id = ?", [$postId]);

        if(count($result) === 0)
            throw new Exception("Post not found");

        $user = $this->userDAO->read($result[0]["user_id"]);
        $blogVotes = $this->postVoteDAO->getPostVoteByPost($result[0]["blog_id"]);

        $post = Post::createFromDb($result[0]);
        $post->setPostUser($user);
        $post->setPostVotes($blogVotes);

        return $post;
    }

    /**
     * @throws Exception
     */
    public function update(Post $post): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                $post->getPostContent(),
                $post->getPostDate()->format('Y-m-d'),
                $post->getTopicId(),
                $post->getPostUser()->getUserId(),
                $post->getPostId()
            ];
            $sql = "UPDATE Posts SET post_content = ?, post_date = ?, topic_id = ?, user_id = ? WHERE post_id = ?";

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
    public function delete(int $postId): bool {
        $this->db->beginTransaction();
        try
        {
            $this->db->query("DELETE FROM Posts WHERE post_id = ?", [$postId]);
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
        $posts = $this->db->query("SELECT * FROM Posts");

        return array_map(function($item) {
            $user = $this->userDAO->read($item["user_id"]);
            $postVotes = $this->postVoteDAO->getPostVoteByPost($item["post_id"]);

            $post = Post::createFromDb($item);
            $post->setPostUser($user);
            $post->setPostVotes($postVotes);

            return $post;
        }, $posts);
    }

    /**
     * @throws Exception
     */
    public function getPostByTopic(int $topicId): array
    {
        $result = $this->db->query("SELECT * FROM Posts WHERE topic_id = ?", [$topicId]);

        return array_map(function ($item) {
            $user = $this->userDAO->read($item["user_id"]);
            $postVotes = $this->postVoteDAO->getPostVoteByPost($item["post_id"]);

            $post = Post::createFromDb($item);
            $post->setPostUser($user);
            $post->setPostVotes($postVotes);

            return $post;
        }, $result);
    }
}