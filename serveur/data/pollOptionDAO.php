<?php


class PollOptionDAO implements PollOptionDAOInterface {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function create(PollOption $pollOption): bool {
        $sql = "INSERT INTO Poll_Options (poll_Option_name, poll_Option_status, poll_id) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $pollOption->getPollOptionName(),
            $pollOption->getPollOptionStatus(),
            $pollOption->getPoll()->getPollId()
        ]);
    }

    public function read(int $pollOptionId): ?PollOption {
        $sql = "SELECT * FROM Poll_Options WHERE poll_Option_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$pollOptionId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $pollDAO = new PollDAO();
            $poll = $pollDAO->read($row['poll_id']);
            return new PollOption(
                $row['poll_Option_id'],
                $row['poll_Option_name'],
                $row['poll_Option_status'],
                $poll
            );
        }
        return null;
    }

    public function update(PollOption $pollOption): bool {
        $sql = "UPDATE Poll_Options SET poll_Option_name = ?, poll_Option_status = ?, poll_id = ? WHERE poll_Option_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $pollOption->getPollOptionName(),
            $pollOption->getPollOptionStatus(),
            $pollOption->getPoll()->getPollId(),
            $pollOption->getPollOptionId()
        ]);
    }

    public function delete(int $pollOptionId): bool {
        $sql = "DELETE FROM Poll_Options WHERE poll_Option_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$pollOptionId]);
    }

    public function getAll(): array {
        $sql = "SELECT * FROM Poll_Options";
        $stmt = $this->pdo->query($sql);
        $pollOptions = [];
        $pollDAO = new PollDAO();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $poll = $pollDAO->read($row['poll_id']);
            $pollOptions[] = new PollOption(
                $row['poll_Option_id'],
                $row['poll_Option_name'],
                $row['poll_Option_status'],
                $poll
            );
        }
        return $pollOptions;
    }
}