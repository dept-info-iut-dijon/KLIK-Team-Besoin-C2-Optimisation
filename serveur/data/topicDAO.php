<?php

require_once '../data/interface/topicDAOInterface.php';
require_once '../model/topic.php';

require_once 'categoryDAO.php';
require_once 'postDAO.php';
require_once '../model/category.php';

require_once 'userDAO.php';
require_once '../model/user.php';

class TopicDAO implements TopicDAOInterface {
    private Database $db;
    private UserDAO $userDAO;
    private PostDAO $postDAO;
    private CategoryDAO $categoryDAO;

    public function __construct() {
        $this->db = new Database();
        $this->userDAO = new UserDAO();
        $this->postDAO = new PostDAO();
        $this->categoryDAO = new CategoryDAO();
    }

    /**
     * @throws Exception
     */
    public function create(Topic $topic): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                $topic->getTopicSubject(),
                $topic->getTopicDate()->format('Y-m-d'),
                $topic->getCategory()->getCatId(),
                $topic->getTopicUser()->getUserId()
            ];
            $sql = "INSERT INTO Topics (topic_subject, topic_date, cat_id, user_id) VALUES (?, ?, ?, ?)";

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
    public function read(int $topicId): Topic {
        $result = $this->db->query("SELECT * FROM Topics WHERE topic_id = ?", [$topicId]);

        if(count($result) === 0)
            throw new Exception("Topic not found");

        $user = $this->userDAO->read($result[0]["user_id"]);
        $category= $this->categoryDAO->read($result[0]["cat_id"]);
        $posts = $this->postDAO->getPostByTopic($result[0]["topic_id"]);

        $topic = Topic::createFromDb($result[0]);
        $topic->setTopicUser($user);
        $topic->setCategory($category);
        $topic->setPosts($posts);

        return $topic;
    }

    /**
     * @throws Exception
     */
    public function update(Topic $topic): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                $topic->getTopicSubject(),
                $topic->getTopicDate()->format('Y-m-d'),
                $topic->getCategory()->getCatId(),
                $topic->getTopicUser()->getUserId(),
                $topic->getTopicId()
            ];
            $sql = "UPDATE Topics SET topic_subject = ?, topic_date = ?, cat_id = ?, user_id = ? WHERE topic_id = ?";

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
    public function delete(int $topicId): bool {
        $this->db->beginTransaction();
        try
        {
            $this->db->query("DELETE FROM Topics WHERE topic_id = ?", [$topicId]);
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
        $topics = $this->db->query("SELECT * FROM Topics");

        return array_map(function($item) {
            $user = $this->userDAO->read($item["user_id"]);
            $category= $this->categoryDAO->read($item["cat_id"]);
            $posts = $this->postDAO->getPostByTopic($item["topic_id"]);

            $topic = Topic::createFromDb($item);
            $topic->setTopicUser($user);
            $topic->setCategory($category);
            $topic->setPosts($posts);

            return $topic;
        }, $topics);
    }
}