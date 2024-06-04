<?php


class PollVoteDAO implements PollVoteDAOInterface {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function create(PollVote $pollVote): bool {
        $sql = "INSERT INTO Poll_Votes (user_id, poll_Option_id) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $pollVote->getUser()->getUserId(),
            $pollVote->getPollOption()->getPollOptionId()
        ]);
    }

    public function read(int $pollVoteId): ?PollVote {
        $sql = "SELECT * FROM Poll_Votes WHERE poll_Vote_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$pollVoteId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $userDAO = new UserDAO();
            $pollOptionDAO = new PollOptionDAO();
            $user = $userDAO->read($row['user_id']);
            $pollOption = $pollOptionDAO->read($row['poll_Option_id']);
            return new PollVote(
                $row['poll_Vote_id'],
                $user,
                $pollOption
            );
        }
        return null;
    }

    public function update(PollVote $pollVote): bool {
        // Pas de champ à mettre à jour car la clé primaire est générée automatiquement
        return false;
    }

    public function delete(int $pollVoteId): bool {
        $sql = "DELETE FROM Poll_Votes WHERE poll_Vote_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$pollVoteId]);
    }

    public function getAll(): array {
        $sql = "SELECT * FROM Poll_Votes";
        $stmt = $this->pdo->query($sql);
        $pollVotes = [];
        $userDAO = new UserDAO();
        $pollOptionDAO = new PollOptionDAO();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = $userDAO->read($row['user_id']);
            $pollOption = $pollOptionDAO->read($row['poll_Option_id']);
            $pollVotes[] = new PollVote(
                $row['poll_Vote_id'],
                $user,
                $pollOption
            );
        }
        return $pollVotes;
    }
}