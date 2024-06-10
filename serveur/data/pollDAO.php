<?php

require_once 'userDAO.php';
require_once 'pollOptionDAO.php';
require_once '../data/interface/pollDAOInterface.php';

require_once '../data/interface/pollDAOInterface.php';
require_once '../model/poll.php';


class PollDAO implements PollDAOInterface {
    private Database $db;
    private UserDAO $userDAO;
    private pollOptionDAO $pollOptionDAO;

    public function __construct() {
        $this->db = new Database();
        $this->userDAO = new UserDAO();
        $this->pollOptionDAO = new pollOptionDAO();
    }

    /**
     * @throws Exception
     */
    public function create(Poll $poll): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                $poll->getPollSubject(),
                $poll->getPollCreated()->format('Y-m-d H:i:s'),
                $poll->getPollModified()->format('Y-m-d H:i:s'),
                $poll->getPollStatus(),
                $poll->getPollDescription(),
                $poll->getPollLocked(),
                $poll->getPollUser()->getUserId()
            ];
            $sql = "INSERT INTO Polls (poll_subject, poll_created, poll_modified, poll_status, poll_description, poll_locked, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";

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
    public function read(int $pollId): ?Poll {
        $result = $this->db->query("SELECT * FROM Polls WHERE poll_id = ?", [$pollId]);

        if(count($result) === 0)
            throw new Exception("Poll not found");

        $user = $this->userDAO->read($result[0]["user_id"]);
        $pollOptions = $this->pollOptionDAO->getPollOptionsByPoll($result[0]["poll_id"]);

        $poll = Poll::createFromDb($result[0]);
        $poll->setPollUser($user);
        $poll->setPollOptions($pollOptions);

        return $poll;
    }

    /**
     * @throws Exception
     */
    public function update(Poll $poll): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                $poll->getPollSubject(),
                $poll->getPollCreated()->format('Y-m-d H:i:s'),
                $poll->getPollModified()->format('Y-m-d H:i:s'),
                $poll->getPollStatus(),
                $poll->getPollDescription(),
                $poll->getPollLocked(),
                $poll->getPollUser()->getUserId(),
                $poll->getPollId()

            ];
            $sql = "UPDATE Polls SET poll_subject = ?, poll_created = ?, poll_modified = ?, poll_status = ?, poll_description = ?, poll_locked = ?, user_id = ? WHERE poll_id = ?";

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
    public function delete(int $pollId): bool {
        $this->db->beginTransaction();
        try
        {
            $this->db->query("DELETE FROM Polls WHERE poll_id = ?", [$pollId]);
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
        $polls = $this->db->query("SELECT * FROM Polls");

        return array_map(function($item) {
            $user = $this->userDAO->read($item["user_id"]);
            $pollOptions = $this->pollOptionDAO->getPollOptionsByPoll($item["poll_id"]);

            $poll = Poll::createFromDb($item);
            $poll->setPollUser($user);
            $poll->setPollOptions($pollOptions);

            return $poll;
        }, $polls);
    }
}
