<?php

require_once '../data/interface/postVoteDAOInterface.php';
require_once '../model/postVote.php';

require_once 'userDAO.php';
require_once '../model/user.php';

require_once 'postDAO.php';
require_once '../model/post.php';

class PostVoteDAO implements PostVoteDAOInterface {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function create(PostVote $postVote): bool {
        $sql = "INSERT INTO Post_Votes (post_Vote_date, post_Vote, post_id, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $postVote->getPostVoteDate()->format('Y-m-d'),
            $postVote->getPostVote(),
            $postVote->getPost()->getPostId(),
            $postVote->getUser()->getUserId()
        ]);
    }

    public function read(int $postVoteId): ?PostVote {
        $sql = "SELECT * FROM Post_Votes WHERE post_Vote_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$postVoteId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $postDAO = new PostDAO();
            $userDAO = new UserDAO();
            $post = $postDAO->read($row['post_id']);
            $user = $userDAO->read($row['user_id']);
            return new PostVote(
                $row['post_Vote_id'],
                new DateTime($row['post_Vote_date']),
                $row['post_Vote'],
                $post,
                $user
            );
        }
        return null;
    }

    public function update(PostVote $postVote): bool {
        $sql = "UPDATE Post_Votes SET post_Vote_date = ?, post_Vote = ?, post_id = ?, user_id = ? WHERE post_Vote_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $postVote->getPostVoteDate()->format('Y-m-d'),
            $postVote->getPostVote(),
            $postVote->getPost()->getPostId(),
            $postVote->getUser()->getUserId(),
            $postVote->getPostVoteId()
        ]);
    }

    public function delete(int $postVoteId): bool {
        $sql = "DELETE FROM Post_Votes WHERE post_Vote_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$postVoteId]);
    }

    public function getAll(): array {
        $sql = "SELECT * FROM Post_Votes";
        $stmt = $this->pdo->query($sql);
        $postVotes = [];
        $postDAO = new PostDAO();
        $userDAO = new UserDAO();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $post = $postDAO->read($row['post_id']);
            $user = $userDAO->read($row['user_id']);
            $postVotes[] = new PostVote(
                $row['post_Vote_id'],
                new DateTime($row['post_Vote_date']),
                $row['post_Vote'],
                $post,
                $user
            );
        }
        return $postVotes;
    }
}