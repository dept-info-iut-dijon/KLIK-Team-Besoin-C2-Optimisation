<?php
require_once '../data/pollOptionDAO.php'; 
require_once '../model/pollOption.php';

class PollOptionManager
{
    private PollOptionDAO $pollOptionDAO;

    public function __construct()
    {
        $this->pollOptionDAO = new PollOptionDAO();
    }

    /**
     * @throws Exception
     */
    public function createPollOption(PollOption $pollOption): bool
    {
        return $this->pollOptionDAO->create($pollOption);
    }

    /**
     * @throws Exception
     */
    public function getPollOptionById(int $pollOptionId): ?PollOption
    {
        return $this->pollOptionDAO->read($pollOptionId);
    }

    /**
     * @throws Exception
     */
    public function updatePollOption(PollOption $pollOption): bool
    {
        return $this->pollOptionDAO->update($pollOption);
    }

    /**
     * @throws Exception
     */
    public function deletePollOption(int $pollOptionId): bool
    {
        return $this->pollOptionDAO->delete($pollOptionId);
    }

    /**
     * @throws Exception
     */
    public function getAllPollOptions(): array
    {
        return $this->pollOptionDAO->getAll();
    }
}
