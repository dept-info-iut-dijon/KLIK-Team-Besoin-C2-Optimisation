<?php
require_once '../data/topicDAO.php'; 
require_once '../model/topic.php';

class TopicManager
{
    private TopicDAO $topicDAO;

    public function __construct()
    {
        $this->topicDAO = new TopicDAO();
    }

    /**
     * @throws Exception
     */
    public function createTopic(Topic $topic): bool
    {
        return $this->topicDAO->create($topic);
    }

    /**
     * @throws Exception
     */
    public function getTopicById(int $topicId): ?Topic
    {
        return $this->topicDAO->read($topicId);
    }

    /**
     * @throws Exception
     */
    public function updateTopic(Topic $topic): bool
    {
        return $this->topicDAO->update($topic);
    }

    /**
     * @throws Exception
     */
    public function deleteTopic(int $topicId): bool
    {
        return $this->topicDAO->delete($topicId);
    }

    /**
     * @throws Exception
     */
    public function getAllTopics(): array
    {
        return $this->topicDAO->getAll();
    }
}
