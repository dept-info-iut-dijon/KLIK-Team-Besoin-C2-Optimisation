<?php
require_once '../data/pollVoteDAO.php'; 
require_once '../model/pollVote.php';

class PollVoteManager
{
    private PollVoteDAO $pollVoteDAO;

    public function __construct()
    {
        $this->pollVoteDAO = new PollVoteDAO();
    }

    public function createPollVote(PollVote $pollVote): bool
    {
        return $this->pollVoteDAO->create($pollVote);
    }

    public function getPollVoteById(int $pollVoteId): ?PollVote
    {
        return $this->pollVoteDAO->read($pollVoteId);
    }

    public function deletePollVote(int $pollVoteId): bool
    {
        return $this->pollVoteDAO->delete($pollVoteId);
    }

    public function getAllPollVotes(): array
    {
        return $this->pollVoteDAO->getAll();
    }
}
