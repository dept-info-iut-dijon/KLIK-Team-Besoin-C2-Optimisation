<?php
require_once '../data/topicDAO.php'; 
require_once '../model/topic.php.php';

class TopicManager
{
    private TopicDAO $topicDAO;

    public function __construct()
    {
        $this->topicDAO = new TopicDAO();
    }

    public function createTopic(Topic $topic): bool
    {
        return $this->topicDAO->create($topic);
    }

    public function getTopicById(int $topicId): ?Topic
    {
        return $this->topicDAO->read($topicId);
    }

    public function updateTopic(Topic $topic): bool
    {
        return $this->topicDAO->update($topic);
    }

    public function deleteTopic(int $topicId): bool
    {
        return $this->topicDAO->delete($topicId);
    }

    public function getAllTopics(): array
    {
        return $this->topicDAO->getAll();
    }
}
