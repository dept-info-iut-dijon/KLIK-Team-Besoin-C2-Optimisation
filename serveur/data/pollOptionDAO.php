<?php

require_once '../data/interface/pollOptionInterface.php';
require_once '../model/pollOption.php';

require_once 'pollVoteDAO.php';
require_once '../model/poll.php';

class PollOptionDAO implements PollOptionDAOInterface {
    private Database $db;
    private PollVoteDAO $pollVoteDAO;

    public function __construct() {
        $this->db = new Database();
        $this->pollVoteDAO = new PollVoteDAO();
    }

    /**
     * @throws Exception
     */
    public function create(PollOption $pollOption): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                $pollOption->getPollOptionName(),
                $pollOption->getPollOptionStatus(),
                $pollOption->getPollId()
            ];
            $sql = "INSERT INTO Poll_Options (poll_Option_name, poll_Option_status, poll_id) VALUES (?, ?, ?)";

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
    public function read(int $pollOptionId): ?PollOption {
        $result = $this->db->query("SELECT * FROM Poll_Options WHERE poll_Option_id = ?", [$pollOptionId]);

        if(count($result) === 0)
            throw new Exception("PollOption not found");

        $pollVotes = $this->pollVoteDAO->getPollVoteByPollOption($result[0]["poll_Option_id"]);

        $pollOption = PollOption::createFromDb($result[0]);
        $pollOption->setPollVotes($pollVotes);

        return $pollOption;
    }

    /**
     * @throws Exception
     */
    public function update(PollOption $pollOption): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                $pollOption->getPollOptionName(),
                $pollOption->getPollOptionStatus(),
                $pollOption->getPollId(),
                $pollOption->getPollOptionId()
            ];
            $sql = "UPDATE Poll_Options SET poll_Option_name = ?, poll_Option_status = ?, poll_id = ? WHERE poll_Option_id = ?";

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
    public function delete(int $pollOptionId): bool {
        $this->db->beginTransaction();

        try
        {
            $this->db->query("DELETE FROM Poll_Options WHERE poll_Option_id = ?", [$pollOptionId]);
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
        $pollOptions = $this->db->query("SELECT * FROM Poll_Options");

        return array_map(function($item) {
            $pollVotes = $this->pollVoteDAO->getPollVoteByPollOption($item["poll_Option_id"]);

            $pollOption = PollOption::createFromDb($item);
            $pollOption->setPollVotes($pollVotes);

            return $pollOption;
        }, $pollOptions);
    }

    /**
     * @throws Exception
     */
    public function getPollOptionsByPoll(int $pollId): array
    {
        $result = $this->db->query("SELECT * FROM Poll_Options WHERE poll_id = ?", [$pollId]);

        return array_map(function($item) {
            $pollVotes = $this->pollVoteDAO->getPollVoteByPollOption($item["poll_Option_id"]);

            $pollOption = PollOption::createFromDb($item);
            $pollOption->setPollVotes($pollVotes);

            return $pollOption;
        }, $result);
    }
}