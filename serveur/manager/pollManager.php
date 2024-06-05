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

    public function createPoll(Poll $poll): bool
    {


        return $this->pollDAO->create($poll);
    }

    public function getPollById(int $pollId): ?Poll
    {
        return $this->pollDAO->read($pollId);
    }

    public function updatePoll(Poll $poll): bool
    {
        return $this->pollDAO->update($poll);
    }

    public function deletePoll(int $pollId): bool
    {
        return $this->pollDAO->delete($pollId);
    }

    public function getAllPolls(): array
    {
        return $this->pollDAO->getAll();
    }
}
