<?php
require_once '../data/pollDAO.php'; 
require_once '../model/poll.php';

class PollManager
{
    private PollDAO $pollDAO;

    public function __construct()
    {
        $this->pollDAO = new PollDAO();
    }

    /**
     * @throws Exception
     */
    public function createPoll(Poll $poll): bool
    {
        return $this->pollDAO->create($poll);
    }

    /**
     * @throws Exception
     */
    public function getPollById(int $pollId): ?Poll
    {
        return $this->pollDAO->read($pollId);
    }

    /**
     * @throws Exception
     */
    public function updatePoll(Poll $poll): bool
    {
        return $this->pollDAO->update($poll);
    }

    /**
     * @throws Exception
     */
    public function deletePoll(int $pollId): bool
    {
        return $this->pollDAO->delete($pollId);
    }

    /**
     * @throws Exception
     */
    public function getAllPolls(): array
    {
        return $this->pollDAO->getAll();
    }
}
