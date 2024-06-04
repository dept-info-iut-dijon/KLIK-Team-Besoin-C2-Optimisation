<?php

class PollDAO implements PollDAOInterface {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function create(Poll $poll): bool {
        $sql = "INSERT INTO Polls (poll_subject, poll_created, poll_modified, poll_status, poll_description, poll_locked, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $poll->getPollSubject(),
            $poll->getPollCreated()->format('Y-m-d H:i:s'),
            $poll->getPollModified()->format('Y-m-d H:i:s'),
            $poll->getPollStatus(),
            $poll->getPollDescription(),
            $poll->getPollLocked(),
            $poll->getUser()->getUserId()
        ]);
    }

    public function read(int $pollId): ?Poll {
        $sql = "SELECT * FROM Polls WHERE poll_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$pollId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $userDAO = new UserDAO();
            $user = $userDAO->read($row['user_id']);
            return new Poll(
                $row['poll_id'],
                $row['poll_subject'],
                new DateTime($row['poll_created']),
                new DateTime($row['poll_modified']),
                $row['poll_status'],
                $row['poll_description'],
                $row['poll_locked'],
                $user
            );
        }
        return null;
    }

    public function update(Poll $poll): bool {
        $sql = "UPDATE Polls SET poll_subject = ?, poll_created = ?, poll_modified = ?, poll_status = ?, poll_description = ?, poll_locked = ?, user_id = ? WHERE poll_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $poll->getPollSubject(),
            $poll->getPollCreated()->format('Y-m-d H:i:s'),
            $poll->getPollModified()->format('Y-m-d H:i:s'),
            $poll->getPollStatus(),
            $poll->getPollDescription(),
            $poll->getPollLocked(),
            $poll->getUser()->getUserId(),
            $poll->getPollId()
        ]);
    }

    public function delete(int $pollId): bool {
        $sql = "DELETE FROM Polls WHERE poll_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$pollId]);
    }

    public function getAll(): array {
        $sql = "SELECT * FROM Polls";
        $stmt = $this->pdo->query($sql);
        $polls = [];
        $userDAO = new UserDAO();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = $userDAO->read($row['user_id']);
            $polls[] = new Poll(
                $row['poll_id'],
                $row['poll_subject'],
                new DateTime($row['poll_created']),
                new DateTime($row['poll_modified']),
                $row['poll_status'],
                $row['poll_description'],
                $row['poll_locked'],
                $user
            );
        }
        return $polls;
    }
}
