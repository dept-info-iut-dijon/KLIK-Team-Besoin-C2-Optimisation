<?php

require_once '../data/interface/pollVoteDAOInterface.php';
require_once '../model/pollVote.php';

require_once 'userDAO.php';
require_once '../model/user.php';

require_once 'pollOptionDAO.php';
require_once '../model/pollOption.php';

class PollVoteDAO implements PollVoteDAOInterface {
    private Database $db;
    private UserDAO $userDAO;

    public function __construct() {
        $this->db = new Database();
        $this->userDAO = new UserDAO();
    }

    /**
     * @throws Exception
     */
    public function create(PollVote $pollVote): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                $pollVote->getPollVoteUser()->getUserId(),
                $pollVote->getPollOptionId()
            ];
            $sql = "INSERT INTO Poll_Votes (user_id, poll_Option_id) VALUES (?, ?)";

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
    public function read(int $pollVoteId): PollVote {
        $result = $this->db->query("SELECT * FROM Poll_Votes WHERE poll_Vote_id = ?", [$pollVoteId]);

        if(count($result) === 0)
            throw new Exception("PollVote not found");

        $user = $this->userDAO->read($result[0]["user_id"]);

        $pollVote = PollVote::createFromDb($result[0]);
        $pollVote->setPollVoteUser($user);

        return $pollVote;
    }

    public function update(PollVote $pollVote): bool {
        // Pas de champ à mettre à jour car la clé primaire est générée automatiquement
        return false;
    }

    /**
     * @throws Exception
     */
    public function delete(int $pollVoteId): bool {
        $this->db->beginTransaction();
        try
        {
            $this->db->query("DELETE FROM Poll_Votes WHERE poll_Vote_id = ?", [$pollVoteId]);
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
        $pollVotes = $this->db->query("SELECT * FROM Poll_Votes");

        return array_map(function($item) {
            $user = $this->userDAO->read($item["user_id"]);

            $pollVote = PollVote::createFromDb($item);
            $pollVote->setPollVoteUser($user);

            return $pollVote;
        }, $pollVotes);
    }

    /**
     * @throws Exception
     */
    public function getPollVoteByPollOption(int $pollOptionId): array
    {
        $result = $this->db->query("SELECT * FROM Poll_Votes WHERE poll_Option_id = ?", [$pollOptionId]);

        return array_map(function($item) {
            $user = $this->userDAO->read($item["user_id"]);

            $pollVote = PollVote::createFromDb($item);
            $pollVote->setPollVoteUser($user);

            return $pollVote;
        }, $result);
    }
}